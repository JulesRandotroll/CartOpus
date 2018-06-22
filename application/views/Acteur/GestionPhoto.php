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
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Modifier Photo Profil</H1>
                <section >
                    <div class = "section-inner" style="background-color:#139CBC;padding:20px">
<<<<<<< HEAD
                        <table width = '100%'>
                        <tr>
                            <td>
                                <?php
                                    echo validation_errors(); // mise en place de la validation
                                    // echo form_open('Acteur/GestionPhoto');
                                    echo img($Photo);
                                ?>
                            </td>
                            <td>
                                <form  method="POST" action="GestionPhoto" enctype="multipart/form-data">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                                    <!-- <label for="Fichier" class="control-label">Fichier : </label> -->
                                    <input type="file" name="avatar">
                            </td>
                            <td> 
                                    <input type="submit" name="envoyer" value="Envoyer le fichier" class="btn btn-danger">
                                </form> 
                                <?php
                                    //echo form_submit('retour', 'Retour');
                                    echo form_close();
                                ?>
                            </td></tr>
                        </table>
                    </div>
                <section>
=======
                        <form method="POST" action="GestionPhoto" enctype="multipart/form-data">
                            <!--On limite le fichier à 2Mo -->
                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">

                            <div class="form-inline" action="Acteur/GestionPhoto">
                                <div class="form-group">
                                    <label for="fichier">Fichier :</label>
                                    <?php// echo form_label ('Fichier : ','fichier'); ?>
                                    <input type="file" name="avatar">
                                </div>
                                <input type="submit" class="btn btn-default" name="envoyer" value="Envoyer le fichier">
                            </div>
                        </form> 
                    </div>
                </section>
>>>>>>> 124b9ed01a4c2ef8b79237bf24651c1f32080f19
            </div>
        </div>    
    </div>
</div>

