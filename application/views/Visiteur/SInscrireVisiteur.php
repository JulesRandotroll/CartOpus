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
                <H1 style="color:#FFFFFF">Inscription Visiteur</H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <div class="text-right">
                        <label> Changer de mode d'inscription :  </label>
                        <input id='transition' type="checkbox" data-toggle="toggle" data-on="Acteur" data-off="Visiteur" data-onstyle="danger" data-offstyle="info" data-style="ios" checked>
                    </div>
                    <H4>
                    <?php
                        echo validation_errors(); // mise en place de la validation
                        echo form_open('visiteur/sInscrireVisiteur');
                            // echo('<table style="width:100%" border=0>');

                            // echo('<tr><td>');
                            // echo('Nom: ');
                            // echo('</td><td>');
                        if (isset($message))
                        {
                            echo'<div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Attention</strong> '.$message.'
                                </div>';
                        } 

                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                        echo form_label('Pseudo : ', 'Nom');
                        echo form_input('nom',$nom,array('required'=>'required','placeholder'=>'Votre nom','pattern'=>'[a-zA-Z éèëïùàäüô]{1,40}','class'=>'form-control')); 
                        echo '</div>';
                        
                        echo '<div class="form-group">';
                            echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/>* </span>';
                            echo form_label('Mail : ', 'Mail');  
                            echo form_input('mail',$mail,array('required'=>'required','placeholder'=>'Votre mail. Exemple : abc@exemple.com','pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})','class'=>'form-control'));
                        echo '</div>';

                        echo '<div class="form-group">';
                            echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/>* </span>';
                            echo form_label('Confirmer Mail : ', 'Mail');  
                            echo form_input('mailConf','',array('required'=>'required','placeholder'=>'Votre mail. Exemple : abc@exemple.com','pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})','class'=>'form-control'));
                        echo '</div>';

                        echo '<div class="form-group">';
                            echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                            echo form_label('Mot de passe : ', 'MDP');
                            echo form_password('mdp','',array('required'=>'required','placeholder'=>'Saisir votre mot de passe','class'=>'form-control'));// VERIF si confirme == mdp
                        echo '</div>';
                        
                        echo '<div class="form-group">';
                            echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                            echo form_label('Confirmer mot de passe : ', 'ConfMDP');
                            echo form_password('confmdp','',array('required'=>'required','placeholder'=>'La confirmation de votre mot de passe','class'=>'form-control'));// VERIF si confirme == mdp
                        echo '</div>';

                        echo '<div class="text-center">';
                            echo form_submit('valider', 'Valider l\'inscription',array('class'=>'btn btn-danger'));
                        echo '</div>';

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
<script src="<?php echo js_url('js_inscription') ?>"></script>

<style>
  .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>

