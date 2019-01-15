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
<div class="row" style="background-color:#15B7D1;padding:20px">
</div>

<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <H1 style="color:#FFFFFF">Modifier Mot de Passe</H1>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <H4>
                        <?php
                            echo validation_errors(); // mise en place de la validation
                            echo form_open('Acteur/ModifierMDP');
                            // echo('<table style="width:100%"');
                            // echo('<tr><td width=73%>');
                            echo '<div class="form-group">';
                            echo '<span style="color:#FF0000"/> * </span>';
                            echo form_label('Ancien mot de passe :','MDP');
                            echo form_password('motdepasse','',array('class'=>'form-control','placeholder'=>'Votre mot de passe actuel'));
                            //echo '<H6>'.$message.'</H6>';
                            echo '</div>';

                            echo '<div class="form-group">';
                            echo '<span style="color:#FF0000"/> * </span>';
                            echo form_label('Nouveau mot de passe :','ModMDP');
                            echo form_password('newmotdepasse','',array('class'=>'form-control','placeholder'=>'Votre nouveau mot de passe '));
                            echo '<H6>'.$message.'</H6>';
                            echo '</div>';
        
                            echo '<div class="form-group">';
                            echo '<span style="color:#FF0000"/> * </span>';
                            echo form_label('Confirmation Mot de passe :','ConfMDP');
                            echo form_password('confmdp','',array('class'=>'form-control','placeholder'=>'La confirmation de votre nouveau mot de passe'));// VERIF si confirme == mdp
                            echo '</div>';
                
                            echo form_submit('modif', 'Modifier');

                            echo '<div class="text-right">';
                            echo '<a style="color:#FFFFFF" href="'.site_url('Acteur/GestionProfil').'">Modifier son profil? </a>';
                            echo '</div>';  
                            echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont requis</h6> ';
                            echo form_close();
                        ?>
                    </H4>
                </div>
            </section>
        </div>
    </div>    
</div>



                                   