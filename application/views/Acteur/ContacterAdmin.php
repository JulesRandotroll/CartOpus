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
            <?php
            $ActionSelect='BabelDance'; // faire passer le nom choisie en paramètre
                echo '<H1 style="color:#FFFFFF">Contactez Nous</H1>';
            ?>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                        echo form_open('Acteur/ContacterAdmin');
                           
                       echo '<div class="form-group">';
                       echo '<span style="color:#FF0000"/> * </span>';
                       echo form_label('Mail : ', 'email');
                       echo form_input('mail','',array('required'=>'required','placeholder'=>'Ex : abc@exemple.com','class'=>'form-control')); 
                       echo '</div>';

                       $options=array(
                           'Ajout Thématique'=>'Ajout Thematique',
                           'Recuperer Donnees BDD'=>'Récuperer ses données personnelles',
                           'Autre'=>'Autre',
                       );
                       echo '<div class="form-group">';
                       echo '<span style="color:#FF0000"/> * </span>';
                       echo form_label('Objet : ', 'objet');
                       echo form_dropdown('subject', $options, 'default');
                       echo '</div>';

                       echo '<div class="form-group">';
                       echo '<span style="color:#FF0000"/> * </span>';
                       echo form_label('Message : ', 'mess');
                       echo form_textarea('Message','',array('required'=>'required','placeholder'=>'Ex : votre message','class'=>'form-control')); 
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
