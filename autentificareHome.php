<?php
session_start();
//informatii pentru conectare
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'magazin_proiect';
//incerc sa ma conectez pe baza informatiilor de mai sus
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if ( mysqli_connect_errno() ) {
    //in cazul aparitiei unei erori la conexiune se opreste scriptul si se afiseaza eroarea
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//se verifica daca datele din formular au fost transmise
//isset () verifica daca datele exista deja
if ( !isset($_POST['username'], $_POST['password']) ) {
    //nu s-au putut obține datele care ar fi trebuit trimise
    exit('Complete username and password !');
}

// se pregateste SQL-ul
if ($stmt = $con->prepare('SELECT id, password FROM clienti WHERE username = ?')) {
    // parametrii de legare (s = sir, i = int, b = blob etc.)
    $stmt->bind_param('s', $_POST['username']);// folosim s deoarece numele de utilizator este un sir de caractere
    $stmt->execute();
    $stmt->store_result(); //se stocheaza rezultatul pentru a putea verifica dacă contul exista in baza de date
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();//se aduc datele
        //contul exista, acum se verifica parola
        if (password_verify($_POST['password'], $password)) {
            // se creaza sesiuni astfel incat sa stim ca utilizatorul este conectat
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            echo 'Welcome ' . $_SESSION['name'] . '!';
            header('Location: Home.php');
        } else {
            //parola incorecta
            echo 'Incorrect username or password!';
        }
    } else {
        //username incorect
        echo 'Incorrect username or password!';
    }
    $stmt->close();
}
?>
