                    <ul class="nav navbar-nav navbar-right">
                        <?php
                          echo '<li class="dropdown">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFFFFF ;background-color:#0E7896">Action
                          <span class="caret"></span></a>
                          <ul class="dropdown-menu" style="background-color:#139CBC">
                            <li><a href="'.site_url('Acteur/ModifierAction/'.$Actions[0]['NOACTION'].'').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-pencil"></span> Modifier Action</a></li>
                            <li><a href="'.site_url('Acteur/AjoutSousAction/'.$Actions[0]['NOACTION'].'').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter SousAction</a></li>
                            <li><a href="'.site_url('Acteur/ReitererAction/'.$Actions[0]['NOACTION'].'').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-repeat"></span> Renouveler Action</a></li>
                            <li><a href="'.site_url('Acteur/SupprimerAction/'.$Actions[0]['NOACTION'].'').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-trash"></span> Supprimer Action</a></li>
                          </ul>
                  </li>';
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
    <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <div class = "text-center">
            <section>
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                        //var_dump($Actions);
                        // echo '<H1>'.$Actions[0]['NOMACTION'].'</H1>';
                        // echo '<H4>'.$Actions[0]['Description'].'</H4>';
                        $i = 0;
                        $AffichageAction="";
                        foreach($Actions as $uneAction)
                        {   
                            //var_dump($uneAction);
                            if ($i == 0)
                            {
                                echo '<H1>'.$uneAction['TitreAction'].'</H1>';
                                
                                date_default_timezone_set('Europe/Paris');
                                // --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
                                setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK
                                // strftime("jourEnLettres jour moisEnLettres annee") de la date courante
                            
                                $DateDebut = date_create($uneAction['DATEDEBUT']);
                                $DD = date_timestamp_get($DateDebut);
                                $Jour = strftime('%A',$DD);
                                
                                if($uneAction['DATEFIN'] != null)
                                {
                                    $DateFin = date_create($uneAction['DATEFIN']);
                                    $DF = date_timestamp_get($DateFin);

                                    //echo 'Test : '.(($DF-$DD)/60/60/24).'<BR><BR><BR>';
                                    if(($DF-$DD)/60/60/24 >= 1)
                                    {
                                        echo "Du :".strftime("%A %d %B %Y %H h %M",$DD).'<BR> Au : '.strftime("%A %d %B %Y %H h %M",$DF).'<BR>';
                                        echo '<H4>'.$uneAction['Description'].'</H4><BR>';
                                    }
                                    else
                                    {
                                        echo "De : ".strftime("%H h %M",$DD).' à '.strftime("%H h %M le %A %d %B %Y",$DF);
                                        
                                        echo '<H4>'.$uneAction['Description'].'</H4><BR>';

                                    }// >= 1
                                    
                                }// != null
                                else
                                {
                                    echo 'A partir du : '.strftime("%A %d %B %Y %H h %M",$DD).'<BR>';
                                    echo '<H4>'.$uneAction['Description'].'</H4><BR>';
                                }  // != null
                            

                            }// ==0
                            else
                            {
                                //Remplissage du tableau : 
                                    if($i== 1)
                                    {
                                        echo'<div class="table-responsive">';
                                        //$this->table->set_heading('Jour  ', 'Horraires ');
                                    }//== 1
                                    if($uneAction['DATEFIN']==null)
                                    {
                                        $uneAction['DATEFIN']=0;
                                    }

                                    $Action = '<a href="#action'.$i.'" style="color:FFFFFF">'.'<H4>'.$uneAction['TitreAction'].'</H4></a>';
                                    
                                    date_default_timezone_set('Europe/Paris');
                                    // --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
                                    setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK
                                    // strftime("jourEnLettres jour moisEnLettres annee") de la date courante
                                
                                    $DateDebut = date_create($uneAction['DATEDEBUT']);
                                    $DD = date_timestamp_get($DateDebut);

                                    if($uneAction['DATEFIN'] != null)
                                    {
                                        $DateFin = date_create($uneAction['DATEFIN']);
                                        $DF = date_timestamp_get($DateFin);
                                        //echo 'Test : '.(($DF-$DD)/60/60/24).'<BR><BR><BR>';
                                        if(($DF-$DD)/60/60/24 >= 1)
                                        {
                                            $Horaire = "Du :".strftime("%A %d %B %Y %H h %M",$DD).'<BR> Au : '.strftime("%A %d %B %Y %H h %M",$DF).'<BR>';   
                                        }
                                        else
                                        {
                                            $Horaire = "De : ".strftime("%Hh%M",$DD).' à '.strftime("%Hh%M",$DF);  
                                        } // >= 1
                                    } // != numm
                                    else
                                    {  
                                        $Horaire = 'A partir du : '.strftime("%A %d %B %Y %H h %M",$DD).'<BR>';
                                    } // != null
                                    
                                    $jourTest = strftime('%A',$DD);
                                    if($Jour == $jourTest)
                                    {
                                        //$Horaire = ' joli petit teste samère !';
                                        if (empty($Array))
                                        {
                                            $Array = array(strftime("%A %d %B %Y",$DD),$Action.$Horaire);
                                        }
                                        else
                                        {
                                            $temp = array($Action.$Horaire=>$Action.$Horaire);
                                            $Array = $Array + $temp;
                                        }
                                        
                                    }
                                    else
                                    {
                                        $this->table->add_row($Array);
                                        $Jour = $jourTest;
                                        $Array = array(strftime("%A %d %B %Y",$DD),$Action.$Horaire);                                   
                                    }
                                //Remplissage du tableau
                                
                                $entete = '
                                <div class="row" style="background-color:#15B7D1;padding:20px" id="action'.$i.'">
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class = "text-center">
                                            <section>
                                                <div class = "section-inner" style="background-color:#139CBC;padding:20px">';

                                        $pied = '</div>
                                            </section>
                                        </div>
                                    </div>
                                </div>';
                                
                                $AffichageAction = $AffichageAction.$entete.'<H1 style="color:FFFFFF">'.$uneAction['TitreAction'].'</H1>'.$Horaire.'<H4>'.$uneAction['Description'].'</H4>'.$pied;
                                
                            } // ==0
                            $i +=1;
 
                        }//EndForEach
                        if($i != 1)
                        {
                            $this->table->add_row($Array);
                            $Style = array('table_open' => '<table class="table" >');
                            $this->table->set_template($Style);
                            
                            echo $this->table->generate();
                            echo'</div>';
                        
                        }
                        
                        if (isset($Fichiers))
                        {
                            echo '<H1>Images</H1>';

                            foreach($Fichiers as $unFichier)
                            {
                                echo '<BR>'.img($unFichier['FICHIER']).'<BR>';
                            }

                        }
                        echo form_open('Acteur/SupprimerAction/'.$Actions[0]['NOACTION'].'',array("id"=>"form_suppr"));
                        
                        echo '<div class="text-left">';
                        echo'<a  href="'.site_url('Acteur/AccueilActeur/').'" style="color:#000000"><button type="button" class="btn btn-danger">Retour</button> </a>';
                        echo '</div>';
                        echo '<div class="text-right">';
                        echo'<a  href="'.site_url('Acteur/ReitererAction/'.$Actions[0]['NOACTION'].'').'" style="color:#000000"><span class="glyphicon glyphicon-repeat"></span>  </a>';
                        echo'<a  href="'.site_url('Acteur/ModifierAction/'.$Actions[0]['NOACTION'].'').'" style="color:#000000"><span class="glyphicon glyphicon-pencil"></span>  </a>';
                        echo'<a  id="trash_Supprimer" style="color:#000000"><span class="glyphicon glyphicon-trash" ></span>  </a>';
                        echo '</div>';
                        echo form_close();
                        
                    ?>
                </div>
            </section>
        </div>
    </div>
</div>
<?php 
 echo $AffichageAction;

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src=<?php echo('"'.js_url("js_supprimerAction").'"')?>></script>