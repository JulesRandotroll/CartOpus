<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Ajouter une nouvelle action</H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                        echo form_open('Acteur/NouvelleAction');

                        echo '<div class="form-group">';
                        echo '<span style="color:#FF0000"/> * </span>';
                        echo form_label('Nom de l\'action : ', 'Name');
                        echo form_input('NomAction', '', Array("placeholder"=>"Nom de votre action",'required'=>'required','class'=>'form-control'));
                        echo '</div>';
                        
                        echo '<div class="col-xs-4">';
                            echo '<div class="form-group">';
                                echo form_label('Adresse : ', 'adresse');
                                echo form_input('Adresse', '', Array("placeholder"=>"Adresse ex : 1 rue de la plomberie",'required'=>'required','class'=>'form-control'));
                            echo '</div>';
                        echo'</div>';
                        echo '<div class="col-xs-4">';
                            echo '<div class="form-group">';
                                echo '<span style="color:#FF0000"/> * </span>';
                                echo form_label('Code Postale : ', 'CP');
                                echo form_input('CodePostale', '', Array('pattern'=>'([A-Z]+[A-Z]?\-)?[0-9]{1,2} ?[0-9]{3}','placeholder'=>'Code postale ex : 22000','required'=>'required','class'=>'form-control'));
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-xs-4">';
                            echo '<div class="form-group">';
                                echo '<span style="color:#FF0000"/> * </span>';
                                echo form_label('Ville : ', 'ville');
                                echo form_input('Ville', '', Array("placeholder"=>"Ville ex : Saint Brieuc",'pattern="[a-zA-Z ]*"','required'=>'required','class'=>'form-control'));
                            echo '</div>';
                        echo '</div>';

                        echo '<div class="col-xs-6">';
                            echo '<div class="form-group">';
                                echo '<span style="color:#FF0000"/> * </span>';
                                echo '<input id="date" type="date" value="2017-06-01">';
                                echo '<input id="time" type="time">';
                                echo form_label('Date de debut : ', 'dd');
                                echo form_input('DateDebut', '', Array("placeholder"=>"Date ex : 11-11-2011",'pattern'=>'(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d\d','required'=>'required','class'=>'form-control'));
                            echo '</div>';
                        echo'</div>';
                        echo '<div class="col-xs-6">';
                            echo '<div class="form-group">';
                                echo form_label('Date de fin : ', 'df');
                                echo form_input('DateFin', '', Array("placeholder"=>"Date ex : 12-12-2012",'pattern'=>'(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d\d','required'=>'required','class'=>'form-control'));
                            echo '</div>';
                        echo '</div>';
                        // echo '</div>';
                        $options = array(
                            "Tout Public"=>"Tout Public",
                            "Enfants"=>"Enfants",
                            "Jeunes"=>"Jeunes",
                            "Adultes"=>"Adultes",
                            "3eme Age"=>"3eme Age",
                            "Familiale"=>"Familiale",
                            "Professionnels"=>"Professionnels",
                        );


                        echo '<div class="form-group">';
                        echo form_label('Public ciblé : ', 'Public');
                        echo form_dropdown('Publique', $options,'' ,Array('required'=>'required','class'=>'form-control'));
                        echo '</div>';

                        echo '<div class="form-group">';
                        echo form_label('Description ', 'Desc');
                        echo form_textarea('Description', '',Array("placeholder"=>"Ici, votre description",'required'=>'required','class'=>'form-control'));
                        echo '</div>';

                        echo '<div class="form-group">';
                        echo form_label('Site de l\'action : ', 'site');
                        echo form_input('SiteURL', '', Array("placeholder"=>"https://www.exemple.fr",'pattern'=>'(((ht|f)tp(s?))\:\/\/)?(([a-zA-Z0-9]+([@\-\.]?[a-zA-Z0-9]+)*)(\:[a-zA-Z0-9\-\.]+)?@)?(www.|ftp.|[a-zA-Z]+.)?[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,})(\:[0-9]+)','required'=>'required','class'=>'form-control'));
                        echo '</div>';
                        
                        echo '<div class="text-center">';
                        echo form_submit('Ajouter', 'Ajouter',array("class"=>"btn btn-danger btn-lg"));
                        echo '</div>';
                        echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont requis</h6> ';
                        echo form_close();
                    ?>
                </div>
            <section>
        </div>
    </div>    
</div>

