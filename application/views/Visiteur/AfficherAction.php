<ul class="nav navbar-nav navbar-right">
                    <?php 
                        echo '<li><a href="'.site_url('Visiteur/SInscrire').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                        echo'<li><a href="'.site_url('Visiteur/SeConnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-in"></span> Se Connecter</a></li>';
                    ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="<?php echo js_url('js_AfficherAction'); ?>"></script>

<div class="row" style="background-color:#15B7D1;padding:20px" id="action">
    <div class="col-lg-2">
    </div>
    <div class="col-xs-8">
        <div class = "text-center">
            <section>
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php

                        $i = 0;
                        $AffichageAction="";
                        //var_dump($Action);
                        foreach($Actions as $uneAction)
                        {   
                            $Description = str_replace("\n",'<BR>', $uneAction['Description']);
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
                                        echo '<H4>'.$Description.'</H4><BR>';
                                    }
                                    else
                                    {
                                        echo "De : ".strftime("%H h %M",$DD).' à '.strftime("%H h %M le %A %d %B %Y",$DF);
                                        
                                        echo '<H4>'.$Description.'</H4><BR>';

                                    }// >= 1
                                    
                                }// != null
                                else
                                {
                                    echo 'A partir du : '.strftime("%A %d %B %Y %H h %M",$DD).'<BR>';
                                    echo '<H4>'.$Description.'</H4><BR>';
                                }  // != null
                            

                            }// ==0
                            else
                            {
                                if($i== 1)
                                {
                                    echo'<div class="table-responsive">';
                                    //$this->table->set_heading('Jour  ', 'Horraires ');
                                }//== 1
                                if($uneAction['DATEFIN']==null)
                                {
                                    $uneAction['DATEFIN']=0;
                                }

                                $Action = '<a href="#action'.$i.'" style="color:FFFFFF" class="lienSousAction">'.'<H4>'.$uneAction['TitreAction'].'</H4></a>';
                                
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
                                    if(!empty($Array))
                                    {
                                        $this->table->add_row($Array);
                                    }
                                    $Jour = $jourTest;
                                    $Array = array(strftime("%A %d %B %Y",$DD),$Action.$Horaire);                                   
                                }

                            
                                $entete = '
                                <div class="row sousAction" style="background-color:#15B7D1;padding:20px" id="action'.$i.'">
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class = "text-center">
                                            <section>
                                                <div class = "section-inner" style="background-color:#139CBC;padding:20px">';

                                        $pied = '</div>
                                            </section>
                                        </div>
                                    </div>
                                </div>';
                                
                                $AffichageAction = $AffichageAction.
                                    $entete.'<H1 style="color:FFFFFF">'.
                                        $uneAction['TitreAction'].'</H1>'.
                                        $Horaire.
                                        '<H4>'.$Description.'</H4>'.
                                        '<div class="text-right"><a href="#action" style="color:FFFFFF" class="HautPage">Haut de page</a></div>'.
                                    $pied
                                ;
                                
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
                        
                        echo '<div class="text-left">';
                        echo'<a  href="'.site_url('Visiteur/loadAccueil').'" style="color:#000000"><button type="button" class="btn btn-danger">Retour</button> </a>';
                        echo '</div>';

                    ?>
                </div>
            </section>
        </div>
    </div>
</div>

<?php 
    echo $AffichageAction;
?>