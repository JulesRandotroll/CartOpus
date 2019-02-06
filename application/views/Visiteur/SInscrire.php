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
            <div class="text-right">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                    <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
                    <input type="checkbox" data-toggle="toggle">
                </div>
            </div>
            <div class='text-center'>
                <H1 style="color:#FFFFFF">Inscription</H1>
            </div>
            
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <H4>
                    <?php
                        echo validation_errors(); // mise en place de la validation
                        echo form_open('visiteur/sInscrire');
                            // echo('<table style="width:100%" border=0>');

                            // echo('<tr><td>');
                            // echo('Nom: ');
                            // echo('</td><td>');
                        if ($message!="")
                        {
                            echo'<div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Attention</strong> '.$message.'
                                </div>';
                        } 
                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                        echo form_label('Nom : ', 'Nom');
                        echo form_input('nom',$nom,array('required'=>'required','placeholder'=>'Votre nom','pattern'=>'[a-zA-Z éèëïùàäüô]{1,40}','class'=>'form-control')); 
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo ('Prénom: ');
                            // echo('</td><td>');
                            
                      
                        echo '<div class="form-group">';
                        echo form_label('Prenom : ', 'Prenom');
                        echo form_input('prenom',$prenom,array('placeholder'=>'Votre prénom (facultatif)','pattern'=>'[a-zA-Z éèëïùàäüô]{1,20}','class'=>'form-control'));                          
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo ('Email d\'identification: '); // creation d'un label devant la zone de saisie
                            // echo('</td><td>');
                            
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
                                    echo form_checkbox('checkmail',$mailvisible,false,array('class'=>'form-control input-sm', "id"=>'mailvisible'));
                                    
                                    //echo '<input type="checkbox" name="formWheelchair" value="Yes" />';
                                echo '</div>';
                            echo'</div>';
                            echo '<div class="col-xs-1">';
                            echo'<a href="#" class="btn btn-danger btn-xs" data-toggle="popover" title="RGPD" data-trigger="hover" data-content="Acceptez vous que votre mail soit visible par tout le monde ?">  ?</a>';
                            echo '</div>';
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo ('Téléphone : '); // creation d'un label devant la zone de saisie
                            //echo('</td><td>');                                
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
                                    echo form_checkbox('checktel', $telvisible, false,array('class'=>'form-control input-sm','id'=>'telvisible'));
                                echo '</div>';
                            echo'</div>';
                            echo '<div class="col-xs-1">';
                                echo'<a href="#" class="btn btn-danger btn-xs" data-toggle="popover" title="RGPD" data-trigger="hover" data-content="Acceptez vous que votre numéro de téléphone soit visible par tout le monde ?">  ?</a>';
                            echo '</div>';
                        echo '</div>';
                           
                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                        echo form_label('Mot De Passe : ', 'MDP');
                        echo form_password('mdp','',array('required'=>'required','placeholder'=>'Votre mot de passe','class'=>'form-control'));
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo ('Confirmation du mot de passe: '); // creation d'un label devant la zone de saisie
                            // echo('</td><td>');
                           
                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                        echo form_label('Confirmer mot de passe : ', 'ConfMDP');
                        echo form_password('confmdp','',array('required'=>'required','placeholder'=>'La confirmation de votre mot de passe','class'=>'form-control'));// VERIF si confirme == mdp
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo ('Question Secrète: '); // creation d'un label devant la zone de saisie
                            // echo('</td><td>');
                            
                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                        echo form_label('Question Secrète', 'Question'); 
                        echo form_dropdown('question', $Questions, 'default',array('required'=>'required','class'=>'form-control'));
                        echo '</div>';
                            // echo('</td></tr>');
                            
                            // echo('<tr><td>');
                            // echo ('Reponse: '); 
                            // echo('</td><-group">';
                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                        echo form_label('Reponse : ', 'Rep');
                        echo form_input('reponse',$reponse,array('required'=>'required','placeholder'=>'La réponse à votre question secrète','pattern'=>'[a-zA-Z0-9 éèëïùàäü]{1,40}','class'=>'form-control'));
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo('</td><td>');
                        echo '<div class="text-center">';
                        echo form_submit('valider', 'Valider l\'inscription',array('class'=>'btn btn-danger'));
                        echo '</div>';
                            //('</table>');
                        echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont obligatoires</h6> ';
                            //echo form_submit('retour', 'Retour');
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

<input id="toggle-one" checked type="checkbox">
<script>
  $(function() {
    $('#toggle-one').bootstrapToggle();
  })
</script>



<script>
$(document).ready(function(){
$('[data-toggle="popover"]').popover();
});
</script>