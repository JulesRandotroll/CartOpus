                <div class = "text-center">
                <BR>
                <?php 
                if ( $this->session->statut ==0)
                {
                    echo'<a href="'.site_url('Visiteur/SInscrire').'" class="btn btn-danger" > S\'inscrire</a>   ';
                    echo'<a href="'.site_url('Visiteur/SeConnecter').'" class="btn btn-danger" > Se connecter</a>';
                }
                else
                {
                    echo'<a href="'.site_url('Visiteur/SeDeconnecter').'" class="btn btn-danger" > Se Déconnecter</a>   ';
                }
                ?>  
                </div>
            </div>
        </div>
    </section>
</div>


 <div class="row" style="background-color:#15B7D1;padding:20px"> 
    <div class="col-sm-1">
        <?php 
            echo form_open('Visiteur/GetActionRecherchee');
            
        ?>
    </div>
    <div class="col-sm-3" style="padding:10px">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="padding:10px">
                    <div class="form-group">
                        <?php 
                            echo form_label('Rechercher :', 'lbl_Recherche');
                            echo '  ';
                            echo form_input('MotCle', '', array('placeholder'=>'Rechercher'));
                            echo ' ';
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo form_label('Thématique :', 'lbl_Thematique');
                            echo ' ';
                            $option = array(
                                'Musique'=>array('Musique','Rock','Jazz','Blues'),
                                'Sport'=>array('Sport','Kayak','Karate')
                            );
                            echo form_dropdown('Thematique', $option, 'default');
                            echo ' ';
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="col-sm-3" style="padding:10px">
        <div class = "text-center">
            <section>
                <div class = "section-inner" style="padding:10px">
                    <div class="form-group">
                        <?php
                            echo form_label('Date :', 'lbl_Date');
                            echo '  ';
                            $jour = array(
                                1=>1,
                                2=>2,
                                3=>3,
                                4=>4,
                                5=>5,
                                6=>6,
                                7=>7,
                                8=>8,
                                9=>9,
                                10=>10,
                                11=>11,
                                12=>12,
                                13=>13,
                                14=>14,
                                15=>15,
                                16=>16,
                                17=>17,
                                18=>18,
                                19=>19,
                                20=>20,
                                21=>21,
                                22=>22,
                                23=>23,
                                24=>24,
                                25=>25,
                                26=>26,
                                27=>27,
                                28=>28,
                                29=>29,
                                30=>30,
                                31=>31
                            );
                            
                            $mois = array(
                                01=>'Janvier',
                                02=>'Fevrier',
                                03=>'Mars',
                                04=>'Avril',
                                05=>'Mai',
                                06=>'Juin',
                                07=>'Juillet',
                                08=>'Aout',
                                09=>'Septembre',
                                10=>'Octobre',
                                11=>'Novembre',
                                12=>'Decembre',
                            );
                            
                            $AnneeEnCours = date('Y');
                            
                            $annee = array(
                                $AnneeEnCours-5=>$AnneeEnCours-5,
                                $AnneeEnCours-4=>$AnneeEnCours-4,
                                $AnneeEnCours-3=>$AnneeEnCours-3,
                                $AnneeEnCours-2=>$AnneeEnCours-2,
                                $AnneeEnCours-1=>$AnneeEnCours-1,
                                $AnneeEnCours=>$AnneeEnCours,
                                $AnneeEnCours+1=>$AnneeEnCours+1
                            );

                            echo form_dropdown('Jour', $jour, date('d'));
                            echo form_dropdown('Mois', $mois, date('m'));
                            echo form_dropdown('Annee', $annee, date('Y'));
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="col-sm-3" style="padding:10px">
        <div>
            <section>
                <div class = "section-inner" style="padding:10px">
                    <div class="form-group">
                       
                            <?php
                                
                                echo form_label('Lieu :', 'lbl_Lieu');
                                echo '  '; 
                                
                                echo form_input('Lieu', '', array('placeholder'=>'Rechercher'));
                                echo ' ';
                            ?>
                       
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="col-sm-1">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="padding:20px">
                    <BR>
                    <div class="form-group">
                        <?php 
                            echo form_submit('submit','Rechercher',array('class'=>'btn-danger btn-lg'));
                            echo form_close();
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-1" style="padding:20px">
    </div>
    <div class="col-sm-10" style="padding:20px">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <H1 style="color:#FFFFFF">Actualité<H1>
                </div>
            </section>
        </div>
    </div>
</div>



