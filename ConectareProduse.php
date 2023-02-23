<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'magazin_proiect';
    $mysqli = new mysqli($hostname, $username, $password,$db); /* se verifica daca s-a realizat conexiunea */
    if(!mysqli_connect_errno())
    {
        echo 'The connection to the database was made: '. $db; // $mysqli->close();
    }
    else {
        echo 'Unable to connect to the database';
        exit();
    }
    echo "<body style='background-color:#b37ffc'>";
?>
