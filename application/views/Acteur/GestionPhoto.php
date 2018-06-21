<ul class="nav navbar-nav navbar-right">
                        <?php 
                            echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="row" style="background-color:#15B7D1;padding:20px">
</div>

<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
<<<<<<< HEAD
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Modifier Photo Profil<H1>
                <section >
                    <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                        <form method="POST" action="GestionPhoto" enctype="multipart/form-data">
                            <!--On limite le fichier à 2Mo -->
                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                            Fichier : <input type="file" name="avatar">
                            <input type="submit" name="envoyer" value="Envoyer le fichier">
                        </form> 
=======
            <div style="padding:20px">
                <div class = "text-center">
                    <H1 style="color:#FFFFFF">Modifier Photo Profil<H1>
                    <section >
                        <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                                <?php
                                    echo validation_errors(); // mise en place de la validation
                                    echo form_open('Acteur/GestionPhoto');
                                   
                                ?>
                                    <form method="POST" action="GestionPhoto" enctype="multipart/form-data">
                                    <!--On limite le fichier à 2Mo -->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                                    Fichier : <input type="file" name="avatar">
                                    <input type="submit" name="envoyer" value="Envoyer le fichier">
                                    </form> 
                                <?php
                                    //echo form_submit('retour', 'Retour');
                                    echo form_close();
                                ?>
                            </div>
                        <section>
>>>>>>> b818a9e68ccaf2c7f3f7226264fa0b766b8efa1d
                    </div>
                <section>
            </div>
        </div>
    </div>
</div>
