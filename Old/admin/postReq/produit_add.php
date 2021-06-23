<?php
if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}


/** Connexion a la base de donnée */
require_once '../utility/bdd.php';
/* tableau contenant les messages d'erreurs */
$errors=array();


/* ajout produit si soumission formulaire */
if(isset($_POST['insertProd']) && $_POST['insertProd']=='ajouter'){
    $name = isset($_POST['name'])?$_POST['name']:'';
    $idCategorie = isset($_POST['categorie'])?$_POST['categorie']:'';

    var_dump($name, $idCategorie);

    /* mise en forme du nom */
    $name = ucfirst(strtolower($name));

    //si une des variables est vide
    if(empty($name) || empty($idCategorie))
    {
        $errors['vide']= 'un des champs n\'est pas remplis correctement'; 
    }
    else
    {
        // on verifie qu'il nexiste pas deja
        $sql = 'SELECT * FROM produits WHERE produit_name=:name';
        $reponse = $bdd->prepare($sql);
        $reponse->execute(['name'=>$name]);
        $produit=$reponse->fetch(); 
        if($produit){
            $errors['existe']='le produit existe déjà';
        }
    }

    /* on verifie le format de name, alphabetique uniquement*/
    //$errors['format']= ctype_alpha($name)?'':'Mauvais format de données';
    if ( !preg_match('/^[a-zA-Z -]+$/',$name))
    {
        $errors['format']= 'Mauvais format de données';
    }


    if(empty($errors))
    {
        $req = $bdd->prepare('INSERT INTO produits( produit_name,categorie_id) VALUE ( :name, :id)');
        $req->execute(['name'=>$name,'id'=>$idCategorie]);
        $_SESSION['alerte']['success']= 'Ajout du produit suivant - Nom :'.$name.', id catégorie : '.$idCategorie;
        header('Location: ../controleProduit.php?alerte=ok');
        exit();
    }
    else
    {
        $_SESSION['alerte']['echec'] = $errors;
        header('Location: ../controleProduit.php?alerte=fail');
    }
}




?>