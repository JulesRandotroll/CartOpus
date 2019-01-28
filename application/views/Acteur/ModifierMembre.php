<ul class="nav navbar-nav navbar-right">
                        <?php
                  echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
              echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="<?php echo js_url('js_AfficherAction'); ?>"></script>

<div class="row" style="background-color:#15B7D1;padding:20px" id="action">
    <!-- <div class="col-lg-2">
    </div> -->
    <div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Modifier le rôle d'un membre</H1>
            </div>
            <section>
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                <?php
                        echo form_open('Acteur/ModifierMembre/'.$noActeur);

                        //var_dump($Prenom);
                    //    if ($message!="")
                    //     {
                    //     echo'<div class="alert alert-danger alert-dismissible">
                    //     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    //             <strong>Attention</strong> '.$message.'
                    //         </div>';
                    //     }
                        
                        echo '<div class="form-group">';
                            echo form_label('Nom : ', 'Nom');
                            echo form_input('nom',$nom,array('placeholder'=>'Votre nom','pattern'=>'[a-zA-Z ]{1,40}','class'=>'form-control')); 
                        echo '</div>';
                                
                        echo '<div class="form-group">';
                            echo form_label('Prenom : ', 'Prenom');
                            echo form_input('prenom',$prenom,array('placeholder'=>'Votre prénom (facultatif)','pattern'=>'[a-zA-Z ]{1,20}','class'=>'form-control'));                          
                        echo '</div>';
                            
                        echo '<div class="form-group">';
                            echo '<span style="color:#FF0000"/> * </span>';
                            echo form_label('Mail : ', 'Mail');  
                            echo form_input('mail',$mail,array('required'=>'required','placeholder'=>'Votre mail. Exemple : abc@exemple.com','pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})','class'=>'form-control'));
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


