<html>
    <head>
       <title>Cart'Opus</title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- lien vers une page bootstrap => CSS (feuille de style) pré fait en ligne  -->
        <!-- cours sur :  https://www.w3schools.com/bootstrap/default.asp -->
    </head>
    <body>
    <div class="row" style="background-color:#0E7896">
    <!-- création d'une ligne et division de celle-ci en différentes sections (col-sm-X) -->
        <section>
            <div class = "section-inner">
            <!-- définition d'une zone graphique au sein de la section -->
        
                <div class="col-sm-2" style="padding:20px">
                <!-- utiliser 2 des 12 divisions(colonnes) de la "row"(ligne) -->
                    <?php 
                        echo'<a href="'.site_url('Visiteur/loadAccueil').'">'.img('logoAccueil.png').'</a>';
                        //.site_url => référence au debut de l'uRL ex : http://cartopus... ou http://127.0.0.1/cartopus....
                        //dans les deux cas site URL fonctionnera.
                    ?>
                </div>
                <div class="col-sm-7" style="padding:20px">
                    <div class = "text-center">
                        <?php 
                            echo img('Banniere.png');
                            //affichage d'une image à partir du dossier cartopus/assests/image
                            // chemin automatique vers ce dossier grâce au assets helper.php
                        ?>
                    </div>
                </div>
                <div class="col-sm-3" style="padding:20px">
                <!-- debut de la page en haut à droite de la bande; penser à la fermer avant de comencer la page -->
                <!--  exemple : -->
                <!-- 
                    <div class = "text-center">
                        <BR>
                        <?php 
                            echo'<a href="'.site_url('Visiteur/SInscrire').'" class="btn btn-danger" > S\'inscrire</a>   ';
                            echo'<a href="'.site_url('Visiteur/SeConnecter').'" class="btn btn-danger" > Se connecter</a>';
                        ?>  
                    </div>
                </div>
            </div>
        </section>
    </div>
-->
   