                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            echo'<li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>';
                            echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';
                            echo'<li><a href="'.site_url('Acteur/ContacterAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-send"></span> Contacter Nous</a></li>';
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
                        foreach($Actions as $uneAction)
                        {   
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
                                if($i== 1)
                                {
                                    echo'<div class="table-responsive">';
                                    //$this->table->set_heading('Jour  ', 'Horraires ');
                                }//== 1
                                if($uneAction['DATEFIN']==null){$uneAction['DATEFIN']=0;}
                                $Action = '<a href="'.site_url('Acteur/AfficherActionSelectionnee/'.($uneAction['NOACTION']).'/'.($uneAction['DATEDEBUT']).'/'.($uneAction['DATEFIN'])).'" style="color:FFFFFF">'.'<H4>'.$uneAction['TitreAction'].'</H4></a>';

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
                                       
                                        $Horaire = "De : ".strftime("%H h %M",$DD).' à '.strftime("%H h %M",$DF);
                                       
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
                                    $Jour = $jourTest;
                                    $this->table->add_row($Array);
                                    $Array = array(strftime("%A %d %B %Y",$DD),$Action.$Horaire);

                                }






                                
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
                                
                                //var_dump($Fichiers);
                        }
                        echo '<div class="text-right">';
                        echo'<a  href="'.site_url('Acteur/ReitererAction/'.$Actions[0]['NOACTION'].'').'" style="color:#000000"><span class="glyphicon glyphicon-repeat"></span>  </a>';
                        echo'<a  href="'.site_url('Acteur/ModifierAction/'.$Actions[0]['NOACTION'].'').'" style="color:#000000"><span class="glyphicon glyphicon-pencil"></span>  </a>';
                        echo '</div>';
                    ?>
                </div>
            </section>
        </div>
    </div>
</div>
