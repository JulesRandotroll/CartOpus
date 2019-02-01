                    <ul class="nav navbar-nav navbar-right">
                        <?php
                             if ($this->session->nbaction==0)
                             {
                                echo '<li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>';
                                echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';  
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
</div>
<div class="row" style="background-color:#15B7D1;padding:20px">
</div>

<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
            <div style="padding:20px">
                
                    <H1 style="color:#FFFFFF" class="text-center">Gestion du compte</H1>
                    <section >
                        <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                            <H4>
                                <?php
                                    echo validation_errors(); // mise en place de la validation
                                    echo form_open('Acteur/GestionProfil');
                                    
                                    echo '<div class="row">';
                                        echo '<div class="text-center">';
                                            //echo '<div class="form-group">';
                                                echo'<a href="'.site_url('Acteur/GestionPhoto/'.($Acteur[0]['PhotoProfil'])).'">'.img($Acteur[0]['PhotoProfil']).'</a>';
                                               
                                          //  echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo'<br>';
                                    echo '<div class="row">';
                                    echo '<div class="text-center">';
                                    echo'<a href="'.site_url('Acteur/GestionPhoto/'.($Acteur[0]['PhotoProfil'])).'">'."<div class='btn btn-danger btn-md'>Modifier la Photo</div>".'</a>';
                                    echo '</div>';
                                    echo '</div>';

                                    echo '<div class="row">';
                                        echo '<div class="col-sm-12">';
                                            echo '<div class="form-group">';
                                                echo form_label('Modifier nom :','ModNom');
                                                echo form_input('nom',$nom,array('pattern'=>'[a-zA-Z0-9" éèëïùàäüô]{1,40}','class'=>'form-control')); 
                                            echo '</div>';
                                            echo '<div class="form-group">';
                                                echo form_label('Modifier prenom :','ModPrenom');
                                                echo form_input('prenom',$prenom,array('pattern'=>'[a-zA-Z0-9" éèëïùàäüô]{1,20}','class'=>'form-control'));                          
                                            echo'</div>';
                                        echo '</div>';
                                    echo '</div>'; 


                                    echo '<div class="row">';
                                        echo '<div class="col-xs-8">';
                                            echo '<div class="form-group">';
                                                echo form_label('Modifier email:','ModEmail');
                                                echo form_input('mail',$mail,array('pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})','class'=>'form-control'));
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="col-xs-3">';
                                            echo '<div class="form-group">';
                                                echo form_label('Visible par tous', 'visible'); 
                                                if($mailvisible)
                                                {
                                                    echo form_checkbox('checkmail',$mailvisible,true,array('class'=>'form-control input-sm', "id"=>'mailvisible'));
                                                }
                                                else
                                                {
                                                    echo form_checkbox('checkmail',$mailvisible,false,array('class'=>'form-control input-sm', "id"=>'mailvisible'));
                                                }
                                                
                                            echo '</div>';
                                        echo'</div>';
                                        echo '<div class="col-xs-1">';
                                            echo'<a href="#" class="btn btn-danger btn-xs" data-toggle="popover" title="RGPD" data-trigger="hover" data-content="Acceptez vous que votre mail soit visible par tout le monde ?">  ?</a>';
                                        echo '</div>';
                                    echo '</div>';

                                    echo '<div class="row">';
                                    echo '<div class="col-xs-8">';
                                    echo '<div class="form-group">';
                                    echo form_label('Modifier téléphone :','ModTel');
                                    echo form_input('notel',$notel,array('pattern'=>'[0-9]{10}','class'=>'form-control'));
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="col-xs-3">';
                                            echo '<div class="form-group">';
                                                echo form_label('Visible par tous', 'visible'); 
                                                if($notelvisible)
                                                {
                                                    echo form_checkbox('checktel',$notelvisible,true,array('class'=>'form-control input-sm', "id"=>'telvisible'));
                                                }
                                                else
                                                {
                                                    echo form_checkbox('checktel',$notelvisible,false,array('class'=>'form-control input-sm', "id"=>'telvisible'));
                                                }
                                                
                                                
                                            echo '</div>';
                                        echo'</div>';
                                        echo '<div class="col-xs-1">';
                                            echo'<a href="#" class="btn btn-danger btn-xs" data-toggle="popover" title="RGPD" data-trigger="hover" data-content="Acceptez vous que votre numéro de téléphone soit visible par tout le monde ?">  ?</a>';
                                        echo '</div>';
                                    echo '</div>';
                       
                                    echo '<div class="form-group">';
                                    echo form_label('Modifier Question:','ModQuest');
                                    echo form_dropdown('Question', $Question, $noQuestion,array('class'=>'form-control'));
                                    echo '</div>';
                           
                                    echo '<div class="form-group">';
                                    echo form_label('Nouvelle réponse :','ModReponse');
                                    echo form_input('reponse',$reponse,array('required'=>'required','pattern'=>'[a-zA-Z0-9" éèëïùàäüô]{1,40}','class'=>'form-control'));
                                    echo '</div>';
                           
                                    echo '<div class="text-center">'.form_submit('modif', 'Modifier',array("class"=>"btn btn-danger btn-lg")).'</div>';
               
                                    echo '<div class="text-right">';
                                    echo '<a style="color:#FFFFFF" href="'.site_url('Acteur/ModifierMDP').'">Modifier son mot de passe ? </a>';
                                    echo '</div>';  
   
                                    echo form_close();
                                ?>
                                </H4>
                            </div>
                        <section>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
$('[data-toggle="popover"]').popover();
});
</script>