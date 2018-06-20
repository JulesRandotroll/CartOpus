<ul class="nav navbar-nav navbar-right">
                        <?php 
                            echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
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
                <div class = "text-center">
                    <H1 style="color:#FFFFFF">Gestion du compte<H1>
                    <section >
                        <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                                <?php
                                    echo validation_errors(); // mise en place de la validation
                                    echo form_open('Acteur/GestionProfil');
                                    echo('<table style="width:100%" border=0>');
                                    echo('<tr><td>');
                                    echo('Modifier nom: ');
                                    echo '</td><td>';
                                    echo form_input('nom',$nom,array('pattern'=>'[a-zA-Z ]{1,40}')); 
                                    echo('</td><td>');
                                    //var_dump($Acteur);
                                  
                                    echo'<a href="'.site_url('Acteur/GestionPhoto').'">'.img('4pP@R31L_1Ph20T.png').'</a>';
                                   //echo (img($Acteur[0]['PhotoProfil']));
                                    echo('</td></tr>');

                                    echo('<tr><td>');
                                    echo ('Modifier prénom: ');
                                    echo('</td><td>');
                                    echo form_input('prenom',$prenom,array('pattern'=>'[a-zA-Z ]{1,20}'));                          
                                    echo('</td></tr>');

                                    echo('<tr><td>');
                                    echo ('Modifier email d\'identification: '); // creation d'un label devant la zone de saisie
                                    echo('</td><td>');
                                    echo form_input('mail',$mail,array('pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})'));
                                    echo('</td></tr>');

                                    echo('<tr><td>');
                                    echo ('Modifier téléphone : '); // creation d'un label devant la zone de saisie
                                    echo('</td><td>');
                                    echo form_input('tel',$tel,array('pattern'=>'[0-9]{10}'));
                                    echo('</td></tr>');

                                    echo('<tr><td>');
                                    echo ('Modifier mot de Passe: '); // creation d'un label devant la zone de saisie
                                    echo('</td><td>');
                                    echo form_password('mdp','',array('required'=>'required')).$message;
                                    echo('</td></tr>');

                                    echo('<tr><td>');
                                    echo ('Confirmation du nouveau mot de passe: '); // creation d'un label devant la zone de saisie
                                    echo('</td><td>');
                                    echo form_password('confmdp','',array('required'=>'required'));// VERIF si confirme == mdp
                                    echo('</td></tr>');

                                    echo('<tr><td>');
                                    echo ('Modifier question Secrète: '); // creation d'un label devant la zone de saisie
                                    echo('</td><td>');
                                    echo form_dropdown('question', $Questions, 'default');
                                    echo('</td></tr>');
                                    echo('<tr><td>');
                                    echo ('Reponse: '); 
                                    echo('</td><td>');
                                    echo form_input('reponse',$reponse,array('required'=>'required','pattern'=>'[A-Za-z0-9 ]{1,40}'));
                                    echo('</td></tr>');

                                    echo('<tr><td>');
                                    echo('</td><td>');
                                    echo form_submit('modif', 'Modifier');
                                    echo('</td></tr>');
                                    echo('</table>');

                                                    //echo form_submit('retour', 'Retour');
                                    echo form_close();
                                ?>
                            </div>
                        <section>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
