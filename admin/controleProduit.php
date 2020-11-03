<?php

if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}

$user = $_SESSION['auth'];

/** Connexion a la base de donnée */
require_once 'bdd.php';

/* requète selection table users */

$sql = 'SELECT * FROM produits';
$reponse = $bdd->query($sql);

?>
<?php require 'inc/header.php'; ?>
        <div class="main-block">
            <h1>Bienvenue dans le controle center M. <?php echo $_SESSION['auth']['pseudo'];?></h1>
            <main class="central-block container">
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
                <section class="gestion-users">
                    <h3>Table Produit</h3>
                    <div class="table-users">
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nom</th>
                                    <th>Catégorie</th>
                            </thead>
                            <tbody>
                            <?php 
                                while($info=$reponse->fetch())
                                {
                                    echo '<tr>';
                                    echo '<td>'.$info['id'].'</td>';
                                    echo '<td>'.$info['name'].'</td>';
                                    echo '<td>'.$info['id_categorie'].'</td>';
                                    echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="select-users">
                        <form>

                        </form>
                    </div>
                    <div class="form-users">

                    </div>
                </section>
            </main>
        </div><!--END div main-block -->
        <?php require 'inc/footer.php'; ?>
    </body>
</html>