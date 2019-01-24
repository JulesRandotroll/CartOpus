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
                <?php
                    $NomAction = str_replace('%20',' ',$NomAction);
                    $NomAction= str_replace('%C3%A9','é',$NomAction);
                    $NomAction= str_replace('%C3%BB','û',$NomAction);
                    $NomAction= str_replace('%C3%A0','à',$NomAction);
                    $NomAction= str_replace('%C3%BC','ü',$NomAction);
                    $NomAction= str_replace('%C3%B9','ù',$NomAction);
                    $NomAction= str_replace('%C3%AE','î',$NomAction);
                    $NomAction= str_replace('%C3%AF','ï',$NomAction);
                    $NomAction= str_replace('%C3%AB','ë',$NomAction);
                    $NomAction= str_replace('%C3%A8','è',$NomAction);
                    

                    $ActionSelect=$NomAction; // faire passer le nom choisie en paramètre
                    echo '<H1 style="color:#FFFFFF">Ajouter une thématique pour '.$ActionSelect.'</H1>';
                ?>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                        echo form_open('Acteur/AjoutThematique'.$NomAction);
                        echo '<div class="text-left">';
                            echo '<table class="table">';
                                echo '
                                <thead>
                                    <tr>
                                        <th>Thématique</th>
                                        <th ><button type="button" style="color:black; font-size:100%" class="btn btn-link btn-sm pull-right "><strong>+</strong></button></th> 
                                    </tr>
                                </thead> ';
                                echo'
                                <tbody>
                                    <tr>
                                        <td>';
                                        foreach ($uneThematique as $uneThematique)
                                        {
                                            echo $uneThematique['NOMTHEMATIQUE'];
                                        };
                                echo'
                                        </td>
                                    </tr>
                                </tbody>
                                ';
                                // tableau des thématiques deja associées 
                            echo '</table>';
                        echo '</div>';
                        echo '<div class="text-center">';
                            echo form_label('Thématique :', 'lbl_Thematique');
                            echo ' ';
                            $option = array(
                                'Musique'=>array('Musique','Rock','Jazz','Blues'),
                                'Sport'=>array('Sport','Kayak','Karate')
                            );
                    
                            echo form_dropdown('thematique', $option, 'default');
                        echo '</div>';
                ?>
                    <!-- <form action="AjoutThematique.php" method="post">
                        <?php 
                            foreach ($option as $uneOption) 
                            {
                                foreach($uneOption as $uneThematique):
                                echo' <input type="checkbox" name="theme[]" value='.$uneThematique.' />'.$uneThematique.'<br>';
                                endforeach;
                            }
                        ?>
                        <input type="submit" value="Lier" />
                    </form> -->
                <?php       
                        echo '<br><div class="text-center">';
                            echo form_submit('lier', 'Lier',array('class'=>'btn btn-danger'));
                        echo '</div>';
                        echo '<div class="text-right">';
                            echo'<h6><a href="'.site_url('Acteur/ContacterAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span>  Nouvelle Thématique ?</a></h6>';
                        echo '</div>';
                        
                    ?>
                </div>
            </section>
        </div>
    </div>    
</div>
