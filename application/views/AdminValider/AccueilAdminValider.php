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
<?php 

// var_dump($Actions);

?>
<div class="row" id='principale' style="background-color:#15B7D1"> 
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
                                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                                $nom='';
                                $linkNomAction;
                                $public;
                                $acteur;
                                $Signalement;
                                $btn;
                                $Date;
                                $nbSignalement;
                                $CommentairesSignalement = null;
                                

                                foreach($Actions as $uneAction)
                                {   
                                    //var_dump($uneAction);
                                    if($uneAction['NOMACTION']==$nom)
                                    {
                                        if($uneAction['libelleSignalement']!=$SignalementActuel)
                                        {
                                            $Signalement = $Signalement.' ('.$nbSignalement.')</li><li>'.$uneAction['libelleSignalement'];
                                            $SignalementActuel = $uneAction['libelleSignalement'];
                                            $nbSignalement=1;
                                        }
                                        else
                                        {
                                            $nbSignalement++;
                                        }
                                    }
                                    else
                                    {
                                        //Ajout de la ligne précédente
                                        if(!empty($linkNomAction))
                                        {
                                            $Signalement = $Signalement.' ('.$nbSignalement.')</li></ul>';
                                            $this->table->add_row($linkNomAction,$public,$Date,$acteur,$Signalement,$btn);
                                            //$Details = $Details.$entete.$tableau.$pied;
                                            $CommentairesSignalement=null;
                                        }
                                        
                                        
                                        //Tableau général
                                        $nom = $uneAction['NOMACTION'];
                                        $linkNomAction =    '<a href="'.site_url('Visiteur/AfficherAction/'.$uneAction['NOACTION']).'" style="color:#FFFFFF">'.
                                                        $uneAction['NOMACTION'].
                                                    '</a>'
                                        ;
                                        $public = $uneAction['PublicCible'];
                                        
                                        $DateDebut =$uneAction['DATEDEBUT'];
                            
                                        //Gestion date
                                            $jour = strftime("%A %d",strtotime($DateDebut));
                                            $mois = strftime("%B",strtotime($DateDebut));
                                            $Annee = strftime("%Y",strtotime($DateDebut));
                                            $Heure = strftime("%Hh%M",strtotime($DateDebut)); 
                                        
                                        
                                            if(substr($mois,0,1) == 'f')
                                            {
                                                $mois = 'février';
                                            }
                                            elseif(substr($mois,0,1) == 'd')
                                            {
                                                $mois = 'décembre';
                                            }
                                            elseif(substr($mois,0,1) == 'a')
                                            {
                                                $mois = 'août';
                                            }
                                        //Fin dates
                                        $Date = $jour.' '.$mois.' '.$Annee.' '.$Heure;
                            
                                        $acteur =   '<a href="'.site_url('Visiteur/AfficherActeurAction/'.$uneAction['NOACTEUR']).'" style="color:#FFFFFF">'
                                                        .$uneAction['NOMACTEUR'].' '.$uneAction['PRENOMACTEUR'].
                                                    '</a>'
                                        ;
                                        $Signalement = '<ul><li>'.$uneAction['libelleSignalement']; 
                                        $SignalementActuel = $uneAction['libelleSignalement'];
                                        $nbSignalement=1;
                                        $btn =  form_open('AdminValider/InvaliderAction/'.$uneAction['NOACTION']).
                                                    form_submit('Invalider', 'Invalider',array('class'=>'btn btn-danger')).
                                                form_close().
                                            '<a href="#'.$uneAction['NOACTION'].'" style="color:#FFFFFF">détails +</a>'
                                        ;
                                    }
                                    
                                }//Fin foreach

                                $Signalement = $Signalement.' ('.$nbSignalement.')</li></ul>';
                                $this->table->add_row($linkNomAction,$public,$Date,$acteur,$Signalement,$btn);
                                $Style = array('table_open' => '<table class="table" >');
                                $this->table->set_template($Style);
                                
                                echo $this->table->generate();
                                //$Details = $Details.$entete.$tableau.$pied;



                                $nom='';
                                $Details='';
                                $tableau;

                                $pied = 
                                                        '</table>
                                                        <div class="text-right">
                                                            <a href="#principale" style="color:#FFFFFF">Retour</a>
                                                        </div>
                                                    </div>
                                                </section>
                                                <BR>
                                            </div>
                                        </div>
                                    </div>'
                                ;

                                foreach($Actions as $uneAction)
                                {
                                    //var_dump($uneAction);
                                    if($uneAction['NOMACTION']==$nom)
                                    {
                                        //echo 'même nom : '.$nom.' = '.$uneAction['NOMACTION'];
                                        if($uneAction['libelleSignalement']==$SignalementActuel)
                                        {
                                            if($uneAction['commentaire']!=null)
                                            {
                                                if($CommentairesSignalement!=null)
                                                {
                                                    $CommentairesSignalement=$CommentairesSignalement.'</li><li>'.$uneAction['commentaire'];
                                                }
                                                else
                                                {
                                                    $CommentairesSignalement='<ul><li>'.$uneAction['commentaire'];
                                                }
                                            }
                                            
                                        }
                                        else
                                        {
                                            if($CommentairesSignalement==null)
                                            {
                                                $CommentairesSignalement='Aucun commentaire pour ce signalement';
                                            }
                                            $tableau = $tableau.'</td><td>'.$CommentairesSignalement.'</td></tr>';

                                            //Passage ligne d'après
                                            $SignalementActuel = $uneAction['libelleSignalement'];
                                            //gestion dates   
                                                $jour = strftime("%A %d",strtotime($uneAction['DateSignalement']));
                                                $mois = strftime("%B",strtotime($uneAction['DateSignalement']));
                                                $Annee = strftime("%Y",strtotime($uneAction['DateSignalement']));
                                                $Heure = strftime("%Hh%M",strtotime($uneAction['DateSignalement'])); 
                                            
                                            
                                                if(substr($mois,0,1) == 'f')
                                                {
                                                    $mois = 'février';
                                                }
                                                elseif(substr($mois,0,1) == 'd')
                                                {
                                                    $mois = 'décembre';
                                                }
                                                elseif(substr($mois,0,1) == 'a')
                                                {
                                                    $mois = 'août';
                                                }
                                            //Fin dates
                                            $dateSignalement = $jour.' '.$mois.' '.$Annee.' '.$Heure;
                                            
                                            $tableau = $tableau.'<tr><td>'.$SignalementActuel.'</td><td>'.$dateSignalement;
                                            if($uneAction['commentaire']!=null)
                                            {
                                                $CommentairesSignalement='<ul><li>'.$uneAction['commentaire'];
                                            }   
                                            else
                                            {
                                                $CommentairesSignalement=null;
                                            } 
                                        }
                                    }
                                    else
                                    {

                                        if(!empty($tableau))
                                        {
                                            if($CommentairesSignalement==null)
                                            {
                                                $CommentairesSignalement='Aucun commentaire pour ce signalement';
                                            }
                                            $tableau = $tableau.'</td><td>'.$CommentairesSignalement.'</td></tr>';

                                            $Details = $Details.$entete.$tableau.$pied;
                                        }

                                        $tableau = '<tr><th>Motif</th><th>Date premier commentaire</th><th>Commentaire(s)</th></tr>';

                                        $nom=$uneAction['NOMACTION'];


                                        //Gestion date
                                            $DateDebut =$uneAction['DATEDEBUT'];
                                            $jour = strftime("%A %d",strtotime($DateDebut));
                                            $mois = strftime("%B",strtotime($DateDebut));
                                            $Annee = strftime("%Y",strtotime($DateDebut));
                                            $Heure = strftime("%Hh%M",strtotime($DateDebut)); 
                                        
                                        
                                            if(substr($mois,0,1) == 'f')
                                            {
                                                $mois = 'février';
                                            }
                                            elseif(substr($mois,0,1) == 'd')
                                            {
                                                $mois = 'décembre';
                                            }
                                            elseif(substr($mois,0,1) == 'a')
                                            {
                                                $mois = 'août';
                                            }
                                        //Fin dates
                                        $Date = $jour.' '.$mois.' '.$Annee.' '.$Heure;
                                        

                                        $SignalementActuel = $uneAction['libelleSignalement'];
                                    
                                        $TitreDetail = '<H1 align = "center" style="color:#FFFFFF">'.$nom.'</H1><H4>'.$Date.'</H4>';
                                        $SignalementDetail = $uneAction['libelleSignalement'];
                                        //var_dump($TitreDetail);
                                        
                                        
                                        //gestion dates   
                                            $jour = strftime("%A %d",strtotime($uneAction['DateSignalement']));
                                            $mois = strftime("%B",strtotime($uneAction['DateSignalement']));
                                            $Annee = strftime("%Y",strtotime($uneAction['DateSignalement']));
                                            $Heure = strftime("%Hh%M",strtotime($uneAction['DateSignalement'])); 
                                        
                                        
                                            if(substr($mois,0,1) == 'f')
                                            {
                                                $mois = 'février';
                                            }
                                            elseif(substr($mois,0,1) == 'd')
                                            {
                                                $mois = 'décembre';
                                            }
                                            elseif(substr($mois,0,1) == 'a')
                                            {
                                                $mois = 'août';
                                            }
                                        //Fin dates
                                        $dateSignalement = $jour.' '.$mois.' '.$Annee.' '.$Heure;
                                            
                                        if($uneAction['commentaire']!=null)
                                        {
                                            $CommentairesSignalement='<ul><li>'.$uneAction['commentaire'];
                                        }
                                        else
                                        {
                                            $CommentairesSignalement=null;
                                        }


                                        $tableau = $tableau.'<tr><td>'.$SignalementActuel.'</td><td>'.$dateSignalement;

                                        $entete = 
                                            '<div class="row info" id="'.$uneAction['NOACTION'].'"  style="background-color:#15B7D1"> 
                                                <div class="col-sm-2">
                                                </div> 
                                                <div class="col-sm-8">
                                                    <div class = "text-center">
                                                        <section >
                                                            <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                                                                <H1 align = "center" style="color:#FFFFFF">'.$TitreDetail.'</H1><BR>
                                                                <table class="table">'                
                                        ;
                                    }
                                }//fin foreach
                                if($CommentairesSignalement==null)
                                {
                                    $CommentairesSignalement='Aucun commentaire pour ce signalement';
                                }
                                $tableau = $tableau.'</td><td>'.$CommentairesSignalement.'</td></tr>';

                                $Details = $Details.$entete.$tableau.$pied;
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
<?php 
    echo $Details;

?>
