<?php

if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}

$user = $_SESSION['auth'];

/** Connexion a la base de donnée */
/*require_once 'bdd.php'; */
/* appel fonctions*/
require_once 'utility/function.php';

/* requète selection table users */

$sql = 'SELECT * FROM categories';
$reponse = $bdd->prepare($sql);
$reponse->execute();

?>
<?php require 'inc/header.php'; ?>
        <div class="container">
            <main class="central-block">
                <section class="nav-table-bdd">
                    <nav>
                        <ul>
                            <?= nav_tables('active'); ?>
                        </ul>
                    </nav>
                </section>
                <section class="gestion-table-bdd">
                    <div class="info-user">
                        <h1>Bienvenue dans le controle center M. <?php echo $_SESSION['auth']['pseudo'];?></h1>
                    </div>
                    <div class="block-table">
                        <h3>Table catégories</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nom</th>
                                    <th>description</th>
                            </thead>
                            <tbody>
                            <?php 
                                while($info=$reponse->fetch())
                                {
                                    echo '<tr>';
                                    echo '<td>'.$info['categorie_id'].'</td>';
                                    echo '<td>'.$info['categorie_name'].'</td>';
                                    echo '<td>'.$info['description'].'</td>';
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
                        <form method="get" action="">
                            <h3> Ajouter une catégorie </h3>
                            <div class="input-form">
                                <label for="name">Nom de la catégorie : </label>
                                <input type="text" name="name" id="name" placeholder="nom catégorie" required>
                            </div>
                            <div class="input-form">
                                <label for="description">Description de la catégorie : </label>
                                <textarea name="description" id="description" placeholder="description de la catégorie"></textarea>
                            </div>
                            <div class="input-form">
                                <input type="submit" name="insertCat" value="ajouter">
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