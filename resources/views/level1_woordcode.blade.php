
@extends('layout.main_layout')

@section('content')
<body class="bg-cover bg-center h-screen bg-[url('../public/images/blaadje.gif')]">

    <div class="min-h-screen flex items-center justify-center">
        <!-- Game Container -->
        <div class="w-full max-w-lg p-8 bg-gray-800 rounded-lg shadow-xl ring-1 ring-black/20">

            <h2 class="text-4xl font-bold text-center text-white mb-6">Word Guessing Game</h2>

            <!-- Display Remaining Time and Score -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h4 class="text-lg font-semibold text-white">Remaining Time: <span id="timer" class="text-blue-400">{{ $timer }}</span> seconds</h4>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white">Score: <span id="score" class="text-green-400">{{ session('score', 0) }}</span></h4>
                </div>
            </div>

            <!-- Display Word Blanks -->
            <div class="mt-8 text-center">
                <h3 id="word-blanks" class="text-3xl font-bold tracking-wide text-white">{{ $gameData['blanks'] }}</h3>
            </div>

            <!-- Hint Display -->
            <div class="mt-6">
                <p class="text-blue-300 font-semibold">Hint 1: {{ $gameData['hint1'] }}</p>
                @if ($gameData['showHint2'])
                    <p class="text-blue-300 font-semibold">Hint 2: {{ $gameData['hint2'] }}</p>
                @endif
            </div>

            <!-- Feedback Section -->
            @if(session('message'))
                <div class="mt-4 bg-gray-700 p-4 rounded-lg text-white">
                    <p>{{ session('message') }}</p>
                </div>
            @endif

            <!-- Guess Form -->
            <form action="{{ route('game.checkAnswer') }}" method="POST" id="guess-form" class="mt-6">
                @csrf
                <input type="hidden" name="remainingTime" id="remaining-time" value="{{ $timer }}">
                <input 
                    type="text" 
                    name="guess" 
                    id="guess" 
                    class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400" 
                    placeholder="Enter your guess">
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 mt-4">
                    Submit
                </button>
            </form>
        </div>
    </div>

    <!-- Timer Script -->
    <script>
        let timer = {{ $timer }}; // Get the remaining time from the server
        const timerElement = document.getElementById('timer'); // Element to display the timer
        const remainingTimeInput = document.getElementById('remaining-time'); // Hidden input to store remaining time

        const countdown = setInterval(() => {
            if (timer > 0) {
                timer--; // Decrement the timer
                timerElement.textContent = timer; // Update the timer display
                remainingTimeInput.value = timer; // Update the hidden input with the remaining time
            } else {
                clearInterval(countdown); // Stop the timer when it reaches 0
                timerElement.textContent = "0"; // Display 0 when time is up
                window.location.href = '{{ route('game.end') }}'; // Redirect to the end popup page
            }
        }, 1000); // Decrease timer every 1 second
    </script>
</body>
@endsection
