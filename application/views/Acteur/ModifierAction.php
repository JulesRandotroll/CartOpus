<ul class="nav navbar-nav navbar-right">
                        <?php 
                            echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
                            echo'<li><a href="'.site_url('Acteur/ContacterAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-send"></span> Contacter Nous</a></li>';
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
                        echo form_open('Acteur/ModifierAction'.$noAction);
    
                         echo '<div class="form-group">';
                             echo '<span style="color:#FF0000"/> * </span>';
                             echo form_label('Nom de l\'action : ', 'Name');
                             echo form_input('NomAction',$NomAction, '', array("placeholder"=>"Nom de votre action",'required'=>'required','class'=>'form-control'));
                         echo '</div>';
    
                         echo '<div class="col-xs-4">';
                             echo '<div class="form-group">';
                                 echo form_label('Adresse : ', 'adresse');
                                 echo form_input('Adresse', $Adresse,'', Array("placeholder"=>"Adresse ex : 1 rue de la plomberie",'class'=>'form-control'));
                             echo '</div>';
                         echo'</div>';
    
                         echo '<div class="col-xs-4">';
                             echo '<div class="form-group">';
                                 echo '<span style="color:#FF0000"/> * </span>';
                                 echo form_label('Code Postale : ', 'CP');
                                 echo form_input('CodePostale', $CodePostale,'', Array('pattern'=>'([A-Z]+[A-Z]?\-)?[0-9]{1,2} ?[0-9]{3}','placeholder'=>'Code postale ex : 22000','required'=>'required','class'=>'form-control'));
                             echo '</div>';
                         echo '</div>';
    
                         echo '<div class="col-xs-4">';
                             echo '<div class="form-group">';
                                 echo '<span style="color:#FF0000"/> * </span>';
                                 echo form_label('Ville : ', 'ville');
                                 echo form_input('Ville', $Ville,'', Array("placeholder"=>"Ville ex : Saint Brieuc",'pattern="[a-zA-Z ]*"','required'=>'required','class'=>'form-control'));
                             echo '</div>';
                         echo '</div>';
    
                        // $ToDay = date('d/m/Y');
                         $ToDayH = date('H:i');
                         $ToDay = date('d/m/Y');
    
                         echo '<div class="col-xs-6">';
                             echo '<div class="form-group">';
                                 echo '<span style="color:#FF0000"/> * </span>';
                                 echo form_label('Date de debut : ', 'dd');
                                 echo '<input class="form-control" name="DateDebut" id="date" type="date" value="'.$DateDebut.'">';//$ToDay
                             echo '</div>';
                             echo '<div class="form-group">';
                                 echo '<span style="color:#FF0000"/> * </span>';
                                 echo form_label('Heure de debut : ', 'dd');
                                 echo '<input class="form-control" name="HeureDebut" id="time" type="time" value="'.$ToDayH.'">';
                                 //echo form_input('HeureDebut', '', Array("placeholder"=>"Heure ex : 14:14",'required'=>'required','class'=>'form-control'));
                             echo '</div>';
                         echo'</div>';
    
                         echo '<div class="col-xs-6">';
                             echo '<div class="form-group">';
                                 echo form_label('Date de fin : ',$DateFin, 'df');
                                 echo '<input class="form-control" name="DateFin" id="date" type="date" value="'.$DateFin.'">';//$ToDay
                                 //echo form_input('DateFin', '', Array("placeholder"=>"Date ex : 12-12-2012",'pattern'=>'(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d\d','required'=>'required','class'=>'form-control'));
                             echo '</div>';
                             echo '<div class="form-group">';
                                 echo form_label('Heure de fin : ', 'dd');
                                 echo '<input name="HeureFin" class="form-control" id="time" type="time" value="'.$ToDayH.'">';
                                 //echo form_input('HeureFin', '', Array("placeholder"=>"Heure ex : 15:15",'required'=>'required','class'=>'form-control'));
                             echo '</div>';
                         echo '</div>';
                        
    
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
                             echo form_dropdown('Public', $options,'' ,Array('class'=>'form-control',$Public));
                         echo '</div>';
    
                         echo '<div class="form-group">';
                             echo form_label('Description ', 'Desc');
                             echo form_textarea('Description', $Description,'',Array("placeholder"=>"Ici, votre description",'class'=>'form-control'));
                         echo '</div>';
    
                         echo '<div class="form-group">';
                             echo form_label('Site de l\'action : ',$SiteURL, 'site');
                             echo form_input('SiteURL',$SiteURL, '', Array("placeholder"=>"https://www.exemple.fr",'class'=>'form-control'));//,'pattern'=>'(((ht|f)tp(s?))\:\/\/)?(([a-zA-Z0-9]+([@\-\.]?[a-zA-Z0-9]+)*)(\:[a-zA-Z0-9\-\.]+)?@)?(www.|ftp.|[a-zA-Z]+.)?[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,})(\:[0-9]+)'
                         echo '</div>';
                         
                         echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont requis</h6> ';
                        
                        echo '<div class="text-right">';
                        echo form_submit('Modifier', 'Modifier',array("class"=>"btn btn-danger btn-lg"));
                        echo '</div>';

                        echo'<li><a href="'.site_url('Acteur/AjoutSousAction').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajout Sous Action</a></li>';
                        echo'<li><a href="'.site_url('Acteur/AjoutCollaborateur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajout Collaborateur</a></li>';
                        echo'<li><a href="'.site_url('Acteur/AjoutThematique').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajout Thématique</a></li>';
                        echo form_close();
                    ?>
                </div>
            <section>
        </div>
    </div>    
</div>

