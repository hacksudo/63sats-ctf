<?php
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fake check (does not upload file)
    $error = "Error: File not uploaded. Please try again.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fake File Upload</title>
    <style>
        body {
            background: black;
            color: #00ff00;
            font-family: monospace;
            text-align: center;
            padding-top: 100px;
        }
        .container {
            border: 2px solid #00ff00;
            display: inline-block;
            padding: 20px;
            border-radius: 10px;
            background: #111;
            box-shadow: 0 0 10px #00ff00;
        }
        input[type="file"], input[type="submit"] {
            margin: 10px 0;
            background: black;
            color: #00ff00;
            border: 1px solid #00ff00;
            padding: 10px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload Your File</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="file" required><br>
            <input type="submit" value="Upload">
        </form>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
