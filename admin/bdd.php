<?php
/** Connexion à la base de donnée */
try
{
    $bdd = new PDO('mysql:host=localhost; dbname=lister_bdd;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur :'. $e->getMessage());
}

?>