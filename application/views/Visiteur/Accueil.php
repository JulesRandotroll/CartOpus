                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        //var_dump($this->session->statut);
                        if ($this->session->statut==0){
                            echo'<li><a href="'.site_url('Visiteur/SInscrire').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                            echo'<li><a href="'.site_url('Visiteur/SeConnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>';
                        }
                        else
                        {
                            if ($this->session->statut==1){
                            echo'<ul class="nav navbar-nav">';
                            echo '<li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFFFFF ;background-color:#0E7896">Action
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu" style="background-color:#139CBC">
                                    <li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>
                                    <li><a href="'.site_url('Acteur/ReitererAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-repeat"></span> Réitérer Action</a></li>
                                    <li><a href="'.site_url('#').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-pencil"></span> Modifier Action</a></li>
                                </ul>
                            </li>';
                           // echo'<li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Creation Action</a></li>';
                            echo'<li><a href="'.site_url('Acteur/GestionProfil').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-cog"></span> Compte</a></li>';
                            echo'</ul>';
                            echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>';
                            echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</a></li>';
                            }
                            if($this->session->statut==4)
                            {
                                echo'<li><a href="'.site_url('#').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>';
                                echo'<li><a href="'.site_url('#').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</a></li>';
                            }
                            if($this->session->statut==5)
                            {
                                echo'<li><a href="'.site_url('SuperAdmin/AccueilSuperAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>';
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</a></li>';
                            }
                        }
                        ?>
                    </ul>

                    <!-- if($this->session->statut==1) -->
                    <!-- <ul class="nav navbar-nav">
                        <li><a href="#" style="color:#FFFFFF">Creation Action</a></li>
                        <li><a href="Acteur/GestionProfil" style="color:#FFFFFF">Compte</a></li>
                    </ul> -->
                </div>
            </div>
        </nav>
    </div>
</div>
 <div class="row" style="background-color:#15B7D1;padding:20px">
    <div class="col-sm-1">
        <?php
            echo form_open('Visiteur/Rechercher');
        ?>
    </div>
    <div class="col-sm-3" style="padding:10px">
        <div class = "text-center">
            <section>
                <div class = "section-inner" style="padding:10px">
                    <div class="form-group">
                        <?php
                            echo form_label('Rechercher :', 'lbl_Recherche');
                            echo '  ';
                            echo form_input('MotCle', '', array('placeholder'=>'Rechercher','class'=>'form-control', 'name'=>'txtRecherche','pattern'=>'^[a-zA-Z ]*'));
                            echo ' ';
                        ?>
                    </div>
                    <div class="form-group">
                        <?php

                            //echo form_submit('submit','Rechercher',array('class'=>'btn-danger btn-lg'));

                            // echo form_label('Thématique :', 'lbl_Thematique');
                            // echo ' ';
                            // $option = array(
                            //     'Musique'=>array('Musique','Rock','Jazz','Blues'),
                            //     'Sport'=>array('Sport','Kayak','Karate')
                            // );
                            // //echo form_dropdown('Thematique', $option, 'default',array('class'=>'form-control'));
                            // echo ' ';
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
                                '01'=>'Janvier',
                                '02'=>'Fevrier',
                                '03'=>'Mars',
                                '04'=>'Avril',
                                '05'=>'Mai',
                                '06'=>'Juin',
                                '07'=>'Juillet',
                                '13'=>'Aout',
                                '09'=>'Septembre',
                                '10'=>'Octobre',
                                '11'=>'Novembre',
                                '12'=>'Decembre',
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

                            $ToDay = date('d/m/Y');
                            //echo '<input class="form-control" name="DateDebut" id="date" type="date" value="'.$ToDay.'" required>';

                            // echo form_dropdown('Jour', $jour, date('d'),array('class'=>'form-control'));
                            // echo form_dropdown('Mois', $mois, date('m'),array('class'=>'form-control'));
                            // echo form_dropdown('Annee', $annee, date('Y'),array('class'=>'form-control'));
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
                                
                                echo form_input('Lieu', '', array('placeholder'=>'Rechercher','class'=>'form-control','name'=>'txtRechercheLieu','pattern'=>'^[a-zA-Z ]*'));
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
                    <!--<span class ="glyphicon glyphicon-search"></span>-->
                        <?php 
                            echo form_submit('submit','Rechercher',array('class'=>'btn-danger btn-lg'));
                            //echo form_upload('Photo');

                            echo form_close();
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2" style="padding:20px">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <H1 style="color:#FFFFFF">Les Actions</H1>

                        <?php

                            if(!empty($lesActions))
                            {
                        ?>
                        <table class='table'>
                            <tr>
                                <th>Nom Action</th>
                                <th>Public Cible</th>
                                <th>Site URL</th>
                            </tr>
                        <?php
                            foreach ($lesActions As $uneAction):
                                echo '<tr>';
                                echo '<td><h4>'.$uneAction['NOMACTION'].'</h4></td>';
                                echo '<td><h4>'.$uneAction['PublicCible'].'</h4></td>';
                                echo '<td><h4>'.$uneAction['SiteURLAction'].' </h4></td>';
                                echo '</tr>';
                            endforeach ;
                            }
                        ?>
                                </table>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-4" style="padding:20px">
    </div>
    <div class="col-sm-4" style="padding:20px">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <H1 style="color:#FFFFFF">Les Acteurs</H1>
                
                        <?php
                        
                        if(!empty($lesActeurs))
                        {
                            ?>
                                <table class='table'>
                                    <tr>
                                        <th></th>
                                        <th>Nom Acteur</th>
                                    </tr>
                                    <?php
                                    foreach ($lesActeurs As $unActeur):
                                        echo '<tr>';
                                        echo '<td><img src="'.img_url($unActeur['PhotoProfil']).'"></td>';
                                        echo '<td><h4>'.$unActeur['NOMACTEUR'].'</h4>';
                                        echo '<h5>'.$unActeur['PRENOMACTEUR'].'</h5></td>';
                                        echo '</tr>';
                                    endforeach ;
                        
                                    ?>
                                </table>
                        <?php
                        }

                        ?>
                    </table>
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
                    <H1 style="color:#FFFFFF">Les Organisations</H1>
                
                        <?php
                        
                        if(!empty($lesOrganisations))
                        {
                            ?>
                                <table class='table'>
                                    <tr>
                                        <th>Nom Organisation</th>
                                        <th>Numéro de Téléphone</th>
                                        <th>Numéro de Fax</th>
                                        <th>Site URL</th>
                                    </tr>
                                    <?php
                                    foreach ($lesOrganisations As $uneOrganisation):
                                        echo '<tr>';
                                        echo '<td><h4>'.$uneOrganisation['NOMORGANISATION'].'</h4></td>';
                                        echo '<td><h4>'.$uneOrganisation['NOTELORGA'].'</h4></td>';
                                        echo '<td><h4>'.$uneOrganisation['NOFAXORGA'].'</h4></td>';
                                        echo '<td><h4>'.$uneOrganisation['SITEURL'].'</h4></td>';
                                        echo '</tr>';
                                    endforeach ;
                        
                                    ?>
                                </table>
                        <?php
                        }
                            //if(!empty($lesThematiques))
                            //{
                                //foreach ($lesThematiques As $uneThematique):
                                    //echo '<tr>';
                                    //echo '<td><h4>'.$uneThematique['NOMACTION'].'</h4></td></br>';
                                    //echo '</tr>';
                                //endforeach ;
                            //}

                            //if(!empty($lesLieux))
                            //{
                                //foreach ($lesLieux As $unLieu):
                                    //echo '<tr>';
                                    //echo '<td><h4>'.$unLieu['Ville'].'</h4></td></br>';
                                    //echo '</tr>';
                                //endforeach ;
                            //}

                            //if(!empty($lesMotsCles))
                            //{
                                //foreach ($lesMotsCles As $unMotCle):
                                    //echo '<tr>';
                                    //echo '<td><h4>'.$unMotCle['NOMACTION'].'</h4></td></br>';
                                    //echo '</tr>';
                                //endforeach ;
                            //}

                        ?>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
