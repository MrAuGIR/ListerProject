<?php

if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}

$user = $_SESSION['auth'];
$debut=0;
/** Connexion a la base de donnée */
/*require_once 'utility/bdd.php';*/

/* appel fonctions*/
require_once 'utility/function.php';
$page=1;

$offset=10;
/* nombre de ligne a afficher */
if(isset($_GET['submit_offset']) && $_GET['submit_offset'] === 'go'){
    
    $offset=isset($_GET['offset'])?(int)$_GET['offset']:10;

}

$requete = 'SELECT COUNT(*) as numb_row FROM produits';
$reponse= $bdd->prepare($requete);
$reponse->execute();
$result = $reponse->fetch();
$nbRow =   (int)$result['numb_row'];

$nbPage = ceil($nbRow/$offset);

if(!isset($_GET['page']) || empty($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}

// numero du  premier enregistrement
$debut = ($page - 1 ) * $offset; // si page 1 alors debut=0 


/* requète selection table produit */

$filtre_mot =( isset($_GET['search']) && !empty($_GET['search']))?$_GET['search']:'';
$filtre_categorie=( isset($_GET['tri_categorie']) && !empty($_GET['tri_categorie']))?(int)$_GET['tri_categorie']:0;

if(!empty($filtre_mot)){
    $model= $filtre_mot.'%';
    $sql = 'SELECT * FROM produits p INNER JOIN categories c ON p.categorie_id = c.categorie_id WHERE produit_name LIKE :model';
    $reponse = $bdd->prepare($sql);
    $reponse->execute(['model'=>$model]);
}
elseif($filtre_categorie!=0 && empty($filtre_mot)){
    $sql = 'SELECT * FROM produits p INNER JOIN categories c ON p.categorie_id = c.categorie_id WHERE p.categorie_id=:filtre_categorie';
    $reponse = $bdd->prepare($sql);
    $reponse->execute(['filtre_categorie'=>$filtre_categorie]);
}else{
    $sql = 'SELECT * FROM produits p INNER JOIN categories c ON p.categorie_id = c.categorie_id LIMIT :debut,:offset';
    $reponse = $bdd->prepare($sql);
    $reponse->bindValue('debut',$debut,PDO::PARAM_INT);
    $reponse->bindValue('offset',$offset,PDO::PARAM_INT);
    $reponse->execute();
}


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
                        <h3>Table produits</h3>
                        <div class="head-table-filtre">
                            <a href="controleProduit.php?page=<?= $page - 1; ?>"><i class="fas fa-angle-left"></i>page precedente </a>
                            <a href="controleProduit.php?page=<?= $page + 1; ?>">page suivante<i class="fas fa-angle-right"></i></a>
                            <form method="get" action="">
                                <select name="offset">
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <input type="submit" name="submit_offset" value="go">
                            </form>
                        </div>
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
                                    echo '<td>'.$info['produit_id'].'</td>';
                                    echo '<td>'.$info['produit_name'].'</td>';
                                    echo '<td>'.$info['categorie_name'].'</td>';
                                    echo '<td><a href=\' postReq/produit_edite.php?id='.$info['produit_id'].' \' >Editer</a></td>';
                                    echo '<td><a href=\' postReq/produit_delete.php?id='.$info['produit_id'].' \' >Supprimer</a></td>';
                                    echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </section>
                <aside class="aside-table-bdd">
                    <div class="info-user">
                        <h1 style=" visibility: hidden;">Bienvenue</h1>
                    </div>
                    <div class="form-table">
                        <h3>Filter</h3>
                        <form method="GET" action="controleProduit.php">
                            <div class="input-form input-aside">
                                <label for="tri_categorie">Par catégorie</label>
                                <select name="tri_categorie" id="tri_categorie" >
                                    <?php 
                                        /* requète selection table catégorie */

                                        $sql = 'SELECT * FROM categories';
                                        $reponse = $bdd->prepare($sql);
                                        $reponse->execute();
                                        $defaultValue =0;
                                        echo '<option  value=\' '.$defaultValue.' \' >toutes</option>';

                                        while($categorie=$reponse->fetch())
                                        {
                                            echo '<option  value=\' '.$categorie['categorie_id'].' \' >'.$categorie['categorie_name'].'</option>';
                                        }
                                    ?>
                                </select>
                                <input type="submit" name="submit_tri" value="go">
                            </div>
                        </form>
                        <h3>Rechercher</h3>
                        <form method="GET" action="controleProduit.php">
                            <div class="input-form input-aside">
                                <label for="search">Mot à rechercher</label>
                                <input type="text" name="search" id="search" placeholder="terme à rechercher">
                                <input type="submit" name="submit_search" value="go">
                            </div>
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
                                <label for="categorie">Catégorie : </label>
                                <select name="categorie" id="categorie" required>
                                    <?php 
                                        /* requète selection table catégorie */

                                        $sql = 'SELECT * FROM categories';
                                        $reponse = $bdd->prepare($sql);
                                        $reponse->execute();

                                        while($categorie=$reponse->fetch())
                                        {
                                            echo '<option  value=\' '.$categorie['categorie_id'].' \' >'.$categorie['categorie_name'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="input-form">
                                <input type="submit" name="insertProd" value="ajouter">
                            </div>     
                        </form>
                    </div>                                
                </aside>
            </main>
        </div><!--END div main-block -->
        <?php require 'inc/footer.php'; ?>
    </body>
</html>