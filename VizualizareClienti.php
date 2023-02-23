<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>View Records</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> </head>
<body>
    <h1>Records from the customer table:</h1>
<button>
    <a href = "HomeAdmin.php">Home admin</a>
</button>
<?php
    echo "<body style='background-color:#b37ffc'>";
    // connectare bazadedate
    include("ConectareClienti.php");
    //se preiau inregistrarile din baza de date
    if ($result = $mysqli->query("SELECT * FROM clienti ORDER BY id ")) { // Afisare inregistrari pe ecran
        if ($result->num_rows > 0)
        {
            // afisarea inregistrarilor intr-o table
            echo "<table border='1' cellpadding='10'>";
            // antetul tabelului
            echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>Email</th><th></th></tr>";
            while ($row = $result->fetch_object()) {
                // definirea unei linii pt fiecare inregistrare
                echo "<tr>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->username . "</td>";
                echo "<td>" . $row->password . "</td>";
                echo "<td>" . $row->email . "</td>";
                echo "<td><a href='StergereClienti.php?id=" .$row->id . "'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        // daca nu sunt inregistrari se afiseaza un rezultat de eroare
        else
        {
            echo "There are no records in the table!";
        }
    }
    // eroare in caz de insucces in interogare
    else
    { echo "Error: " . $mysqli->error(); }
    // se inchide
    $mysqli->close();
?>
</body>
</html>
