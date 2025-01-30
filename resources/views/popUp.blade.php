<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Game - Level 1</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="background-color: #000; color: #fff; padding: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh; font-family: Arial, sans-serif;">

    <h1>Level 1</h1>
    <p>Form words from the given letters and complete this level.</p>
    <p>Form words from the given hints and complete this level.</p>
    <div id="game-area">
        <!-- Game interactions will be loaded here -->
    </div>

    <script>
        /**
         * Function to show the game introduction
         */
        function showGameIntro() {
            Swal.fire({
                title: 'Welcome to the Game!',
                html: `
                    <p>Welcome to the exciting word game! Before you begin, please review the rules:</p>
                    <ul style="list-style-type: disc; padding-left: 20px;">
                        <li> <strong>   Finish </strong>as many words as possible.</li>
                        <li>Each correct guess gives you  <strong>   100 points. </strong></li>
                        <li>A wrong guess  <strong>   deducts 100 points</strong> from your score.</li>
                        <li>Use the hints and guess as many words as you can!</li>
                    </ul>
                   <strong>   <p>Good luck!</p> </strong>
                `,
                icon: 'info',
                showCancelButton: false,
                confirmButtonText: 'Start the Game Now',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.close();
                }
            });
        }

        /**
         * Event listener to execute the function once the DOM is fully loaded
         */
        document.addEventListener('DOMContentLoaded', (event) => {
            showGameIntro();
        });
    </script>
</body>
</html>
