<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Over - Level 1</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="background-color: #000; color: #fff; display: flex; align-items: center; justify-content: center; min-height: 100vh; font-family: Arial, sans-serif;">
    <script>
        /**
         * Function to display the game end popup
         */
        function showEndPopup() {
            const score = {{ session('score', 0) }}; // Get the score dynamically

            Swal.fire({
                title: 'Game Over!',
                html: `
                    <p>Your final score is <strong>${score}</strong>.</p>
                    <p style="color: #fff; font-weight: bold;">Don't forget to save your score!</p>
                    <div style="margin-top: 20px; display: flex; justify-content: center; gap: 10px;">
                        <button id="restart-btn" style="padding: 10px 20px; background-color: #4CAF50; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                            Restart Game
                        </button>
                        <button id="next-level-btn" style="padding: 10px 20px; background-color: #2196F3; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                            Next Level
                        </button>
                        <button id="save-score-btn" style="padding: 10px 20px; background-color: #FF5722; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
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
                            // Show second popup after saving the score
                            Swal.fire({
                                title: 'Success!',
                                html: `
                                    <p>Your score has been saved.</p>
                                    <div style="margin-top: 20px; display: flex; justify-content: center; gap: 10px;">
                                        <button id="second-popup-restart-btn" style="padding: 10px 20px; background-color: #4CAF50; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                                            Restart Game
                                        </button>
                                        <button id="second-popup-next-level-btn" style="padding: 10px 20px; background-color: #2196F3; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                                            Next Level
                                        </button>
                                    </div>
                                `,
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false,
                                allowOutsideClick: false,
                            });

                            // Handle second popup button clicks
                            document.addEventListener('click', (e) => {
                                if (e.target.id === 'second-popup-restart-btn') {
                                    window.location.href = '{{ route("game.index") }}'; // Redirect to restart the game
                                }
                                if (e.target.id === 'second-popup-next-level-btn') {
                                    window.location.href = '{{ route("next-game") }}'; // Redirect to the next level
                                }
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
</body>
</html>
