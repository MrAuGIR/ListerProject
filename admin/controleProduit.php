<?php

if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}

$user = $_SESSION['auth'];

/** Connexion a la base de donnée */
require_once 'bdd.php';

/* requète selection table users */

//$sql = 'SELECT * FROM produits ORDER BY id';
$sql = 'SELECT * FROM produits p INNER JOIN categories c ON p.id_categorie = c.id';
$reponse = $bdd->prepare($sql);
$reponse->execute();

?>
<?php require 'inc/header.php'; ?>
        <div class="container">          
            <main class="central-block">
                <section class="nav-table-bdd">
                    <nav>
                        <ul>
                            <li><a href="controleCenter.php" title="affichage table utilisateur">Table users</a></li>
                            <li><a href="controleProduit.php" title="affichage table produit">Table produit</a></li>
                            <li><a href="controleCategorie.php" title="affichage table catégorie">Table catégorie</a></li>
                            <li><a href="controleListe.php" title="affichage table liste">Table Liste</a></li>
                        </ul>
                    </nav>
                </section>
                <section class="gestion-table-bdd">
                    <div class="info-user">
                        <h1>Bienvenue dans le controle center M. <?php echo $_SESSION['auth']['pseudo'];?></h1>
                    </div>
                    <div class="block-table">
                        <h3>Table produits</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nom</th>
                                    <th>Catégorie</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                            </thead>
                            <tbody>
                            <?php 
                                while($info=$reponse->fetch())
                                {
                                    echo '<tr>';
                                    echo '<td>'.$info['id'].'</td>';
                                    echo '<td>'.$info['name'].'</td>';
                                    echo '<td>'.$info['categorie_name'].'</td>';
                                    echo '<td><a href=\' postReq/produit_edite.php?id='.$info['id'].' \' >Editer</a></td>';
                                    echo '<td><a href=\' postReq/produit_delete.php?id='.$info['id'].' \' >Supprimer</a></td>';
                                    echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="select-table">
                        <form>

                        </form>
                    </div>
                    <div class="form-table">
                        <form method="POST" action="postReq/produit_add.php">
                            <h3> Ajouter un produit</h3>  
                            <?php 
                            if(!empty($_GET['alerte']) && $_GET['alerte']=='fail'){ ?>
                            <div class="form-alert">
                            <?php
                                echo '<ul> Problèmes rencontrés...';
                                $tab = $_SESSION['alerte']['echec'];
                                foreach ($tab as $error) {
                                    echo '<li>'.$error.'</li>';
                                }
                                echo '</ul>';
                            echo '</div>';
                            }
                            elseif(!empty($_GET['alerte']) && $_GET['alerte']=='ok'){ ?>
                            <div class="form-success">
                            <?php
                                echo $_SESSION['alerte']['success'];
                                echo '</div>';
                            }

                            ?>
                            
                            <div class="input-form">
                                <label for="name">Nom du produit : </label>
                                <input type="text" name="name" id="name" placeholder="nom produit" required>
                            </div>
                            <div class="input-form">
                                <label for="categorie">Choix de la catégorie : </label>
                                <select name="categorie" id="categorie" required>
                                    <?php 
                                        /* requète selection table catégorie */

                                        $sql = 'SELECT * FROM categories';
                                        $reponse = $bdd->prepare($sql);
                                        $reponse->execute();

                                        while($categorie=$reponse->fetch())
                                        {
                                            echo '<option  value=\' '.$categorie['id'].' \' >'.$categorie['categorie_name'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="input-form">
                                <input type="submit" name="insertProd" value="ajouter">
                            </div>     
                        </form>
                    </div>
                </section>
                <aside class="aside-table-bdd">

                </aside>
            </main>
        </div><!--END div main-block -->
        <?php require 'inc/footer.php'; ?>
    </body>
</html>