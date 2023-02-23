<?php

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = "";
    $DATABASE_NAME = 'magazin_proiect';
    //incerc sa ma conectez pe baza informatiilor de mai sus
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    if (mysqli_connect_errno()) {
        //in cazul aparitiei unei erori la conexiune se opreste scriptul si se afiseaza eroarea
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

    if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
        //nu s-au putut obtine datele care au fost trimise
        exit('Complete registration form !');
    }

    //ne asiguram ca valorile formularului nu sunt goale
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        //unul sau mai multe campuri sunt goale
        exit('Complete registration form !');
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        exit('The email is not valid !');
    }

    if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
        exit('The username is not valid !');
    }

    if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
        exit('The password must have between 5 and 20 characters !');
    }

    //verificam daca este existent contul de utilizator
    if ($stmt = $con->prepare('SELECT id, password FROM user_admin WHERE username = ?')) {
        // hash parola folosind funcția PHP password_hash.
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        // se memoreaza rezultatul astfel incat sa putem verifica daca exista contul in baza de date
        if ($stmt->num_rows > 0) {
            //username-ul exista
            echo 'Username exists, choose another one !';
        } else {
            if ($stmt = $con->prepare('INSERT INTO user_admin (username, password, email) VALUES (?, ?, ?)')) {
                // folosim password_hash deoarece nu dorim sa expunem parole in baza noastra de date
                //password_verify atunci când un utilizator se conecteaza si verifica daca unei parole i se potriveste un hash
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
                $stmt->execute();
                echo 'Registered successfully !';
                header('Location: indexlAdmin.html');
            } else {
                //declaratia SQL nu este in regula
                //se verifica daca in tabela clienti exista toate cele 3 campuri
                echo 'Cannot execute prepare statement !';
            }
        }
        $stmt->close();
    } else {
        //declaratia SQL nu este in regula
        //se verifica daca in tabela clienti exista toate cele 3 campuri
        echo 'Cannot execute prepare statement !';
    }
    $con->close();
?>
