<ul class="nav navbar-nav navbar-right">
                        <?php
                        echo '<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFFFFF ;background-color:#0E7896">Action
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="background-color:#139CBC">
                            <li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>
                            <li><a href="'.site_url('Acteur/AjoutSousAction').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter SousAction</a></li>
                            <li><a href="'.site_url('Acteur/ChoixAction/1').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-repeat"></span> Renouveler Action</a></li>
                                    <li><a href="'.site_url('Acteur/ChoixAction/2').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-pencil"></span> Modifier Action</a></li>   
                                    <li><a href="'.site_url('Acteur/ChoixAction/3').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-trash"></span> Supprimer Action</a></li>
                        </ul>
                    </li>';
                    echo'<li><a href="'.site_url('Acteur/AjoutCollaborateur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> Ajout Collaborateur</a></li>';
                    echo'<li><a href="#" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajout Thématique</a></li>';//'.site_url('Acteur/AjoutThematique/'.$NomAction).'
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
                <H1 style="color:#FFFFFF">Modifier Photo Profil</H1>
                <section >
                    <div class = "section-inner" style="background-color:#139CBC;padding:20px">
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
            </div>
        </div>    
    </div>
</div>

