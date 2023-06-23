<?php

     session_start();

     if (
        !isset ($_POST['anfangszeit']) 
        || !isset($_POST['endezeit']) 
        || !isset ($_POST['mitarbeiterid'])
    )
    {
        echo ' renseignez les champs';
        return;
    }  

    $debut= $_POST['anfangszeit'];
    $fin= $_POST['endezeit'];
    $employee= $_POST['mitarbeiterid'];

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
    $insertdaten = $mysqlClient->prepare('INSERT INTO einsatz(anfangszeit,endezeit, mitarbeiterid ) VALUES (:X,:Y,:Z)');
    $insertdaten->execute([
        'X' => $debut,
        'Y' => $fin,
        'Z' => $employee,

    ]);


?>