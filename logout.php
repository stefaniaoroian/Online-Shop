<?php
    session_start();
    session_destroy();
    //redirectionare pagina principala produse
    header('Location: magazin.php');
?>
