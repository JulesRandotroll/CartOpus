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
</div>
<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">Ajout Collaborateur</H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                        echo form_open('Acteur/AjoutCollaborateur/'.($noAction).'/'.($DateDebut).'/'.($DateFin));
                        var_dump($noAction);    
                        var_dump($DateDebut);
                        var_dump($DateFin);
                        
                        echo '<div class="form-group">';
                            echo form_label('Nom : ', 'Nom');
                            echo form_input('nom','',array('placeholder'=>'Votre nom','pattern'=>'[a-zA-Z]{1,40}','class'=>'form-control')); 
                        echo '</div>';
                                
                        echo '<div class="form-group">';
                            echo form_label('Prenom : ', 'Prenom');
                            echo form_input('prenom','',array('placeholder'=>'Votre prénom (facultatif)','pattern'=>'[a-zA-Z ]{1,20}','class'=>'form-control'));                          
                        echo '</div>';
                            
                        echo '<div class="form-group">';
                            echo '<span style="color:#FF0000"/> * </span>';
                            echo form_label('Mail : ', 'Mail');  
                            echo form_input('mail','',array('required'=>'required','placeholder'=>'Votre mail. Exemple : abc@exemple.com','pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})','class'=>'form-control'));
                        echo '</div>';                           
                        
                        echo '<div class="form-group">';
                            echo '<span style="color:#FF0000"/> * </span>';
                            echo form_label('Confirmation du Mail : ', 'ConfMail');
                            echo form_input('confmail','',array('required'=>'required','placeholder'=>'Votre mail. Exemple : abc@exemple.com','pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})','class'=>'form-control'));
                        echo '</div>';

                        
                        echo '<div class="form-group">';
                            echo '<span style="color:#FF0000"/> * </span>';
                            echo form_label('Rôle', 'Role'); 
                            echo form_dropdown('role', $Role, 'default',array('required'=>'required','class'=>'form-control'));
                        echo '</div>';

                        echo '<div class="text-center">';
                          echo form_submit('valider', 'Valider l\'ajout',array('class'=>'btn btn-danger'));
                        echo '</div>';
                        
                        echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont requis</h6> ';
                      
                        echo form_close();
                    ?>    
                </div>
            </section>
        </div>
    </div>    
</div>