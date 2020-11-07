<?php

/** connexion a la base de donné **/
require_once '../bdd.php';

if(empty($_GET['choix'])  || $_GET['choix']=='denied')
{
    header ('location: ../controleProduit.php');
    exit();
}elseif(!empty($_GET['choix']) && $_GET['choix']=='confirme'){
    /* requete sql */
    $idDelete = isset($_GET['idDelete'])?$_GET['idDelete']:null;
    $sql = 'DELETE FROM produits WHERE id = :id';
    $req = $bdd->prepare($sql);
    $req->execute(['id'=>$idDelete]);

    header('location: ../controleProduit.php');
    exit();
}


?>