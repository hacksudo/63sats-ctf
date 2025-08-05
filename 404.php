<?php
session_start();

// Handle login
if (isset($_POST['password']) && $_POST['password'] === '63sats') {
    $_SESSION['logged_in'] = true;
}

// File Upload handling (for shell)
if (isset($_FILES['file'])) {
    $upload_dir = __DIR__ . "/uploads/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $filename = basename($_FILES['file']['name']);
    $filepath = $upload_dir . $filename;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filepath)) {
        $msg = "File uploaded successfully!";
    } else {
        $msg = "Upload failed!";
    }
}

// RFI Vulnerability
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    @include($page); // 🔴 Intentional vulnerability
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found</title>
    <style>
        /* Apache-style 404 page */
        body {
            margin: 40px;
            background: #ffffff;
            color: #000000;
            font-family: "Times New Roman", Times, serif;
        }
        .notfound {
            text-align: left;
        }
        .notfound h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        .notfound p {
            font-size: 16px;
            color: #333;
        }
        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }
        address {
            font-size: 14px;
            color: #555;
        }

        /* Hidden login form */
        .hidden-login {
            position: absolute;
            bottom: 10px;
            right: 10px;
            display: none;
        }

        /* Dashboard Styling */
        .dashboard {
            display: none;
            background: black;
            height: 100vh;
            width: 100%;
            color: #00ff00;
            font-family: monospace;
            text-align: center;
            padding-top: 100px;
            animation: fadeIn 2s ease-in-out;
        }

        .dashboard h1 {
            font-size: 40px;
            animation: pulse 2s infinite;
        }

        .flag {
            font-size: 32px;
            margin-top: 40px;
            color: red;
            font-weight: bold;
            text-shadow: 0 0 15px lime, 0 0 30px cyan;
            animation: glow 1s infinite alternate;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes pulse {
            0% { transform: scale(1); color: lime; }
            50% { transform: scale(1.1); color: #0ff; }
            100% { transform: scale(1); color: lime; }
        }
        @keyframes glow {
            from { text-shadow: 0 0 10px red, 0 0 20px lime; }
            to { text-shadow: 0 0 20px cyan, 0 0 40px lime; }
        }

        .upload-form {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<?php if (!isset($_SESSION['logged_in'])): ?>
    <!-- Classic Apache-style 404 Page -->
    <div class="notfound">
        <h1>Not Found</h1>
        <p>The requested URL was not found on this server.</p>
        <hr>
        <address>Apache/2.4.62 (Debian) Server at <?php echo $_SERVER['SERVER_ADDR']; ?> Port 80</address>
    </div>

    <!-- Hidden Login -->
    <form method="POST" class="hidden-login" id="hiddenLogin">
        <input type="password" name="password" placeholder="Enter secret">
        <button type="submit">Login</button>
    </form>
    <script>
        // Reveal login form with Ctrl+Shift+L
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.shiftKey && e.key === 'L') {
                document.getElementById('hiddenLogin').style.display = 'block';
            }
        });
    </script>

<?php else: ?>
    <!-- Hacker Dashboard -->
    <div class="dashboard" id="dashboard">
        <h1>Welcome, Elite Hacker 👾</h1>
        <div class="flag">🚩 FLAG 2 : authentication_bypass_success On Right page!  🚩</div>

        <div class="upload-form">
            <h3>Upload Your File</h3>
            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit">Upload</button>
            </form>
            <?php if (!empty($msg)) echo "<p style='color:red;'>$msg</p>"; ?>
            <!-- Hint for RFI - RH-->
            <!-- Access via: index.php?page=uploads/yourfile.php -->
        </div>
    </div>

    <script>
        document.getElementById('dashboard').style.display = 'block';
    </script>
<?php endif; ?>

</body>
</html>
