<ul class="nav navbar-nav navbar-right">
                        <?php 
                     if ($this->session->nbaction==0)
                     {
                        echo '<li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>';
                        echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';  
                        echo'<li><a href="'.site_url('Acteur/GestionProfil').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-cog"></span> Compte</a></li>';
                        echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                     }
                     else
                     {
                        echo '<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFFFFF ;background-color:#0E7896">Action
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="background-color:#139CBC">
                            <li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>
                            <li><a href="'.site_url('Acteur/ChoixAction/1').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-list-alt"></span> Afficher Action</a></li>
                            <li><a href="'.site_url('Acteur/ChoixAction/2').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-pencil"></span> Modifier Action</a></li>   
                            <li><a href="'.site_url('Acteur/ChoixAction/3').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter SousAction</a></li>
                            <li><a href="'.site_url('Acteur/ChoixAction/4').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-repeat"></span> Renouveler Action</a></li>
                            <li><a href="'.site_url('Acteur/ChoixAction/5').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-trash"></span> Supprimer Action</a></li>
                        </ul>
                </li>';
                echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
            echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                     }
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
            <?php
            $ActionSelect='BabelDance'; // faire passer le nom choisie en paramètre
                echo '<H1 style="color:#FFFFFF">Contactez Nous</H1>';
            ?>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                        echo form_open('Acteur/ContacterAdmin');
    
                        echo '<div class="col-xs-6">';
                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000"/> * </span>';
                        echo form_label('Nom : ', 'nom');
                        echo form_input('nom',$nom,array('required'=>'required','placeholder'=>'Votre nom','class'=>'form-control','pattern'=>'[a-zA-Z0-9" éèëïùàäüô]')); 
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="col-xs-6">';
                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000"/> * </span>';
                        echo form_label('Prénom : ', 'prenom');
                        echo form_input('prenom',$prenom,array('required'=>'required','placeholder'=>'Votre prénom','class'=>'form-control','pattern'=>'[a-zA-Z0-9" éèëïùàäüô]')); 
                        echo '</div>';
                         echo '</div>';

                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000"/> * </span>';
                        echo form_label('Mail : ', 'email');
                        echo form_input('mail',$mail,array('required'=>'required','placeholder'=>'Ex : abc@exemple.com','class'=>'form-control')); 
                        echo '</div>';

                        $options=array(
                            'Ajout Thématique'=>'Ajout Thematique',
                            'Ajout Rôle'=>'Ajout Role',
                            'Recuperer Donnees BDD'=>'Droit d\'acces aux données personnelles',
                            'Supprimer Donnees BDD'=>'Droit de suppression aux données personnelles',
                            'Modifier Donnees BDD'=>'Droit de modification aux données personnelles',
                            'Signalé un problème'=>'Signalé un problème',
                            'Question'=>'Question',
                            'Autre'=>'Autre',
                        );
                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000"/> * </span>';
                        echo form_label('Objet : ', 'objet');
                        echo form_dropdown('subject', $options, 'default',array('required'=>'required','class'=>'form-control'));
                        echo '</div>';

                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000"/> * </span>';
                        echo form_label('Message : ', 'mess');
                        echo form_textarea('Message','',array('required'=>'required','placeholder'=>'Expliquez ici le motif de votre contacte','class'=>'form-control','pattern'=>'[a-zA-Z0-9" éèëïùàäüô]')); 
                        echo '</div>';

                        echo '<div class="text-right">';
                        echo form_submit('Envoyer', 'Envoyer',array('class'=>'btn btn-danger'));
                        echo '</div>';

                        echo form_close();
                    ?>
                </div>
            <section>
        </div>
    </div>    
</div>
