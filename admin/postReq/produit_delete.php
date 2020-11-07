<?php

$idproduit=null;
$name='';
$categorie='';

/** Connexion a la base de donnée */
require_once '../bdd.php';

/* recuperation de l'id */
$id= isset($_GET['id'])? $_GET['id']:null;

/* recuperation des données lié a l'id */ 
$sql = 'SELECT * FROM produits WHERE id = :id';
$reponse = $bdd->prepare($sql);
$reponse->execute(['id'=>$id]);
while($produit=$reponse->fetch())
{
    $idproduit = $produit['id'];
    $name = $produit['name'];
    $categorie = $produit['id_categorie'];
}


?>

<?php require '../inc/headerPostReq.php'; ?>
        <div class="container">          
            <main class="central-block">
                <div>
                    <h3> Voulez vous vraiment supprimer ce produit ?</h3>
                    <p><?php echo $name.', catégorie : '.$categorie; ?></p>
                </div>
                <div>
                    <form method="get" action="produit_delete_post">
                        <input type="number" name='idDelete' value='<?php echo $idproduit; ?>' hidden>
                        <button name="choix" value="confirme">OUI</button>
                        <button name="choix" value="denied">NON</button>
                    </form>
                </div>
            </main>
        </div>
        <?php require '../inc/footer.php'; ?>
    </body>
</html>
