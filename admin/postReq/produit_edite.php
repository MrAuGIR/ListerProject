<?php
if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}


/** Connexion a la base de donnée */
require_once '../bdd.php';
/* tableau contenant les messages d'erreurs */
$errors=array();

$id=null;
$name=null;
$nameCategorie=null;
$categorie=null;
$idCategorie=null;
$idproduit=null;

/* recuperation de l'id */
if(isset($_GET['idproduit']) && isset($_GET['submit']) && $_GET['submit']==='Modifier')
{
    $id = $_GET['idproduit']; 
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
    $idCategorie =(int) $produit['id_categorie'];
}

/* nom de la catégorie */
$sql = 'SELECT name FROM categories WHERE id = :id';
$reponse = $bdd->prepare($sql);
$reponse->execute(['id'=>$idCategorie]);

while($info = $reponse->fetch()){
    $nameCategorie=$info['name'];
}

/**  modification du produit **/

if(isset($_GET['submit']) && $_GET['submit']==='Modifier'){

    $idproduit=isset($_GET['idproduit'])? $_GET['idproduit']: null;
    $name=isset($_GET['name'])? filter_var($_GET['name'],FILTER_SANITIZE_STRING): '';
    $idCategorie=isset($_GET['categorie'])? (int)$_GET['categorie']: null;

    /* mise en forme du nom */
    $name = ucfirst(strtolower($name));

    /* on verifie les valeurs modifiés */
    if(empty($name) || empty($idCategorie) || !is_int($idCategorie) || $idproduit==null){

        var_dump($name, $idCategorie);
        $errors['format'] = 'Erreur dans la saisie des nouvelles valeurs';
        echo "je suis dans erreur saisie";
        
    }

    /* si pas d'erreur on met à jour la donnée */
    if(empty($errors))
    {
        
        $sql = 'UPDATE produits SET name = :name, id_categorie= :id_categorie WHERE id = :id';
        $req = $bdd->prepare($sql);
        $req->execute(['name'=>$name, 'id_categorie'=>$idCategorie, 'id'=>$idproduit]);
        $success="Modification du produit";
    }
}elseif (isset($_GET['submit']) && $_GET['submit']==='Retour') {
    header('location: ../controleProduit.php');
    exit();
}



?>

<?php require '../inc/headerPostReq.php'; ?>
        <div class="container">          
            <main class="central-block">
                <div class="form-table">
                    <div class="form-header">
                        <h3> Modification du produit suivant :</h3>
                        <p><?php echo $name.', catégorie : '.$nameCategorie; ?></p>
                    </div>
                    <form method="GET" action="">
                        <h3> Editer</h3>  
                        <?php 
                        if(!empty($errors) && isset($_GET['submit']) && $_GET['submit']=='Modifier'){ ?>
                        <div class="form-alert">
                        <?php
                            echo '<ul> Problèmes rencontrés...';
                            foreach ($errors as $error) {
                                echo '<li>'.$error.'</li>';
                            }
                            echo '</ul>';
                        echo '</div>';
                        }
                        elseif(empty($errors) && !empty($success) ){ ?>
                        <div class="form-success">
                        <?php
                            echo $success;
                            echo '</div>';
                        }

                        ?>
                        <div class="input-form">
                            <input type="number" name="idproduit" value='<?php echo $idproduit; ?>'  hidden>
                        </div>
                        <div class="input-form">
                            <label for="name">Nom du produit : </label>
                            <input type="text" name="name" id="name" value='<?php echo $name; ?>' placeholder="nom produit" required>
                        </div>
                        <div class="input-form">
                            <label for="categorie">Choix de la catégorie : </label>
                            <select name="categorie" id="categorie"  required>
                                <?php 
                                    /* requète selection table catégorie */

                                    $sql = 'SELECT * FROM categories';
                                    $reponse = $bdd->query($sql);

                                    while($categorie=$reponse->fetch())
                                    {
                                        echo '<option  value=\' '.$categorie['id'].' \' >'.$categorie['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-form">
                            <input type="submit" name="submit" value="Modifier">
                            <input type="submit" name="submit" value="Retour">
                        </div>     
                    </form>
                </div>
            </main>
        </div>
        <?php require '../inc/footer.php'; ?>
    </body>
</html>
