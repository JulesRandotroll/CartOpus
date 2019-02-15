<ul class="nav navbar-nav navbar-right">
                        <?php
                            echo'<li><a href="'.site_url('Acteur/GestionProfil').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-cog"></span> Compte</a></li>';
                            echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';
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
                <H1 style="color:#FFFFFF">Ajouter une photo à l'action</H1>
                <section >
                    <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                        <table width = '100%'>
                        <tr>
                            <td>
                                <?php
                                    echo validation_errors(); // mise en place de la validation
                                    //echo form_open('Acteur/AjoutPhotoAction/'.$noAction);
                                   // var_dump($Photo);
                                    echo img($Photo);
                                ?>
                            </td>
                            <td>
                                <form  method="POST" action=<?php echo $noAction ?> enctype="multipart/form-data">
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
            </div>
        </div>    
    </div>
</div>

