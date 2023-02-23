<?php
    echo "<body style='background-color:#b37ffc'>";
    // conectare la baza de date database
    include("ConectareClienti.php");
    // se verifica daca id-ul a fost primit
    if (isset($_GET['id']) && is_numeric($_GET['id']))
    {
        // preluam variabila 'id' din URL
        $id = $_GET['id'];
        // stergem inregistrarea cu ib=$id
        if ($stmt = $mysqli->prepare("DELETE FROM clienti WHERE id = ? LIMIT 1"))
        {
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $stmt->close();
        }
        else
        {
            echo "ERROR: Cannot execute delete.";
        }
        $mysqli->close();
        echo "<div>The recording has been deleted!!!!</div>";
    }
    echo "<p><a href=\"VizualizareClienti.php\">Index</a></p>";
?>