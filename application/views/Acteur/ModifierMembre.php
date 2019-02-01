<ul class="nav navbar-nav navbar-right">
                        <?php
                  echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
                  echo'<li><a href="'.site_url('Acteur/ChoixAction/1').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-list-alt"></span> Afficher Action</a></li>';
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
                        echo form_open('Acteur/ModifierMembre/'.$noActeur.'/'.$noAction);

                        //var_dump($noAction);
                        
                        echo '<div class="form-group">';
                            echo form_label('Nom : ', 'Nom');
                            echo form_input('nom',$nom,array('disabled'=>"disabled",'class'=>'form-control','pattern'=>'[a-zA-Z0-9" éèëïùàäüô]')); 
                        echo '</div>';
                                
                        echo '<div class="form-group">';
                            echo form_label('Prenom : ', 'Prenom');
                            echo form_input('prenom',$prenom,array('disabled'=>"disabled",'class'=>'form-control','pattern'=>'[a-zA-Z0-9" éèëïùàäüô]'));                          
                        echo '</div>';
                            
                        echo '<div class="form-group">';
                            echo form_label('Mail : ', 'Mail');  
                            echo form_input('mail',$mail,array('disabled'=>"disabled",'class'=>'form-control'));
                        echo '</div>';                           
                        
                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                            echo form_label('Rôle', 'Role'); 
                            echo form_dropdown('role', $Role, 'default',array('required'=>'required','class'=>'form-control'));
                        echo '</div>';

                        echo '<div class="text-center">';
                          echo form_submit('modif', 'Modifier',array('class'=>'btn btn-danger'));
                        echo '</div>';
                        echo '<div class="text-right">';
                        echo '<a style="color:#FFFFFF" href="'.site_url('Acteur/ContacterAdmin').'"><span class="glyphicon glyphicon-plus"></span>Ajouter un nouveau rôle ?</a>';
                        echo '</div>';
                        echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont obligatoires</h6> ';
                      
                        echo form_close();
                    ?>    
                </div>
            </section>
        </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
$('[data-toggle="popover"]').popover();
});
</script>

