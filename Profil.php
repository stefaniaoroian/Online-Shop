<?php
echo "<body style='background-color:#ba9be8'>";
    session_start();
    //daca clientul nu este logat va fi directionat spre login page
    if(!isset($_SESSION['loggedin'])){
        header('Location: indexProfil.html');
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<div class="content">
    <h1>Welcome to your profile:  <?=$_SESSION['name']?>!</h1> </div>
<body class="loggedin">
    <div class="context">
        <h2 class="Welcome">Username: <?= $_SESSION['name'] ?></h2>
        <h2 class="Welcome">Email: <?php
            if(isset($_SESSION['email']))
                echo $_SESSION['email'] ?>
        </h2>
    </div>
    <nav class="navtop">
        <div>
            <h2>Choose one:</h2>
            <a href="magazin.php"><i class="fas fa-book fa-fw"></i>Magazin</a>  <br>
            <a href="Home.php"><i class="fas fa-user-circle"></i>Home</a> </div>
        <a href="HomeAdmin.php"><i class="fas fa-user-circle"></i>Home Admin</a> <br>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a> </div>
    </nav>
</body>
</html>
