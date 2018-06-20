Perspectives futures pour le projet : 
    - Archivage (=> selection date => select date min from avoir lieu ==> date max)
    - tuto => comment ça marche
    -Page à faire avec Léandre
    -

Taff A Faire : 
    -page d'accueil Acteur :    - fiche perso avec l'orga si existe ^^
                                - liste des action auxuqelles il participe order by date
    - penser au vérifications => inscription => adresse déjà utilisée.


function GenererMotDePasse()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //=> tableau
        $MotDePasse = '';
        for ($i = 0; $i < 15; $i++) 
        {
            $MotDePasse = $MotDePasse . $characters[rand(0, 61)];
        }
        return $MotDePasse;
    }
    $MotDePasse = GenererMotDePasse();
    echo'<BR>Mot de passe aléatoire : ';
    echo $MotDePasse;

utilisation fichier style => adaptabilité des graphisme

Script insetion : 
INSERT INTO `cartopus`.`lieu` (`NOLIEU`, `ADRESSE`, `NOMLIEU`, `LONGITUDE`, `LATITUDE`, `ALTITUDE`, `CodePostal`, `Ville`) VALUES (NULL, '1 Avenue Antoine Mazier', 'MJC du Plateau', '-2.741343', '48.514356', NULL, '22000', 'Saint-Brieuc');
INSERT INTO `cartopus`.`organisation` (`NO_ORGANISATION`, `NOLIEU`, `NOMORGANISATION`, `NOTELORGA`, `NOFAXORGA`, `SITEURL`) VALUES (NULL, '1', 'MJC du Plateau', NULL, NULL, NULL);
INSERT INTO `cartopus`.`acteur` (`NOACTEUR`, `NOPROFIL`, `NOMACTEUR`, `PRENOMACTEUR`, `MOTDEPASSE`, `MAIL`, `NOTEL`) VALUES (NULL, '1', 'Chevalier', 'Leandre', 'goldfinger007', 'leandre.mjcduplateau@gmail.com', NULL);
INSERT INTO `cartopus`.`action` (`NOACTION`, `NOMACTION`, `PublicCible`, `SiteURLAction`, `Description`) VALUES (NULL, 'Iniciation informatiaque', 'jeunes', NULL, 'Quelques cours simples et rapides sur l''utilisation en toute sécurité des différents outils technologiques d''aujourd''hui. ');

4pP@R31L_1Ph20T.png

strtolower => transforme en minuscules














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





SELECT * FROM Action a, AvoirLieu al, Lieu l WHERE al.noAction=a.noAction AND l.nolieu=al.nolieu HAVING `DATEDEBUT` BETWEEN '2018-03-07 13:00:01' AND '2018-06-11 00:00:00'

   