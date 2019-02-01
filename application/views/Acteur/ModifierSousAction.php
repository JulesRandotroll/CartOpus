<ul class="nav navbar-nav navbar-right">
                        <?php 
                        echo'<li><a href="'.site_url('Acteur/ChoixAction/1').'" style="color:#FFFFFF"><span class="glyphicon list-alt"></span> Afficher Action</a></li>';
                        echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
                        echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div><div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Modifier une Sous Action</H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                        echo form_open('Acteur/ModifierSousAction/'.$NOACTION.'/'.$TitreAction.'/'.$DateDebut.'/'.$NOLIEU);
                        if ($message!="")
                        {
                        echo'<div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Attention</strong> '.$message.'
                            </div>';
                        }
                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                            echo form_label('Titre de l\'action : ', 'Name');
                            echo form_input('TitreAction',$TitreAction, array("placeholder"=>"Nom de votre action",'required'=>'required','class'=>'form-control'));
                        echo '</div>';
                        
                        echo '<div class="row">';
                            echo '<div class="col-xs-4">';
                                echo '<div class="form-group">';
                                    echo form_label('Adresse : ', 'adresse');
                                    echo form_input('Adresse', $Adresse, Array("placeholder"=>"Adresse ex : 1 rue de la plomberie",'class'=>'form-control'));
                                echo '</div>';
                            echo'</div>';

                            echo '<div class="col-xs-4">';
                                echo '<div class="form-group">';
                                echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                                    echo form_label('Code Postal : ', 'CP');
                                    echo form_input('CodePostal', $CodePostal, Array('pattern'=>'([A-Z]+[A-Z]?\-)?[0-9]{1,2} ?[0-9]{3}','placeholder'=>'Code postale ex : 22000','required'=>'required','class'=>'form-control'));
                                echo '</div>';
                            echo '</div>';

                            echo '<div class="col-xs-4">';
                                echo '<div class="form-group">';
                                    echo form_label('Ville : ', 'ville');
                                    echo form_input('Ville', $Ville, Array("placeholder"=>"Ville ex : Saint Brieuc",'pattern="[a-zA-Z ]*"','required'=>'required','class'=>'form-control'));
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        // $ToDay = date('d/m/Y');
                        $ToDayH = date('H:i');
                        $ToDay = date('d/m/Y');

                        echo '<div class="row">';
                            echo '<div class="col-xs-6">';
                                echo '<div class="form-group">';
                                echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                                    echo form_label('Date de debut : ', 'dd');
                                    echo '<input class="form-control" name="DateDebut" id="date" type="date" value="'.$DateDebutA.'">';//$ToDay
                                echo '</div>';
                                echo '<div class="form-group">';
                                echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                                    echo form_label('Heure de debut : ', 'dd');
                                    echo '<input class="form-control" name="HeureDebut" id="time" type="time" value="'.$ToDayH.'">';
                                    //echo form_input('HeureDebut', '', Array("placeholder"=>"Heure ex : 14:14",'required'=>'required','class'=>'form-control'));
                                echo '</div>';
                            echo'</div>';

                            echo '<div class="col-xs-6">';
                                echo '<div class="form-group">';
                                    echo form_label('Date de fin : ', 'df');
                                    echo '<input class="form-control" name="DateFin" id="date" type="date" value="'.$DateFinA.'" >';//$ToDay
                                    //echo form_input('DateFin', '', Array("placeholder"=>"Date ex : 12-12-2012",'pattern'=>'(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d\d','required'=>'required','class'=>'form-control'));
                                echo '</div>';
                                echo '<div class="form-group">';
                                    echo form_label('Heure de fin : ', 'dd');
                                    echo '<input name="HeureFin" class="form-control" id="time" type="time" >';
                                    //echo form_input('HeureFin', '', Array("placeholder"=>"Heure ex : 15:15",'required'=>'required','class'=>'form-control'));
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';

                        echo '<div class="form-group">';
                            echo form_label('Description ', 'Desc');
                            echo form_textarea('Description', $Description,Array("placeholder"=>"Ici, votre description",'class'=>'form-control'));
                        echo '</div>';
                        
                         echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont obligatoires</h6> ';
                        
                        echo '<div class="text-right">';
                        echo form_submit('Modifier', 'Modifier',array("class"=>"btn btn-danger btn-lg"));
                        echo '</div>';

                        
                       
                        echo form_close();
                    ?>
                </div>
            <section>
        </div>
    </div>    
</div>
<script>
$(document).ready(function(){
$('[data-toggle="popover"]').popover();
});
</script>
