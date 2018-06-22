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
                
                    <H1 style="color:#FFFFFF">Gestion du compte</H1>
                    <section >
                        <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                            <H4>
                                <?php
                                    echo validation_errors(); // mise en place de la validation
                                    echo form_open('Acteur/GestionProfil');
                                    echo('<table style="width:100%"');
                                    echo('<tr><td width=73%>');
                                    // echo('Modifier nom: ');
                                    // echo '</td><td>';
                                    echo '<div class="form-group">';
                                    echo form_label('Modifier nom :','ModNom');
                                    echo form_input('nom',$nom,array('pattern'=>'[a-zA-Z ]{1,40}','class'=>'form-control')); 
                                    echo '</div>';
                                    // echo('</td><td>');
                                    //var_dump($Acteur);
                                    //$ratio='150';
                                    
                                    
                                   //echo (img($Acteur[0]['PhotoProfil']));
                                    // echo('</td></tr>');

                                    // echo('<tr><td>');
                                    // echo ('Modifier prénom: ');
                                    // echo('</td><td>');
                                    echo '<div class="form-group">';
                                    echo form_label('Modifier prenom :','ModPrenom');
                                    echo form_input('prenom',$prenom,array('pattern'=>'[a-zA-Z ]{1,20}','class'=>'form-control'));                          
                                    echo'</div> </td><td width = 1%></td> <td>';
                                    // echo('</td></tr>');
                                    echo '   ';
                                    echo'<a href="'.site_url('Acteur/GestionPhoto').'">'.img('4pP@R31L_1Ph20T.png').'</a>';
                                    
                                    echo('</td></tr></table>');
                                    // echo ('Modifier email d\'identification: '); // creation d'un label devant la zone de saisie
                                    // echo('</td><td>');
                                    echo '<div class="form-group">';
                                    echo form_label('Modifier email:','ModEmail');
                                    echo form_input('mail',$mail,array('pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})','class'=>'form-control'));
                                    echo '</div>';
                                    // echo('</td></tr>');

                                    // echo('<tr><td>');
                                    // echo ('Modifier téléphone : '); // creation d'un label devant la zone de saisie
                                    // echo('</td><td>');
                                    echo '<div class="form-group">';
                                    echo form_label('Modifier téléphone :','ModTel');
                                    echo form_input('notel',$notel,array('pattern'=>'[0-9]{10}','class'=>'form-control'));
                                    echo '</div>';
                                    // echo('</td></tr>');

                                  

                                    // echo('<tr><td>');
                                    // echo ('Modifier question Secrète: '); // creation d'un label devant la zone de saisie
                                    // echo('</td><td>');
                                    echo '<div class="form-group">';
                                    echo form_label('Modifier Question:','ModQuest');
                                    echo form_dropdown('Question', $Question, $noQuestion,array('class'=>'form-control'));
                                    echo '</div>';
                                    // echo('</td></tr>');
                                    // echo('<tr><td>');
                                    // echo ('Reponse: '); 
                                    // echo('</td><td>');
                                    echo '<div class="form-group">';
                                    echo form_label('Nouvelle réponse :','ModReponse');
                                    echo form_input('reponse',$reponse,array('required'=>'required','pattern'=>'[A-Za-z0-9 ]{1,40}','class'=>'form-control'));
                                    echo '</div>';
                                    // echo('</td></tr>');

                                    // echo('<tr><td>');
                                    // echo('</td><td>');
                                    echo form_submit('modif', 'Modifier');
                                    // echo('</td></tr>');
                                    // echo('</table>');
                                    echo '<div class="text-right">';
                                    echo '<a style="color:#FFFFFF" href="'.site_url('Acteur/ModifierMDP').'">Modifier son mot de passe ? </a>';
                                    echo '</div>';  
                                    //echo form_submit('retour', 'Retour');
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
