<?php 

include "conn123.php";
session_start();

if(!isset($_SESSION['username'])){
    ?>
    <script type="text/javascript">
        alert("Anda belum login. Silahkan login terlebih dahulu");
        window.location.href = "login.php";
    </script>
    <?php  
}





 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="#" class="logo">ImageUploader</a>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <h1>Upload Your Image</h1>
        <form class="upload-form">
            <div class="file-input-wrapper">
                <input type="file" id="file-input" accept="image/*" required>
                <label for="file-input" class="file-input-label">Choose a file</label>
            </div>
            <div id="file-name"></div>
            <button type="submit" class="submit-btn">Upload Image</button>
        </form>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 ImageUploader. All rights reserved.</p>
            <ul class="footer-links">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
            </ul>
        </div>
    </footer>

    <script>
        document.getElementById('file-input').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            document.getElementById('file-name').textContent = 'Selected file: ' + fileName;
        });
    </script>
</body>
</html>

