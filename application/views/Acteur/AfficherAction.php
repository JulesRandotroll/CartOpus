                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        //var_dump($this->session->statut);
                        if (($this->session->statut)==3)
                        {
                            echo '<li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFFFFF ;background-color:#0E7896">Action
                                    <span class="caret"></span></a>
                                    <ul class="dropdown-menu" style="background-color:#139CBC">
                                        <li><a href="'.site_url('Acteur/ModifierAction/'.$Actions[0]['NOACTION']).'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-pencil"></span> Modifier Action</a></li>
                                        <li><a href="'.site_url('Acteur/AjoutSousAction/'.$Actions[0]['NOACTION']).'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter SousAction</a></li>
                                        <li><a href="'.site_url('Acteur/ReitererAction/'.$Actions[0]['NOACTION']).'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-repeat"></span> Renouveler Action</a></li>
                                        <li><a href="'.site_url('Acteur/SupprimerAction/'.$Actions[0]['NOACTION']).'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-trash"></span> Supprimer Action</a></li>
                                    </ul>
                                </li>';
                            echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
                            echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        }
                        else
                        {
                            echo '<li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFFFFF ;background-color:#0E7896">Action
                                    <span class="caret"></span></a>
                                    <ul class="dropdown-menu" style="background-color:#139CBC">
                                        <li><a href="'.site_url('Acteur/ModifierAction/'.$Actions[0]['NOACTION']).'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-pencil"></span> Modifier Action</a></li>
                                        <li><a href="'.site_url('Acteur/AjoutSousAction/'.$Actions[0]['NOACTION']).'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter SousAction</a></li>
                                        <li><a href="'.site_url('Acteur/ReitererAction/'.$Actions[0]['NOACTION']).'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-repeat"></span> Renouveler Action</a></li>
                                    </ul>
                            </li>';
                            echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
                            echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        }
                         

                        //var_dump($Actions[0]['NOACTION']);
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
    <section>
            <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                <h4 style="text-decoration: underline;">Les Mots Clés : </h4><BR>
                <?php
                    if(!empty($lesMotCles))
                    {
                        if(isset($lesMotCles))
                        {
                            foreach($lesMotCles as $unMotCle)
                            {
                                    echo '<h5>'.$unMotCle['MotCle'].'</h5>';
                            }
                        }
                    }

                ?>
            </div>
        </section>
        <BR>
        <section>
            <div class = "section-inner" style="background-color:#139CBC;padding:20px">

                <h4 style="text-decoration: underline;">Les Partenaires : </h4><BR>

                <?php
                    if(!empty($lesPartenaires))
                    {
                        if(isset($lesPartenaires))
                        {
                            foreach($lesPartenaires as $unPartenaire)
                            {
                                echo '<a href="'.site_url('Visiteur/AfficherActeurAction/'.($unPartenaire['NOACTEUR'])).'" style="color:#000000"><h5>'.$unPartenaire['NOMACTEUR'].' '.$unPartenaire['PRENOMACTEUR'].'</h5>';
                            }
                        }
                    }

                ?>
            </div>
        </section>
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

                            
                                //var_dump($uneAction);
        
                               //form_open('Acteur/SupprimerSousAction/'.$uneAction['NOACTION'])
                                $entete =
                                '<div class="row sousAction" style="background-color:#15B7D1;padding:20px" id="action'.$i.'">
                                    '.form_open('Acteur/SupprimerSousAction/'.$uneAction['NOACTION'].'/'.$uneAction['TitreAction'].'/'.$uneAction['DATEDEBUT'].'/'.$uneAction['NOLIEU'],array("id"=>"form_supprSousAction".$i)). '
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class = "text-center">
                                            <section>
                                                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                                                    <div class="text-right">
                                                        <a  href="'.site_url('Acteur/ModifierSousAction/'.$uneAction['NOACTION'].'/'.$uneAction['TitreAction'].'/'.$uneAction['DATEDEBUT'].'/'.$uneAction['NOLIEU']).'" style="color:#FFFFFF"><span class="glyphicon glyphicon-pencil"></span>  </a>
                                                        <a id="'.$i.'" href="#action'.$i.'" class="trash_SupprimerSousAction" style="color:#FFFFFF"><span class="glyphicon glyphicon-trash" ></span>  </a>
                                                    </div>';
                                        $pied = '</div>
                                            </section>
                                        </div>
                                    </div>
                                </div>'.
                                form_close();
                                
                                
                                $AffichageAction = $AffichageAction.
                                    $entete.'<H1 style="color:FFFFFF">'.
                                        $uneAction['TitreAction'].'</H1>'.
                                        $Horaire.
                                        '<H4>'.$Description.'</H4>'.
                                        '<div class="text-right">
                                            <a href="#action" style="color:FFFFFF" class="HautPage">Haut de page</a>
                                        </div>'.
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

                        echo form_open('Acteur/SupprimerAction/'.$Actions[0]['NOACTION'].'',array("id"=>"form_suppr"));
                        
                        echo '<div class="text-left">';
                        echo'<a  href="'.site_url('Acteur/AfficherMembre/'.$Actions[0]['NOACTION']).'" style="color:#000000"><button type="button" class="btn btn-danger">Afficher Membre</button> </a>';
                        echo'<a  href="'.site_url('Acteur/AccueilActeur/').'" style="color:#000000"><button type="button" class="btn btn-danger">Retour</button> </a>';
                        echo '</div>';
                       
                        echo form_close();
                        
                    ?>
                </div>
            </section>
        </div>
    </div>
    <div class='col-xs-2'>
        <nav class="navbar" data-spy="affix">
            <ul class="nav nav-pills nav-stacked" style="background-color:#B64F53;border-radius:10px;">
                <li>
                    <a href="<?php echo site_url('Acteur/ModifierAction/'.$Actions[0]['NOACTION']); ?>" class="option" id='Modifier'>
                        <H4>
                            <span class="glyphicon glyphicon-pencil" style="color:#FFFFFF" >
                            </span>
                            <p id='txt_Modifier' style="color:#FFFFFF">Modifier</p>
                        </H4>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Acteur/AjoutPhotoAction/'.$Actions[0]['NOACTION']); ?>" class="option" id='Photo'>
                        <H4>
                            <span class="glyphicon glyphicon-camera" style="color:#FFFFFF" >
                            </span>
                            <p id='txt_Photo' style="color:#FFFFFF">Ajouter Photo</p>
                        </H4>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Acteur/AjoutSousAction/'.$Actions[0]['NOACTION']); ?>" class="option" id='AjouterSousAction'>
                        <H4>
                            <span class="glyphicon glyphicon-plus-sign" style="color:#FFFFFF">
                            </span>
                            <p id='txt_AjouterSousAction' style="color:#FFFFFF">Ajouter sous-action</p>
                        </H4>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Acteur/RenouvelerAction/'.$Actions[0]['NOACTION']); ?>" class="option" id='Renouveler'>
                        <H4>
                            <span class="glyphicon glyphicon-repeat" style="color:#FFFFFF">
                            </span>
                            <p id='txt_Renouveler' style="color:#FFFFFF">Renouveler</p>
                        </H4>
                    </a>
                </li>
                <?php 
                    if($this->session->statut==3)
                    {
                        echo'<li>
                        <a href="#section3" class="option trash_Supprimer" id="Supprimer">
                            <H4>
                                <span class="glyphicon glyphicon-trash" style="color:#FFFFFF">
                                </span>
                                <p id="txt_Supprimer" style="color:#FFFFFF">Supprimer</p>
                            </H4>
                        </a>
                    </li>';
                    }
                ?>
                
            </ul>
        </nav>
    </div>
</div>

<?php
    $i=0;
    $j=0;
    if(!empty($Fichiers))
    {
        echo '<div class="row" style="background-color:#15B7D1">
        <div class="col-sm-3" style="padding:20px">
        </div>
        <div class="col-sm-6" style="padding:20px">
            <div class = "text-center">
                <section >
                    <div class = "section-inner" style="background-color:#139CBC;padding:20px">
            
                        <div class="container-fluid">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">';
                                
                                if(isset($Fichiers))
                                {
                                    echo '';
                                    foreach($Fichiers As $unFichier)
                                    {                                            
                                        if($j == 0)
                                        {
                                            echo '<li data-target="#myCarousel" data-slide-to="'.$j.'" class="active"></li>';
                                        }
                                        else
                                        {
                                            echo '<li data-target="#myCarousel" data-slide-to="'.$j.'"></li>';
                                        }
                                        $j++;

                                    }
                                }
                              
                                echo '</ol>
                                <!-- Wrapper for slides -->
                                <?php //var_dump($Fichiers); ?>
                                <div class="carousel-inner" id="imgs">';
                                
                                if (isset($Fichiers))
                                {
                                    foreach($Fichiers As $unFichier)
                                    {
                                        $class="item";

                                        if($i == 0)
                                        {
                                            $class = "item active";
                                            //echo $class;
                                        }
                                        echo '<div class="'.$class.'">';

                                        echo form_open('Acteur/SupprimerPhoto/'.$Actions[0]['NOACTION'].'',array("id"=>"form_SupprPhoto"));
                                        echo form_close();

                                        echo '<div class="row">';
                                            echo '<div class="col-sm-3">';
                                            echo '</div>';
                                            echo '<div class="col-sm-6">';
                                            echo '</br></br>';
                                                echo img($unFichier['FICHIER']);
                                                echo '</br></br>';
                                                //echo form_input('suppr', 'Supprimer', array("class"=>"suppr_Photo","id"=>$unFichier["FICHIER"]));
                                                
                                                echo '<a id='.$unFichier['FICHIER'].' class="btn btn-danger suppr_Photo">Supprimer</a>';//href="#imgs"
                                                echo '</br></br>';
                                                echo '</br></br>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo'</div>';
                                       
                                       
                                       
                                        $i++;
                                    }           

                                    echo '<a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                    </a>';

                                }

                            echo '</div>
                            
                        </div>
                    </div>
                </section>';
            }
            ?>
        </div>
    </div>
</div>

<?php 
    echo $AffichageAction; 
?>

