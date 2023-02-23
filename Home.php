<?php
    echo "<body style='background-color:#ba9be8'>";
    session_start();
    //daca utilizatorul nu este logat se redirectioneaza la pagina de login
    if (!isset($_SESSION['loggedin']))
    {
        header('Location: indexHome.html');
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home page</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <div class="content">
        <h1>Welcome, <?=$_SESSION['name']?>!</h1>
    </div>
    <body class="loggedin"> <nav class="navtop">
        <div>
            <h2>Choose one:</h2>
            <a href="magazin.php"><i class="fas fa-book fa-fw"></i>Magazin</a>  <br>
            <a href="Profil.php"><i class="fas fa-user-circle"></i>Profil</a> </div>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a> </div>
        </nav>
    </body>
</html>
