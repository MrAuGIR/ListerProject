<?php

if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}

$user = $_SESSION['auth'];

/** Connexion a la base de donnée */
require_once 'bdd.php';

/* requète selection table users */

$sql = 'SELECT * FROM users';
$reponse = $bdd->query($sql);

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
                <section class="gestion-users">
                    <h1>Bienvenue dans le controle center M. <?php echo $_SESSION['auth']['pseudo'];?></h1>
                    <h3>Table utilisateurs</h3>
                    <div class="table-users">
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Pseudo</th>
                                    <th>Email</th>
                                    <th>Mot de passe</th>
                                    <th>Date création</th>
                            </thead>
                            <tbody>
                            <?php 
                                while($info=$reponse->fetch())
                                {
                                /* $date = explode('-',$info['register_at']);
                                    $dateFrancaise = $date[2].'-'.$date[1].'-'.$date[0];*/
                                    echo '<tr>';
                                    echo '<td>'.$info['id'].'</td>';
                                    echo '<td>'.$info['pseudo'].'</td>';
                                    echo '<td>'.$info['email'].'</td>';
                                    echo '<td>'.$info['pass'].'</td>';
                                    echo '<td>'.$info['register_at'].'</td>';
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


