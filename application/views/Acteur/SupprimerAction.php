<ul class="nav navbar-nav navbar-right">
                        <?php 
                        echo '<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFFFFF ;background-color:#0E7896">Action
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="background-color:#139CBC">
                            <li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>
                            <li><a href="'.site_url('Acteur/AjoutSousAction/'.$noAction).'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter SousAction</a></li>
                            <li><a href="'.site_url('Acteur/ChoixAction/1').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-repeat"></span> Renouveler Action</a></li>
                            <li><a href="'.site_url('Acteur/ChoixAction/2').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-pencil"></span> Modifier Action</a></li>   
                        </ul>
                </li>';
                echo'<li><a href="'.site_url('Acteur/AjoutMembre').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> Ajout Membre</a></li>';
                    echo'<li><a href="#" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajout Thématique</a></li>';//'.site_url('Acteur/AjoutThematique/'.$NomAction).'
                            echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
                            echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div><div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Supprimer une action</H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                        echo form_open('Acteur/SupprimerAction/'.$noAction);
                        echo form_submit('Supprimer', 'Supprimer',array("class"=>"btn btn-danger btn-lg"));
                        echo form_close();
                    ?>
                </div>
            <section>
        </div>
    </div>    
</div>

