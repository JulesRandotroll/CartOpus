<ul class="nav navbar-nav navbar-right">
                        <?php 
                            echo'<li><a href="'.site_url('SuperAdmin/AccueilSuperAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> Page Perso</a></li>';
                            echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="row" style="background-color:#15B7D1"> 
    <div class="col-sm-4">
    <div class = "text-center">
        <H1 align = "center" style="color:#FFFFFF">Création de Thématique</H1><BR>;
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    Insertion de nouvelles thématiques ! 
                    <?php
                        echo '<div class="form-group">';
                        echo form_label('Nouvelle Thématique: ', 'NewTheme');
                        echo form_input('nouvellethematique','',array('required'=>'required','placeholder'=>'Ex: Musique','pattern'=>'[a-zA-Z]{1,40}','class'=>'form-control')); 
                        echo '</div>';

                        echo '<div class="text-center">';
                        echo form_submit('AjoutThematique', 'Ajouter',array('class'=>'btn btn-danger'));
                        echo '</div>';
                        
                    ?>
                </div>
            </section>
        <BR>
        </div>
    </div> 
    <div class="col-sm-4">
        <div class = "text-center">
        <H1 align = "center" style="color:#FFFFFF">Création de Sous-Thématique</H1><BR>;
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    Insertion de nouvelles sous-thématiques ! 
                    <?php
                        $thematique='plop';
                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000"/> * </span>';
                        echo form_label('Thématique : ', 'thematique'); 
                        echo form_dropdown('thematique', $thematique, 'default',array('required'=>'required','class'=>'form-control'));
                        echo '</div>';

                        echo '<div class="form-group">';
                        echo form_label('Nouveau Sous Thématique: ', 'NewSSTheme');
                        echo form_input('nouveausousthematique','',array('required'=>'required','placeholder'=>'Ex: Rock,Jazz,Pop','pattern'=>'[a-zA-Z]{1,40}','class'=>'form-control')); 
                        echo '</div>';

                        echo '<div class="text-center">';
                        echo form_submit('AjoutSSThematique', 'Ajouter',array('class'=>'btn btn-danger'));
                        echo '</div>';
                    ?>
                </div>
            </section>
        <BR>
        </div>
    </div>
    <div class="col-sm-4">
        <div class = "text-center">
        <H1 align = "center" style="color:#FFFFFF">Association de mots clés</H1><BR>;
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    Associations de nouveaux mots clés! 



                </div>
            </section>
        <BR>
        </div>
    </div>
</div>