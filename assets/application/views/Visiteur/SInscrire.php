                    <ul class="nav navbar-nav navbar-right">
                        <?php 
                            //echo'<li><a href="'.site_url('Visiteur/SInscrire').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                            echo'<li><a href="'.site_url('Visiteur/SeConnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>';
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6" style="padding:20px">
        <div style="padding:20px">
            <div class='text-center'>
                <H1 style="color:#FFFFFF">Inscription Acteur</H1>
            </div>
            
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <div class="text-right">
                        <label> Changer de mode d'inscription :  </label>
                        <input id='transition' type="checkbox" data-toggle="toggle" data-on="Acteur" data-off="Visiteur" data-onstyle="danger" data-offstyle="info" data-style="ios">
                    </div>
                    <H4>
                    <?php
                        if ($message!="")
                        {
                            echo'<div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Attention</strong> '.$message.'
                                </div>';
                        } 

                        echo form_open('Visiteur/sInscrire');
                            //var_dump($transfert);
                            if ($transfert==TRUE)
                            {
                                echo'<div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <div class="text-center"> <strong>Attention</strong> </div> '.'<br>Voulez vous supprimer votre compte visiteur pour passer en acteur ?'.'<br>Vos commentaires seront transferés.<br>'
                                        .'<div class="text-right">'.
                                        form_submit('oui', 'Oui').' '.form_submit('non', 'Non').'</div>'.'
                                    </div>';
                            }  

                            //NOM
                            echo '<div class="form-group">';
                                echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                                echo form_label('Nom : ', 'Nom');
                                echo form_input('nom',$nom,array('required'=>'required','placeholder'=>'Votre nom','pattern'=>'[a-zA-Z éèëïùàäüô]{1,40}','class'=>'form-control')); 
                            echo '</div>';
                        
                            //PRENOM
                            echo '<div class="form-group">';
                                echo form_label('Prenom : ', 'Prenom');
                                echo form_input('prenom',$prenom,array('placeholder'=>'Votre prénom (facultatif)','pattern'=>'[a-zA-Z éèëïùàäüô]{1,20}','class'=>'form-control'));                          
                            echo '</div>';
    
                            //MAIL+ VISIBILITE
                            echo '<div class="row">';
                                echo '<div class="col-xs-7">';
                                    echo '<div class="form-group">';
                                        echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/>* </span>';
                                        echo form_label('Mail : ', 'Mail');  
                                        echo form_input('mail',$mail,array('required'=>'required','placeholder'=>'Votre mail. Exemple : abc@exemple.com','pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})','class'=>'form-control'));
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="col-xs-4">';
                                    echo '<div class="form-group">';
                                        echo form_label('Visible par tous', 'visible'); 
                                        echo form_checkbox('checkmail','',$mailvisible,array('class'=>'form-control input-sm', "id"=>'mailvisible'));
                                        
                                    echo '</div>';
                                echo'</div>';
                                echo '<div class="col-xs-1">';
                                echo'<a href="#" class="btn btn-danger btn-xs" data-toggle="popover" title="RGPD" data-trigger="hover" data-content="Acceptez vous que votre mail soit visible par tout le monde ?">  ?</a>';
                                echo '</div>';
                            echo '</div>';

                            //CONF MAIL
                            echo '<div class="form-group">';
                                echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/>* </span>';
                                echo form_label('Confirmer Mail : ', 'Mail');  
                                echo form_input('confmail',$confmail,array('required'=>'required','placeholder'=>'Votre mail. Exemple : abc@exemple.com','pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})','class'=>'form-control'));
                            echo '</div>';
                            
                            //TEL + VISIBILITE
                            echo '<div class="row">';
                                echo '<div class="col-xs-7">';
                                    echo '<div class="form-group">';
                                        echo form_label('Telephone : ', 'Telephone');
                                        echo form_input('tel',$tel,array('pattern'=>'[0-9]{10}','placeholder'=>'Votre numero de téléphone (facultatif)','class'=>'form-control'));
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="col-xs-4">';
                                    echo '<div class="form-group">';
                                        echo form_label('Visible par tous', 'visible'); 
                                        echo form_checkbox('checktel', '',$telvisible,array('class'=>'form-control input-sm','id'=>'telvisible'));
                                    echo '</div>';
                                echo'</div>';
                                echo '<div class="col-xs-1">';
                                    echo'<a href="#" class="btn btn-danger btn-xs" data-toggle="popover" title="RGPD" data-trigger="hover" data-content="Acceptez vous que votre numéro de téléphone soit visible par tout le monde ?">  ?</a>';
                                echo '</div>';
                            echo '</div>';
                            
                            //MDP
                            echo '<div class="form-group">';
                                echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                                echo form_label('Mot De Passe : ', 'MDP');
                                echo form_password('mdp',$mdp,array('required'=>'required','placeholder'=>'Votre mot de passe','class'=>'form-control'));
                            echo '</div>';
                            
                            //CONF MDP
                            echo '<div class="form-group">';
                                echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                                echo form_label('Confirmer mot de passe : ', 'ConfMDP');
                                echo form_password('confmdp',$confmdp,array('required'=>'required','placeholder'=>'La confirmation de votre mot de passe','class'=>'form-control'));// VERIF si confirme == mdp
                            echo '</div>';
                            
                            //QUESTIONS
                            echo '<div class="form-group">';
                                echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                                echo form_label('Question Secrète', 'Question'); 
                                echo form_dropdown('question', $Questions, 'default',array('required'=>'required','class'=>'form-control'));
                            echo '</div>';
                    
                            //REPONSES
                            echo '<div class="form-group">';
                                echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                                echo form_label('Reponse : ', 'Rep');
                                echo form_input('reponse',$reponse,array('required'=>'required','placeholder'=>'La réponse à votre question secrète','pattern'=>'[a-zA-Z0-9 éèëïùàäü]{1,40}','class'=>'form-control'));
                            echo '</div>';
    
                            // VALIDER
                            echo '<div class="text-center">';
                                echo form_submit('valider', 'Valider l\'inscription',array('class'=>'btn btn-danger'));      
                            echo '</div>';


                            echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont obligatoires</h6> ';

                        echo form_close();
                    ?>
                </H4>
                </div>
            <section>
        </div>
    </div>    
</div>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script> -->

<script src="<?php echo js_url('js_inscription') ?>"></script>

<style>
  .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>


