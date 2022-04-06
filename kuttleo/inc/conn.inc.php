<?php

function connectMysql()
{


    $user = 'root';
    $pass = '';
    $base = 'spectacle';


    $dsn = 'mysql:host=localhost;dbname=' . $base . ';charset=UTF8';
    try {
        $dbh = new PDO($dsn, $user, $pass);

        /*** les erreurs sont gérées par des exceptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        print "erreur ! :" . $e->getMessage() . "<br/>";
        die();
    }

    return $dbh;


}