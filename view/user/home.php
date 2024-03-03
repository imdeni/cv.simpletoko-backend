<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo '<script>
        alert("Please login first!");
        window.location.href = "index.php";
        </script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME!</title>
    <!-- Link -->
    <link rel="stylesheet" href="../../assets/mystyle.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
</head>

<body>

    <?php include 'component/nav.php'; ?>

    <div id="homeContent">
        <hr />
        <div class="row">
            <div class="column">
                <b>
                    <h1>Welcome to Flortem!</h1>
                </b>
                <div class="p1">
                    <h3>Great Product is built by great teams!</h3>
                    <p>We help build and manage a team of world-class developers to bring your vision to life.</p>
                </div>
                <button><a href="https://wa.me/08997110638" type="button">Contact Us!</a></button>
                <footer>
                    <h2><b>Flortem</b></h2>
                    <p>Copyright 2023</p>
                </footer>
            </div>
            <div class="column1">
                <img src="../../icon/developer.png" width="600px" height="500px">
            </div>
        </div>
    </div>

</body>
</html>