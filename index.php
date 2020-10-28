<!-- insertion du header -->
<?php require 'inc/header.php'; ?>

    <div class="main-block">
        <main class="central-block container">
            <div class="central_left ">
                <section id="presentation">
                    <h2>Lister</h2>
                    <h3>Organiser vos course</h3>
                    <p>Liste est un outil permettant l'organisation de vos courses et de vos futur achats.</p>
                </section>
                <section id="list_illustration">
                    <div id="left_arrow">
                        <button onclick="switchElement('clickLeft')" id="clickLeft" title="illustration précédente"><i class="fas fa-angle-left fa-7x"></i></button>
                    </div>
                    <div id="illustration_default" class="center_illustration">
                        <div class="center_illustration_left">
                            <p>Créer, modifier des listes de courses et sauvegarder les dans votre espace personnel. Partager les ensuite avec vos proches.</p>
                        </div>
                        <div class="center_illustration_right">
                           <img src="img/illustration/Page_principal_xd.png" alt="illustration page principal">
                        </div>
                    </div>
                    <div id="illustration_second" class="center_illustration" >
                        <div class="center_illustration_left">
                            <p>L'outil d'édition vous permet de créer votre liste personnalisé, notamment grace à une bibliothèque de produits près enregistrés</p>
                        </div>
                        <div class="center_illustration_right">
                           <img src="img/illustration/Page_edition_xd.png" alt="illustration page édition">
                        </div>
                    </div>
                    <div id="illustration_third" class="center_illustration" >
                        <div class="center_illustration_left">
                            <p>L'outil de visualisation, vous permet de suivre vos course en direct, et de savoir à tous moment ou vous en êtes et ce qui vous reste à faire.</p>
                        </div>
                        <div class="center_illustration_right">
                           <img src="img/illustration/Page_visualisation_xd.png" alt="illustration page visualisation">
                        </div>
                    </div>
                    <div id="right_arrow">
                       <button onclick="switchElement('clickRight')" id="clickRight" title="illustration suivante"><i class="fas fa-angle-right fa-7x"></i></button>
                    </div>
                </section><!--END section list_outil-->
                <div id="bottom_tools">
    
                </div>
            </div> <!--END div class 'central_left'-->
            <div class="central_right ">
                <div id="block-register" class="form-sign-in div-form">
                    <?php require 'inc/register.php'; ?> 
                </div>
                <div id="block-login" class="form-log-in div-form">
                    <?php require 'inc/login.php'; ?>
                </div>
            </div> <!--END div class 'central_right'-->
        </main>
    </div><!--END div main-block -->
    
    <script src="scripts/switch.js"></script>
    <script src="scripts/tab.js"></script>
    <?php require 'inc/footer.php'; ?>
</body>
</html>