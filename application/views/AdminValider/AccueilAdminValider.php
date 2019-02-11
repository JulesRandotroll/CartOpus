                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo site_url('AdminValider/GererFilActu') ?>" style="color:#FFFFFF;"><span class="glyphicon glyphicon-star"></span> Gérer fil actualité</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('AdminValider/GererMotCles') ?>" style="color:#FFFFFF;"><span class="glyphicon glyphicon-list-alt"></span> Gerer Mots Cles</a> 
                        </li>
                        <li>
                            <a href="<?php echo site_url('AdminValider/GererRole') ?>" style="color:#FFFFFF"><span class="glyphicon glyphicon-briefcase"></span> Gerer rôles</a>
                        </li>';
                           






                        <li>
                            <a href="<?php echo site_url('Visiteur/SeDeconnecter'); ?>" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="row" style="background-color:#15B7D1"> 
    <div class="col-sm-2">
    </div> 
    <div class="col-sm-8">
        <div class = "text-center">
            <H1 align = "center" style="color:#FFFFFF">Actions signalées</H1><BR>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                        <?php 
                            $this->table->set_heading('Nom Action','Public ciblé','Date début','Acteur','Signalements','');  

                            if($Actions != null)
                            {
                                $nom='';
                                $linkNomAction;
                                $public;
                                $acteur;
                                $Signalement;
                                $btn;
                                $Date;
                                foreach($Actions as $uneAction)
                                {   
                                    if($uneAction['NOMACTION']==$nom)
                                    {
                                        $Signalement = $Signalement.'<li>'.$uneAction['libelleSignalement'].' ('.$uneAction['compteur'].')</li>';
                                    }
                                    else
                                    {
                                        //Ajout de la ligne précédente
                                        if(!empty($linkNomAction))
                                        {
                                            $Signalement = $Signalement.'</ul>';
                                            $this->table->add_row($linkNomAction,$public,$Date,$acteur,$Signalement,$btn);
                                        }
                                        
                                        $nom = $uneAction['NOMACTION'];
                                        $linkNomAction =    '<a href="'.site_url('Visiteur/AfficherAction/'.$uneAction['NOACTION']).'" style="color:#FFFFFF">'.
                                                        $uneAction['NOMACTION'].
                                                    '</a>'
                                        ;
                                        $public = $uneAction['PublicCible'];
                                        $Date = $uneAction['DATEDEBUT'];
                                        $acteur =   '<a href="'.site_url('Visiteur/AfficherActeurAction/'.$uneAction['NOACTEUR']).'" style="color:#FFFFFF">'
                                                        .$uneAction['NOMACTEUR'].' '.$uneAction['PRENOMACTEUR'].
                                                    '</a>'
                                        ;
                                        $Signalement = '<ul><li>'.$uneAction['libelleSignalement'].' ('.$uneAction['compteur'].')</li>'; 
                                        $btn =  form_open('AdminValider/InvaliderAction/'.$uneAction['NOACTION']).
                                                    form_submit('Invalider', 'Invalider',array('class'=>'btn btn-danger')).
                                                form_close()
                                        ;
                                    }
                                    
                                }
                                $this->table->add_row($linkNomAction,$public,$Date,$acteur,$Signalement,$btn);
                                $Style = array('table_open' => '<table class="table" >');
                                $this->table->set_template($Style);
                                
                                echo $this->table->generate();
                            }
                            else
                            {
                                echo '<H4> Aucune action signalée pour l\'instant. </H4>';
                            }
                        
                        ?>
                </div>
            </section>
            <BR>
        </div>
    </div>
</div>

<!-- 
    <table class="table">
        <tr>
            <th>
                Nom Action    
            </th>
            <th>
                Public ciblé
            </th>
            <th>
                Date début
            </th>
            <th>
                Acteur
            </th>
            <th>
                Signalement(s)
            </th>
            <th>
            
            </th>
        </tr>
        <?php 
            //var_dump($Actions);
            foreach($Actions as $uneAction)
            {
                echo '<tr>';
                    echo '<td>';
                        echo '<a href="'.site_url('Visiteur/AfficherAction/'.$uneAction['NOACTION']).'" style="color:#FFFFFF">'.
                            $uneAction['NOMACTION'].
                        '</a>';
                    echo '</td>';
                    echo '<td>';
                        echo $uneAction['PublicCible'];
                    echo '</td>';    
                    echo '<td>';
                        echo $uneAction['DATEDEBUT'];
                    echo '</td>';
                    echo '<td>';
                        echo '<a href="'.site_url('Visiteur/AfficherActeurAction/'.$uneAction['NOACTEUR']).'" style="color:#FFFFFF">'
                            .$uneAction['NOMACTEUR'].' '.$uneAction['PRENOMACTEUR'].
                        '</a>';
                    echo '</td>';
                    echo '<td class="text-center">';
                        echo $uneAction['libelleSignalement'].' ('.$uneAction['compteur'].')';
                    echo '</td>';
                    echo '<td>';
                        echo form_open('AdminValider/InvaliderAction/'.$uneAction['NOACTION']);
                            echo form_submit('Invalider', 'Invalider',array('class'=>'btn btn-danger'));
                        echo form_close();
                    echo '</td>';
                echo '</tr>';

            }
        ?>                 
    </table> 
-->