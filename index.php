<?php
session_start();

// Handle login
if (isset($_POST['password']) && $_POST['password'] === '1234') {
    $_SESSION['ctf_logged_in'] = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Easy CTF | 63sats CyberTech Limited</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: black;
            color: #00ff00;
            font-family: monospace;
            text-align: center;
            height: 100vh;
            overflow: hidden;
        }
        h1 {
            margin-top: 15%;
            font-size: 42px;
            animation: glow 2s infinite alternate;
        }
        p {
            font-size: 20px;
            color: #0ff;
        }
        @keyframes glow {
            from { text-shadow: 0 0 10px lime, 0 0 20px cyan; }
            to { text-shadow: 0 0 25px red, 0 0 40px lime; }
        }
        .hidden-login {
            position: absolute;
            bottom: 20px;
            right: 20px;
            display: none;
        }
        .dashboard {
            display: none;
            margin-top: 100px;
            animation: fadeIn 2s ease-in-out;
        }
        .flag {
            font-size: 28px;
            margin-top: 40px;
            color: red;
            font-weight: bold;
            text-shadow: 0 0 15px lime, 0 0 30px cyan;
            animation: pulse 1s infinite alternate;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes pulse {
            from { opacity: 0.5; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>

<?php if (!isset($_SESSION['ctf_logged_in'])): ?>
    <!-- Landing Page -->
    <h1>🚩 Welcome to Easy CTF 🚩</h1>
    <p>63sats CyberTech Limited presents:</p>
    <p><strong>Your challenge is to find the ROOT FLAG.</strong></p>

    <!-- Hidden Login -->
    <form method="POST" class="hidden-login" id="hiddenLogin">
        <input type="password" name="password" placeholder="Enter password">
        <button type="submit">Login</button>
    </form>

    <script>
        // KJSXMZLBNQSTEMDMN5TWS3RFGIYGM33SNUSTEMDXNF2GQJJSGBBXI4TMEUZEEU3INFTHIJJSIJGA====
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.shiftKey && e.key === 'L') {
                document.getElementById('hiddenLogin').style.display = 'block';
            }
        });
    </script>

<?php else: ?>
    <!-- Hacker Dashboard -->
    <div class="dashboard">
        <h1>Access Granted ⚡</h1>
        <p>Welcome, Hacker 👾</p>
        <div class="flag">🚩  FLAG 1: authentication_bypass_success 🚩</div>
    </div>
    <script>
        document.querySelector('.dashboard').style.display = 'block';
    </script>
<?php endif; ?>

</body>
</html>
