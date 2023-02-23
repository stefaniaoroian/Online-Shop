<?php // connectare bazadedate
echo "<body style='background-color:#b37ffc'>";
include("ConectareProduse.php");
$error='';
//Modificare datelor
// se preia id din pagina vizualizare

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        // verificam daca id-ul din URL este unul valid
        if (is_numeric($_POST['id'])) {
            // preluam variabilele din URL/form
            $id = $_POST['id'];
            $name = htmlentities($_POST['name'], ENT_QUOTES);
            $code = htmlentities($_POST['code'], ENT_QUOTES);
            $price = htmlentities($_POST['price'], ENT_QUOTES);
            $description = htmlentities($_POST['description'], ENT_QUOTES);
            $image = htmlentities($_POST['image'], ENT_QUOTES);
            $category = htmlentities($_POST['category'], ENT_QUOTES);

            // verificam daca numele, prenumele, an si grupa nu sunt goale
            if ($name == '' || $code == ''||$price==''||$description==''||$image==''||$category=='') {
                // daca sunt goale afisam mesaj de eroare
                echo "<div> ERROR: Complete the mandatory fields!</div>";
            } else { // daca nu sunt erori se face update name, code, image, price, description, category
                if ($stmt = $mysqli->prepare("UPDATE produse SET name=?, code=?, price=?, description=?, image=?, category=? WHERE id='".$id."'")) {
                    $stmt->bind_param("ssdsss", $name, $code, $price, $description, $image, $category);
                    $stmt->execute();
                    $stmt->close();
                } // mesaj de eroare in caz ca nu se poate face update
                else {
                    echo "ERROR: Cannot execute update.";
                }
            }
        }
        // daca variabila 'id' nu este valida, afisam mesaj de eroare
        else {
            echo "invalid id!";
        }
    }
} ?>

<html>
<head>
    <title> <?php if ($_GET['id'] != '')
        {
            echo "Change registration";
        } ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>

<body>
    <h1><?php if ($_GET['id'] != '')
        {
            echo "Change registration";
        } ?>
    </h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="" method="post">
        <div>
            <?php if ($_GET['id'] != '') { ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
            <p>ID: <?php echo $_GET['id'];
                if ($result = $mysqli->query("SELECT * FROM produse where id='" . $_GET['id'] . "'")) {
                if ($result->num_rows > 0) {
                $row = $result->fetch_object(); ?>
            </p>
            <strong>Name: </strong> <input type="text" name="name" value="<?php echo $row->name; ?>" /><br />
            <strong>Code: </strong> <input type="text" name="code" value="<?php echo $row->code; ?>" /><br />
            <strong>Price: </strong> <input type="text" name="price" value="<?php echo $row->price; ?>" /><br />
            <strong>Description: </strong> <input type="text" name="description" value="<?php echo $row->description; ?>" /><br />
            <strong>Image: </strong> <input type="text" name="image" value="<?php echo $row->image; ?>" /><br />
            <strong>Category: </strong> <input type="text" name="category" value="<?php echo $row->category;}}} ?>" /><br /><br />
            <input type="submit" name="submit" value="Submit" />
            <a href="VizualizareProduse.php">Index</a>
        </div>
    </form>
</body>
</html>
