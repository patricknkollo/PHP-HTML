<?php

     session_start();

    if (
        !isset ($_POST['name']) 
        || !isset($_POST['vorname']) 
        || !isset ($_POST['password'])
        || !isset ($_POST['geschlecht'])
        || !isset ($_POST['geburtsdatum']) 
    )
    {
        echo ' renseignez les champs';
        return;
    } 

    $nom= $_POST['name'];
    $vorname= $_POST['vorname'];
    $passwort= $_POST['password'];
    $geschlecht= $_POST['geschlecht'];
    $geburtsdatum= $_POST['geburtsdatum'];
    $email= $_POST['email'];

    try
        {
               // On se connecte à MySQL
            $mysqlClient = new PDO( sprintf('mysql:host=localhost;dbname=zeiterfassung;port=3306' ), 'root', 'root');
            $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    catch(Exception $e)
        {
                // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
        }
    $insertdaten = $mysqlClient->prepare('INSERT INTO mitarbeiter(name,vorname, geschlecht, geburtsdatum, password, Emailadresse ) VALUES (:nom,:vorname,:geschlecht,:geburtsdatum,:passwort,:email)');
    $insertdaten->execute([
        'nom' => $nom,
        'vorname' => $vorname,
        'geschlecht' => $geschlecht,
        'geburtsdatum' => $geburtsdatum,
        'passwort' => $passwort,
        'email' => $email,

    ]);


?>