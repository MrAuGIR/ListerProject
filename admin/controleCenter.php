<?php

if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}


$user = $_SESSION['auth'];

/** Connexion a la base de donnée */
/*require_once 'bdd.php';*/

/* appel fonctions*/
require_once 'utility/function.php';

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
                            <?= nav_tables('active'); ?>
                        </ul>
                    </nav>
                </section>
                <section class="gestion-table-bdd">
                    <div class="info-user">
                        <h1>Bienvenue dans le controle center M. <?php echo $_SESSION['auth']['name'];?></h1>
                    </div>
                    <div class="block-table">
                        <h3>Table utilisateurs</h3>
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
                                    echo '<td>'.$info['name'].'</td>';
                                    echo '<td>'.$info['firstname'].'</td>';
                                    echo '<td>'.$info['email'].'</td>';
                                    echo '<td>'.$info['pass'].'</td>';
                                    echo '<td>'.$info['register_at'].'</td>';
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
                            <h3> Ajouter utilisateur </h3>
                            <div class="input-form">
                                <label for="pseudo">Pseudonime : </label>
                                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo de l'utilisateur" required>
                            </div>
                            <div class="input-form">
                                <label for="email">Email : </label>
                                <input type="text" name="email" id="email" placeholder="Email de l'utilisateur" required>
                            </div>
                            <div class="input-form">
                                <label for="password">Mot de passe : </label>
                                <input type="password" name="password" id="password" required>
                            </div>
                            <div class="input-form">
                                <label for="password2">Re-saisissez le mot de passe : </label>
                                <input type="password" name="password2" id="password2" required>
                            </div>
                            <div class="input-form">
                                <input type="submit" name="insertUser" value="ajouter">
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


