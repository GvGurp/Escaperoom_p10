@extends ('layout.main_layout')
@section('content')
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Mini-Game</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSRF Token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Include SweetAlert2 from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
<div class="max-w-4xl mx-auto p-10 m-44 bg-slate-800 rounded-lg shadow-md mt-10">
    <h1 class="text-3xl font-semibold text-center text-white mb-6">Guess the Total Value!</h1>

    <div id="images-container" class="flex justify-center w-full"></div>

    <div class="flex justify-center items-center mb-4">
        <input type="number" id="guess" class="p-2 border border-gray-300 rounded-md w-36 text-center"
               placeholder="Enter your guess">
        <button onclick="checkGuess()" class="ml-4 px-6 py-2 bg-lime-700 text-white rounded-md hover:bg-blue-700">
            Submit
        </button>
    </div>

    <p id="result" class="text-center text-xl font-semibold text-gray-700"></p>

    <div class="flex justify-center space-x-4 mt-6">
        <div id="safeTimerDisplay" class="text-xl font-semibold text-white">00:30</div>
        <button onclick="timer()" id="startTimerBtn"
                class="px-6 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-700">Start Timer
        </button>
    </div>

    <button id="tryAgainBtn" onclick="restartGame()"
            class="mt-4 px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-700" style="display: none;">Try Again
    </button>
</div>

<script>
    startGame();

    let gameTimer;
    let score = 0; // Placeholder for the score
    let totalValue = 0;
    let level = 1
    ;

    const images = [
        { src: '../../public/images/apple.jpg', value: 1 },
        { src: '../../public/images/banana.png', value: 2 },
        { src: '../../public/images/orange.jpg', value: 3 },
    ];

    function timer() {
        let sec = 30;
        document.getElementById('startTimerBtn').style.display = 'none';

        gameTimer = setInterval(function () {
            document.getElementById('safeTimerDisplay').innerHTML = '00:' + (sec < 10 ? '0' : '') + sec;
            sec--;
            if (sec < 0) {
                clearInterval(gameTimer);
                restartGame();
            }
        }, 1000);
    }

    function startGame() {
        Swal.fire({
            title: '<span class="text-xl font-bold text-white">Game Rules</span>',
            html: `
            <ul class="text-left text-gray-300 text-lg space-y-2">
                <li>Click <strong>Start Game</strong> to begin.</li>
                <li>A <strong>30-second timer</strong> will start.</li>
                <li>Solve <strong>3 math puzzles</strong> by adding the values shown.</li>
                <li>Enter your answer and click <strong>Submit</strong>.</li>
                <li>Keep trying until you get the correct answer.</li>
                <li>If time runs out, click <strong>Try Again</strong> to restart.</li>
            </ul>
        `,
            icon: 'info',
            confirmButtonText: 'Start',
            background: '#0d255d',
            color: '#e5e7eb',
        }).then(() => {
            loadLevel();
            timer();
        });
    }

    function loadLevel() {
        const imagesContainer = document.getElementById('images-container');
        imagesContainer.innerHTML = '';

        const randomImages = [];
        for (let i = 0; i < level + 2; i++) {
            const randomIndex = Math.floor(Math.random() * images.length);
            randomImages.push(images[randomIndex]);
        }

        totalValue = randomImages.reduce((sum, img) => sum + img.value, 0);

        randomImages.forEach(image => {
            const imgElement = document.createElement('img');
            imgElement.src = image.src;
            imgElement.alt = 'Image';
            imgElement.classList.add('w-24', 'h-24', 'm-2', 'object-cover');
            imagesContainer.appendChild(imgElement);
        });
    }

    function checkGuess() {
        const guess = parseInt(document.getElementById('guess').value);
        const result = document.getElementById('result');

        if (guess === totalValue) {
            result.textContent = 'Correct! 🎉';
            document.getElementById('guess').value = '';
            if (level === 3) {
                showCompletionMessage();
            } else {
                level++;
                loadLevel();
            }
        } else {
            result.textContent = 'Wrong! Try again.';
        }
    }

    function calculateScore(timeRemaining) {
        let seconds = parseInt(timeRemaining.split(':')[1]);
        return seconds * 100; // Example: 100 points per second remaining
    }

    function showCompletionMessage() {
        clearInterval(gameTimer);
        let timeRemaining = document.getElementById('safeTimerDisplay').innerText;
        let score = calculateScore(timeRemaining);

        Swal.fire({
            title: '<span class="text-xl font-bold text-white">Congratulations!</span>',
            html: `
            <p class="text-lg text-gray-300">You completed all levels in <strong>${timeRemaining}</strong>!</p>
            <p class="text-lg text-gray-300">Your score is: <strong>${score}</strong></p>
            <button id="save-score-btn" class="bg-orange-600 hover:bg-orange-700 text-white text-sm px-4 py-2 rounded-md mt-4">
                Save Your Score
            </button>
        `,
            icon: 'success',
            background: '#0d255d',
            color: '#e5e7eb',
            showConfirmButton: false,
            allowOutsideClick: false,
            customClass: {
                popup: 'rounded-lg shadow-lg bg-slate-500',
                title: 'text-white',
            },
        });

        setTimeout(() => {
            document.getElementById('save-score-btn').addEventListener('click', () => saveScore(score, timeRemaining));
        }, 100);
    }

    function saveScore(score, timeRemaining) {
        fetch('{{ route('save-score') }}', {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                score: score,
                time: timeRemaining,
                level_id: level,
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('<span class="text-white">Score saved successfully!</span>', '', 'success');
                {{--.then(() => {--}}
                {{--        window.location.href = '{{ route('/') }}';--}}
                } else {
                    Swal.fire('<span class="text-white">Failed to save the score.</span>', '', 'error');
                }
            })
            .catch(() => {
                Swal.fire('<span class="text-white">An error occurred while saving your score.</span>', '', 'error');
            });
    }

    function restartGame() {
        location.reload();
    }
</script>
</body>
</html>
@endsection
