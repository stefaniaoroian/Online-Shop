<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>View Records</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> </head>
<body>
<h1>Records from the product table:</h1>
<button>
    <a href = "HomeAdmin.php">Home admin</a>
</button>
<?php
    echo "<body style='background-color:#b37ffc'>";
    // connectare bazadedate
    include("ConectareProduse.php");
    // se preiau inregistrarile din baza de date
    if ($result = $mysqli->query("SELECT * FROM produse ORDER BY id ")) { // Afisare inregistrari pe ecran
        if ($result->num_rows > 0)
        {
            // afisarea inregistrarilor intr-o table
            echo "<table border='1' cellpadding='10'>";
            // antetul tabelului
            echo "<tr><th>ID</th><th>Product Name</th><th>Code</th><th>Price</th><th>Description</th><th>Image</th><th>Category</th><th></th><th></th></tr>";
            while ($row = $result->fetch_object()) {
                // definirea unei linii pt fiecare inregistrare
                echo "<tr>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->name . "</td>";
                echo "<td>" . $row->code . "</td>";
                echo "<td>" . $row->price . "</td>";
                echo "<td> " . $row->description . "</td>";
                echo "<td>" . "<img src= '$row->image' style='width: 50px'>" . "</td>";
                echo "<td>"  . $row->category . "</td>";
                echo "<td><a href='ModificareProduse.php?id=" . $row->id . "'>Modify</a></td>"; echo "<td><a href='StergereProduse.php?id=" .$row->id . "'>Delete</a></td>";
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
<a href="InserareProduse.php">Add new record</a>
</body>
</html>
