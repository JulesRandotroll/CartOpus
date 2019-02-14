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
</div>
<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Modifier une organisation</H1>
            </div>
            <section>
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                        echo form_open('Acteur/ModifierOrga/'.$noOrga);
                        //var_dump($message);
                        if ($message!="")
                        {
                            echo'<div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Attention</strong> '.$message.'
                                </div>';
                        }

                        echo '<div class="form-group">';
                            echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                            echo form_label('Nom de l\'organisation : ', 'Name');
                            echo form_input('NomOrga',$NomOrga, array("placeholder"=>"Nom de votre organisation",'pattern'=>'[a-zA-Z0-9" éèëïùàäüô\'-.#+=?:€!%<@*~,&/çµ()]','required'=>'required',"class"=>"form-control"));
                        echo '</div>';

                        echo '<div class="col-xs-4">';
                            echo '<div class="form-group">';
                                echo form_label('Adresse : ', 'adresse');
                                echo form_input('Adresse', $Adresse, Array("placeholder"=>"Adresse ex : 1 rue de la plomberie","class"=>"form-control"));
                            echo '</div>';
                        echo'</div>';

                        echo '<div class="col-xs-4">';
                            echo '<div class="form-group">';
                            echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                                echo form_label('Code Postal : ', 'CP');
                                echo form_input('CodePostal', $CodePostal, Array('pattern'=>'([A-Z]+[A-Z]?\-)?[0-9]{1,2} ?[0-9]{3}','placeholder'=>'Code postal ex : 22000','required'=>'required',"class"=>"form-control"));
                            echo '</div>';
                        echo '</div>';

                        echo '<div class="col-xs-4">';
                            echo '<div class="form-group">';
                            echo '<span style="color:#FF0000" data-toggle="popover" title="*" data-trigger="hover" data-content="Ce champ est obligatoire"/> * </span>';
                                echo form_label('Ville : ', 'ville');
                                echo form_input('Ville', $Ville, Array("placeholder"=>"Ville ex : Saint Brieuc",'pattern="[a-zA-Z ]*"','required'=>'required',"class"=>"form-control"));
                            echo '</div>';
                        echo '</div>';

                        echo '<div class="form-group">';
                            echo form_label('Telephone : ', 'Telephone');
                            echo form_input('tel',$tel,array('pattern'=>'(01|02|03|04|05|06|07|08|09)[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}','placeholder'=>'Votre numero de téléphone (facultatif)','class'=>'form-control'));
                        echo '</div>';

                        echo '<div class="form-group">';
                            echo form_label('Fax : ', 'fax');
                            echo form_input('fax',$fax,array('pattern'=>'(01|02|03|04|05|06|07|08|09)[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}','placeholder'=>'Votre numero de fax (facultatif)','class'=>'form-control'));//
                        echo '</div>';
                        
                        echo '<div class="form-group">';
                            echo form_label('Site de l\'action : ', 'site');
                            $regex = '(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$';
                            echo form_input('SiteURL', $SiteURL, array("placeholder"=>"https://www.exemple.fr","class"=>"form-control",'pattern'=>$regex,'title'=>'http(s)://exemple.fr ou ftp://exemple.fr'));//,'pattern'=>'(((ht|f)tp(s?))\:\/\/)?(([a-zA-Z0-9]+([@\-\.]?[a-zA-Z0-9]+)*)(\:[a-zA-Z0-9\-\.]+)?@)?(www.|ftp.|[a-zA-Z]+.)?[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,})(\:[0-9]+)'
                        echo '</div>';
                            
                        echo '<div class="text-center">';
                            echo form_submit('modif', 'Modifier',array("class"=>"btn btn-danger btn-lg"));
                        echo '</div>';
                        
                        echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont obligatoires</h6> ';
                        echo form_close();
                        
                    ?>
                </div>
            </section>
        </div>
    </div>    
</div>

<script>
$(document).ready(function(){
$('[data-toggle="popover"]').popover();
});
</script>