@extends('layout.main_layout')

@section('content')
<div class="bg-blue-900 min-h-screen flex items-center justify-center">
    <div class="bg-blue-800 p-6 rounded-lg shadow-lg max-w-md mx-auto">
        <h1 class="text-2xl font-bold text-white mb-4">Game Over!</h1>

        <p class="text-lg text-white mb-4">Your final score is <strong class="text-yellow-500">{{ session('score', 0) }}</strong>.</p>

        <p class="text-white font-semibold mb-4">Don't forget to save your score!</p>

        <div class="flex justify-center space-x-4 mt-6">
            <button id="restart-btn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none">
                Restart Game
            </button>

            <button id="next-level-btn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
                Next Level
            </button>

            <button id="save-score-btn" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 focus:outline-none">
                Save Your Score
            </button>
        </div>
    </div>
</div>

<script>
    // Bevestigingsmelding tonen
    function showEndPopup() {
        const score = {{ session('score', 0) }}; // Get the score dynamically

        Swal.fire({
            title: 'Game Over!',
            html: `
                <p class="text-white">Your final score is <strong class="text-yellow-500">${score}</strong>.</p>
                <p class="text-white font-bold">Don't forget to save your score!</p>
                <div class="mt-6 flex justify-center space-x-4">
                    <button id="restart-btn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none">
                        Restart Game
                    </button>
                    <button id="next-level-btn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
                        Next Level
                    </button>
                    <button id="save-score-btn" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 focus:outline-none">
                        Save Your Score
                    </button>
                </div>
            `,
            icon: 'success',
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,
        });

        // Attach click event listeners to buttons
        document.addEventListener('click', (e) => {
            if (e.target.id === 'restart-btn') {
                window.location.href = '{{ route("game.index") }}'; // Redirect to restart the game
            }
            if (e.target.id === 'next-level-btn') {
                window.location.href = '{{ route("next-game") }}'; // Redirect to the next level
            }
            if (e.target.id === 'save-score-btn') {
                const score = {{ session('score', 0) }};
                fetch('{{ route("save.score") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ score: score }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Score saved successfully!', '', 'success').then(() => {
                            Swal.fire({
                                title: 'Game Over!',
                                html: `
                                    <p class="text-white">Your final score is <strong class="text-yellow-500">${score}</strong>.</p>
                                    <p class="text-white font-bold">What would you like to do next?</p>
                                    <div class="mt-6 flex justify-center space-x-4">
                                        <button id="restart-btn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none">
                                            Restart Game
                                        </button>
                                        <button id="next-level-btn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
                                            Next Level
                                        </button>
                                    </div>
                                `,
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false,
                                allowOutsideClick: false,
                            });
                        });
                    } else {
                        Swal.fire('Failed to save the score', '', 'error');
                    }
                });
            }
        });
    }

    /**
     * Show the end popup when the DOM is fully loaded
     */
    document.addEventListener('DOMContentLoaded', (event) => {
        showEndPopup();
    });
</script>
@endsection
