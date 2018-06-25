<ul class="nav navbar-nav navbar-right">
                        <?php 
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
                <H1 style="color:#FFFFFF">Modifier une action</H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                        echo form_open('Acteur/ModifierAction');

                        echo '<div class="form-group">';

                        //var_dump($options);
               

                        echo '<div class="form-group">';
                        echo form_label('Action choisie : ', 'Action');
                        echo form_dropdown('Action', $options,'' ,Array('class'=>'form-control'));
                        echo '</div>';

                        echo form_label('Nom de l\'action : ', 'Name');
                        echo form_input('NomAction', '', Array("placeholder"=>"Nom de votre action",'class'=>'form-control'));
                        echo '</div>';
                        
                        echo '<div class="col-xs-4">';
                            echo '<div class="form-group">';
                                echo form_label('Adresse : ', 'adresse');
                                echo form_input('Adresse', '', Array("placeholder"=>"Adresse ex : 1 rue de la plomberie",'class'=>'form-control'));
                            echo '</div>';
                        echo'</div>';
                        echo '<div class="col-xs-4">';
                            echo '<div class="form-group">';
                 
                                echo form_label('Code Postale : ', 'CP');
                                echo form_input('CodePostale', '', Array("placeholder"=>"Code postale ex : 22000",'pattern'=>'([A-Z]+[A-Z]?\-)?[0-9]{1,2} ?[0-9]{3}','class'=>'form-control'));
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-xs-4">';
                            echo '<div class="form-group">';
                               
                                echo form_label('Ville : ', 'ville');
                                echo form_input('Ville', '', Array("placeholder"=>"Ville ex : Saint Brieuc",'pattern'=>'[a-zA-Z]','class'=>'form-control'));
                            echo '</div>';
                        echo '</div>';

                        echo '<div class="col-xs-6">';
                            echo '<div class="form-group">';
                                echo form_label('Date de debut : ', 'dd');
                                echo form_input('DateDebut', '', Array("placeholder"=>"Date ex : 11-11-2011",'pattern'=>'(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d\d','class'=>'form-control'));
                            echo '</div>';
                        echo'</div>';
                        echo '<div class="col-xs-6">';
                            echo '<div class="form-group">';
                                echo form_label('Date de fin : ', 'df');
                                echo form_input('DateFin', '', Array("placeholder"=>"Date ex : 12-12-2012",'pattern'=>'(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d\d','class'=>'form-control'));
                            echo '</div>';
                        echo '</div>';
                        // echo '</div>';
                        $options = array(
                            "Tout Public"=>"Tout Public",
                            "Enfants"=>"Enfants",
                            "Jeunes"=>"Jeunes",
                            "Adultes"=>"Adultes",
                            "3eme Age"=>"3eme Age",
                            "Familiale"=>"Familiale",
                            "Professionnels"=>"Professionnels",
                        );


                        echo '<div class="form-group">';
                        echo form_label('Public ciblé : ', 'Public');
                        echo form_dropdown('Publique', $options,'' ,Array('class'=>'form-control'));
                        echo '</div>';

                        echo '<div class="form-group">';
                        echo form_label('Description ', 'Desc');
                        echo form_textarea('Description', '',Array("placeholder"=>"Ici, votre description",'class'=>'form-control'));
                        echo '</div>';

                        echo '<div class="form-group">';
                        echo form_label('Site de l\'action : ', 'site');
                        echo form_input('SiteURL', '', Array("placeholder"=>"https://www.exemple.fr",'pattern'=>'(((ht|f)tp(s?))\:\/\/)?(([a-zA-Z0-9]+([@\-\.]?[a-zA-Z0-9]+)*)(\:[a-zA-Z0-9\-\.]+)?@)?(www.|ftp.|[a-zA-Z]+.)?[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,})(\:[0-9]+)','class'=>'form-control'));
                        echo '</div>';
                        
                        echo '<div class="text-right">';
                        echo form_submit('Modifier', 'Modifier',array("class"=>"btn btn-danger btn-lg"));
                        echo '</div>';

                        echo'<li><a href="'.site_url('Acteur/AjoutSousAction').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Ajout Sous Action</a></li>';

                        echo'<li><a href="'.site_url('Acteur/AjoutThematique').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Ajout Thématique</a></li>';
                        echo form_close();
                    ?>
                </div>
            <section>
        </div>
    </div>    
</div>

