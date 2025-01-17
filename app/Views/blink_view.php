<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eye Blink Detection</title>
</head>

<body>

    <h1>Eye Blink Detection</h1>
    <div>
        <img src="http://localhost:5000/video_feed" style="width: 720px; height: 480px;" />
    </div>

    <button id="checkBlink">Check Blink</button>
    <p id="result"></p>

    <script>
        document.getElementById('checkBlink').addEventListener('click', async () => {
            try {
                const response = await fetch('http://localhost:5000/check_blink');
                const data = await response.json();

                if (data.status === "success") {
                    // Redirect ke halaman baru
                    window.location.href = "<?= base_url('blink/attendanceSuccess') ?>";
                } else {
                    document.getElementById('result').textContent = data.message;
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>

    <script>
        function checkBlink() {
            fetch('http://localhost:5000/check_blink') // Endpoint Flask
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        window.location.href = data.redirect; // Redirect ke halaman baru
                    } else {
                        console.log(data.message); // Log jika tidak ada kedipan
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

</body>

</html>