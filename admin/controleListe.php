<?php

if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}
require_once 'utility/config.php';
/* on verifie que l'utilisateur admin est connecte */
if(!isset($_SESSION['auth']) || $_SESSION['auth']['level']!=ADMIN_LEVEL){
    header('location: ../index.php');
}

$user = $_SESSION['auth'];

/** Connexion a la base de donnée */
/*require_once 'bdd.php';*/

/* appel fonctions*/
require_once 'utility/function.php';

/* requète selection table users 

$sql = 'SELECT * FROM users';
$reponse = $bdd->query($sql);*/

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
                        <h3>Table catégories</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nom</th>
                                    <th>Id propriétaire</th>
                                    <th>description</th>
                                    <th>Nombre items</th>
                                    <th>Date création</th>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                    <div class="select-table">
                        <form>

                        </form>
                    </div>
                    <div class="form-table">
                        <form method="get" action="">
                            <h3> Ajouter une liste </h3>
                            <div class="input-form">
                                <label for="name">Nom de la liste : </label>
                                <input type="text" name="name" id="name" placeholder="nom liste" required>
                            </div>
                            <div class="input-form">
                                <label for="idUser">id propriétaire : </label>
                                <select name="idUser" id="idUser" required>
                                    <option value="2">2 (Admin)</option>
                                </select>
                            </div>
                            <div class="input-form">
                                <label for="description">Courte description : </label>
                                <input type="text" name="description" id="description" placeholder="description liste" required>
                            </div>
                            <div class="input-form">
                                <input type="submit" name="insertList" value="ajouter">
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


