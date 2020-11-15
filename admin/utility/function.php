<?php 

require_once 'bdd.php';
/** 
*   Renvoi un li avec le lien d'un page, gestion animation lien actif ($class)
*/
function nav_items(string $lien, string $class='', string $name ):string{

    $path = '/ListerProject/admin/'.$lien;
    if($_SERVER['SCRIPT_NAME'] === $path ){
        
        $html= "<li class='".$class."'><a href='".$lien."'>".$name."</a></li>";
    }else{
        $html= "<li><a href='".$lien."'>".$name."</a></li>";
    }
    return $html;

}

/**
 *  Crée la liste de navigation des tables de la BDD
 */

function nav_tables(string $class):string{
    return
    nav_items('controleCenter.php', $class,'Table users' ).
    nav_items('controleProduit.php', $class,'Table produit' ).
    nav_items('controleCategorie.php', $class,'Table catégorie' ).
    nav_items('controleListe.php', $class,'Table Liste' );
}

/**
 *  Compte le nombre de ligne d'une table
 */

function nb_row_table(string $tableName, PDO $bdd):int{

    $requete = 'SELECT COUNT(*) as numb_row FROM :name';
    $reponse= $bdd->prepare($requete);
    $reponse->bindValue('name',$tableName,PDO::PARAM_INT);
    $reponse->execute();
    $result = $reponse->fetch();
    return (int)$result['numb_row'];
}



?>
