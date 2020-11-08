<?php

$idproduit=null;
$idCategorie=null;
$name='';
$nameCategorie='';

/** Connexion a la base de donnée */
require_once '../bdd.php';

/* recuperation de l'id */
if(isset($_GET['choix']) && $_GET['choix']=='Confirme'){
    $id = $_GET['idDelete'];
}else{
    $id= isset($_GET['id'])? $_GET['id']:null;
}


/* recuperation des données lié a l'id */ 
$sql = 'SELECT * FROM produits WHERE id = :id';
$reponse = $bdd->prepare($sql);
$reponse->execute(['id'=>$id]);
while($produit=$reponse->fetch())
{
    $idproduit = $produit['id'];
    $name = $produit['name'];
    $idCategorie = $produit['id_categorie'];
}

/* nom de la catégorie */
$sql = 'SELECT name FROM categories WHERE id = :id';
$reponse = $bdd->prepare($sql);
$reponse->execute(['id'=>$idCategorie]);

while($info = $reponse->fetch()){
    $nameCategorie=$info['name'];
}


/* a la soumission du formulaire */

if(isset($_GET['choix']) && $_GET['choix']==='Confirme')
{
    
    /* requete sql */
    $idDelete = isset($_GET['idDelete'])?$_GET['idDelete']:null;
    $sql = 'DELETE FROM produits WHERE id = :id';
    $req = $bdd->prepare($sql);
    $req->execute(['id'=>$idDelete]);

    header('location: ../controleProduit.php');
    exit();

}elseif (isset($_GET['choix']) && $_GET['choix']==='Annuler') {
    header ('location: ../controleProduit.php');
    exit();
}


?>

<?php require '../inc/headerPostReq.php'; ?>
        <div class="container">          
            <main class="central-block">
                <div class="form-table">
                    <div class="form-header">
                        <h3> Voulez vous vraiment supprimer ce produit ?</h3>
                        <p><?php echo $name.', catégorie : '.$nameCategorie; ?></p>
                    </div>
                    <div>
                        <form method="get" action="">
                            <div class="input-form">
                                <input type="number" name='idDelete' value='<?php echo $idproduit; ?>' hidden>
                                <!--<button name="choix" value="confirme">OUI</button>-->
                                <input type="submit" name="choix" value="Confirme">
                                <input type="submit" name="choix" value="Annuler">
                            </div> 
                        </form>
                    </div>
                </div>   
            </main>
        </div>
        <?php require '../inc/footer.php'; ?>
    </body>
</html>
