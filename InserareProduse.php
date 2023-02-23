<?php
    echo "<body style='background-color:#ba9be8'>";
    include("ConectareProduse.php");
    $error='';
    if (isset($_POST['submit'])) {
        //preluam datele de pe formular
        $name = htmlentities($_POST['name'], ENT_QUOTES);
        $code = htmlentities($_POST['code'], ENT_QUOTES);
        $price = htmlentities($_POST['price'], ENT_QUOTES);
        $description = htmlentities($_POST['description'], ENT_QUOTES);
        $image = htmlentities($_POST['image'], ENT_QUOTES);
        $category = htmlentities($_POST['category'], ENT_QUOTES);
        // verificam daca sunt completate campurile
        if ($name == '' || $code == '' || $price =='' || $description =='' || $image=='' || $category=='')
        {
            //daca sunt campuri goale se afiseaza un mesaj
            $error = 'ERROR: Empty fields!';
        } else {
            //inserare
            if ($stmt = $mysqli->prepare("INSERT into produse (name, code, price, description, image, category) VALUES (?, ?, ?, ?,?,?)")) {
                $stmt->bind_param("ssdsss", $name, $code, $price, $description, $image, $category);
                $stmt->execute();
                $stmt->close();
            }
            // eroare le inserare
            else
            {
                echo "ERROR: Cannot execute insert."; }
        }
    }
    // se inchide conexiune mysqli
    $mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title><?php echo "Insert record"; ?> </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
        <h1><?php echo "Insert record"; ?></h1>
        <?php if ($error != '') {
            echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
        <form action="" method="post">
            <div>
                <strong>Name: </strong> <input type="text" name="name" value=""/><br/>
                <strong>Code: </strong> <input type="text" name="code" value=""/><br/>
                <strong>Price: </strong> <input type="text" name="price" value=""/><br/>
                <strong>Description: </strong> <input type="text" name="description" value=""/><br/>
                <strong>Image: </strong> <input type="text" name="image" value=""/><br/>
                <strong>Category: </strong> <input type="text" name="category" value=""/><br/><br/>
                <input type="submit" name="submit" value="Submit" />
                <a href="VizualizareProduse.php">Index</a>
            </div>
        </form>
    </body>
</html>
