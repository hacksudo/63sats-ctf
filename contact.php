<?php
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fake validation: Never upload
    $message = "Error: File could not be uploaded. Please try again later.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fake Contact Form</title>
    <style>
        body {
            background: #000;
            color: #00ff00;
            font-family: monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #111;
            border: 2px solid #00ff00;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 0 15px #00ff00;
        }
        h2 {
            margin-bottom: 20px;
            color: #00ff00;
        }
        label {
            display: block;
            margin-top: 10px;
            text-align: left;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #00ff00;
            background: #000;
            color: #00ff00;
            border-radius: 5px;
        }
        input[type="submit"] {
            margin-top: 20px;
            cursor: pointer;
            font-weight: bold;
        }
        .message {
            margin-top: 15px;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Contact Us</h2>
        <form method="post" enctype="multipart/form-data">
            <label for="name">Your Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Your Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="4" required></textarea>

            <label for="file">Attach a File:</label>
            <input type="file" name="file" id="file">

            <input type="submit" value="Send Message">
        </form>

        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
