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
                            
                        echo '<div class="form-group">';
                        echo form_label('Nom : ', 'Nom');
                        echo form_input('nom',$nom,array('required'=>'required','pattern'=>'[a-zA-Z ]{1,40}','class'=>'form-control')); 
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo ('Prénom: ');
                            // echo('</td><td>');
                            
                        echo '<div class="form-group">';
                        echo form_label('Prenom : ', 'Prenom');
                        echo form_input('prenom',$prenom,array('pattern'=>'[a-zA-Z ]{1,20}','class'=>'form-control'));                          
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo ('Email d\'identification: '); // creation d'un label devant la zone de saisie
                            // echo('</td><td>');
                            
                        echo '<div class="form-group">';
                        echo form_label('Mail : ', 'Mail');
                        echo form_input('mail',$mail,array('required'=>'required','pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})','class'=>'form-control'));
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo ('Téléphone : '); // creation d'un label devant la zone de saisie
                            //echo('</td><td>');                                
                           
                        echo '<div class="form-group">';
                        echo form_label('Telephone : ', 'Telephone');
                        echo form_input('tel',$tel,array('pattern'=>'[0-9]{10}','class'=>'form-control'));
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo ('Mot de Passe: '); // creation d'un label devant la zone de saisie
                            // echo('</td><td>');
                           
                        echo '<div class="form-group">';
                        echo form_label('Mot De Passe : ', 'MDP');
                        echo form_password('mdp','',array('required'=>'required','class'=>'form-control')).$message;
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo ('Confirmation du mot de passe: '); // creation d'un label devant la zone de saisie
                            // echo('</td><td>');
                           
                        echo '<div class="form-group">';
                        echo form_label('Confirmer mot de passe : ', 'ConfMDP');
                        echo form_password('confmdp','',array('required'=>'required','class'=>'form-control'));// VERIF si confirme == mdp
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo ('Question Secrète: '); // creation d'un label devant la zone de saisie
                            // echo('</td><td>');
                            
                        echo '<div class="form-group">';
                        echo form_label('Question Secrète', 'Question');
                        echo form_dropdown('question', $Questions, 'default',array('required'=>'required','class'=>'form-control'));
                        echo '</div>';
                            // echo('</td></tr>');
                            
                            // echo('<tr><td>');
                            // echo ('Reponse: '); 
                            // echo('</td><-group">';
                        echo '<div class="form-group">';
                        echo form_label('Reponse : ', 'Rep');
                        echo form_input('reponse',$reponse,array('required'=>'required','pattern'=>'[A-Za-z0-9 ]{1,40}','class'=>'form-control'));
                        echo '</div>';
                            // echo('</td></tr>');

                            // echo('<tr><td>');
                            // echo('</td><td>');
                        echo '<div class="text-center">';
                        echo form_submit('valider', 'Valider l\'inscription',array('class'=>'btn btn-danger'));
                        echo '</div>';
                            //('</table>');

                            //echo form_submit('retour', 'Retour');
                        echo form_close();
                    ?>
                </H4>
                </div>
            <section>
        </div>
    </div>    
</div>

