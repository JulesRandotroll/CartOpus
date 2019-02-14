<ul class="nav navbar-nav navbar-right">
<?php
                            if($this->session->statut ==5)
                            {
                                echo'<li><a href="#" style="color:#FFFFFF"><span class="glyphicon glyphicon-remove"></span> Invalider l\'action</a></li>';
                                echo '<li><a href="'.site_url('SuperAdmin/AjouterThematique').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajouter Thématique</a></li>';
                                echo '<li><a href="'.site_url('SuperAdmin/AffecterProfil/0').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> Affecter un profil à un Utilisateur</a></li>';
                                echo'<li><a href="'.site_url('SuperAdmin/AccueilSuperAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>';
                                echo '<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                            }
                            elseif($this->session->statut==4)
                            {
                                echo'<li><a href="'.site_url('AdminValider/InvaliderActionDepuisAction/'.$Actions[0]['NOACTION']).'" style="color:#FFFFFF"><span class="glyphicon glyphicon-remove"></span> Invalider l\'action</a></li>';
                                echo'<li><a href="'.site_url('AdminValider/AccueilAdminValider').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>'; 
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</a></li>'; 
                            }
                            elseif($this->session->statut==1)
                            {
                                echo'<ul class="nav navbar-nav">';
                                echo '<li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFFFFF ;background-color:#0E7896">Action
                                    <span class="caret"></span></a>
                                    <ul class="dropdown-menu" style="background-color:#139CBC">
                                        <li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>
                                        <li><a href="'.site_url('Acteur/ReitererAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-repeat"></span> Réitérer Action</a></li>
                                        <li><a href="'.site_url('Acteur/ModifierAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-pencil"></span> Modifier Action</a></li>
                                    </ul>
                                </li>';
                               // echo'<li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Creation Action</a></li>';
                                echo'<li><a href="'.site_url('Acteur/GestionProfil').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-cog"></span> Compte</a></li>';
                                echo'</ul>';
                                echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>'; 
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</a></li>'; 
                            }
                            else
                            {   
                                echo'<li><a href="'.site_url('Visiteur/SInscrire').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                                echo'<li><a href="'.site_url('Visiteur/SeConnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>';
                            }
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
    </div>
    <?php

        echo '<div class="col-xs-8">';
            echo '<div class = "text-center">';
                echo '<section>';
                    echo '<div class = "section-inner" style="background-color:#139CBC;padding:20px">';
                    

                            $i = 0;
                            $AffichageAction="";
                            //var_dump($Actions);
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
                            
                            
                            echo '<div class="text-left">';
                            echo'<a  href="'.site_url('Visiteur/loadAccueil').'" style="color:#000000"><button type="button" class="btn btn-danger">Retour</button> </a>';
                            echo '</div>';
                            echo '<div class="text-right">';
                            echo'<button class="text-right btn btn-danger" href="#signalement" style="color:#000000" id="signalerAction">Signaler l\'action</button>';
                            echo '</div>';

                    echo '</div>';
                echo '</section>';
            echo '</div>';
        echo '</div>';
      
    ?>
    <div class="col-lg-2">
        <section>
            <div class = "section-inner" style="background-color:#139CBC;padding:20px">

                <h4 style="text-decoration: underline;">Les Partenaires : </h4><BR>

                <?php
                    if(isset($lesPartenaires))
                    {
                        if(!empty($lesPartenaires))
                        {
                            foreach($lesPartenaires as $unPartenaire)
                            {
                                echo '<a href="'.site_url('Visiteur/AfficherActeurAction/'.($unPartenaire['NOACTEUR'])).'" style="color:#000000"><h5>'.$unPartenaire['NOMACTEUR'].' '.$unPartenaire['PRENOMACTEUR'].'</h5></a>';
                            }
                        }
                    }

                ?>
            </div>
        </section>
    </div>
</div>
<?php
    $i=0;
    $j=0;
    if(!empty($Fichiers))
    {
        echo '<div class="row" style="background-color:#15B7D1">
        <div class="col-sm-2" style="padding:20px">
        </div>
        <div class="col-sm-8" style="padding:20px">
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
                                <div class="carousel-inner">';
                                
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

                                        echo '<div class="row">';
                                            echo '<div class="col-sm-2">';
                                            echo '</div>';
                                            echo '<div class="col-sm-8">';
                                                echo img($unFichier['FICHIER']);
                                                echo '</br></br>';
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
// var_dump($Options);
    echo '<div class="row signaler"  id="signalement" style="background-color:#15B7D1;padding:20px" id="action">';
        echo '<div class="col-lg-2"></div>';
        echo '<div class="col-xs-8">';
            echo '<div class = "text-center">';
                echo '<section>';
                    echo '<div class = "section-inner" style="background-color:#139CBC;padding:20px">';
                        echo '<div class="form-group">';
                        echo form_open('Visiteur/AjouterSignalements/'.$Actions[0]['NOACTION']); 

                            echo form_label('Formulaire de Signalements ', 'Signalements');
                            echo form_dropdown('Signalements', $Options,'' ,Array('class'=>'form-control',"id"=>"dropSignalements",'required'));
                            echo '</br>';
                            echo form_textarea('Commentaire', '' ,Array("placeholder"=>"Avis sur le signalement...","class"=>"form-control"));
                        echo '</div>';
                            echo form_submit('Signaler', 'Signaler',array('class'=>'btn btn-danger'));
                            echo form_input('Annuler', 'Annuler',array('class'=>'btn btn-danger', 'id'=>'annuler'));
                        echo form_close();
                    echo '</div>';
                echo '</section>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
?>

<?php 
    /// affiche les sous actions
    echo $AffichageAction;
?>

<?php
if(!empty($lesVisiteurs))
{
    echo '<div class="row" style="background-color:#15B7D1;padding:20px" id="action">';
        echo '<div class="col-lg-1">';
        echo '</div>';
        echo '<div class="col-xs-10">';
            echo '<div class = "text-left">';
                echo '<section>';
                    echo '<div class = "section-inner" style="background-color:#139CBC;padding:20px">';
                        if(isset($lesVisiteurs))
                        {
                            //var_dump($lesVisiteurs);
                            echo '';
                            
                            foreach($lesVisiteurs as $unVisiteur):

                                if($unVisiteur['profil'] == 0)
                                {
                                    echo '<div class="media">';
                                        echo '<div class="media-left media-top">';
                                        echo '</div>';
                                        echo '<div class="col-sm-8">';
                                            echo '<div class="media-body" style="background-color:lightblue; border-radius: 5px;padding:10px">';
                                                echo '<table align="left">';
                                                    echo '<tr><td>';
                                                        echo '<div align="center">'.(img($unVisiteur['PhotoProfil'])).'<BR><BR>';
                                                        echo '<h4 class="media-heading" id ="nom'.$unVisiteur['noCommentaire'].'">'.$unVisiteur['nom'].'</h4>';
                                                        echo '<h5 class="media-heading" style="font-style: italic;color:#000000"><strong>( Visiteur )</strong></h5></div>';
                                                    echo '</td><td>';
                                                        echo '<span style="padding:15px" id="commentaire'.$unVisiteur['noCommentaire'].'">'.$unVisiteur['commentaire'].'</span><BR>';
                                                    echo '</td></tr>';
                                                echo '</table>';
                                                echo '<div class = "text-right" style="font-style:italic;" id="date'.$unVisiteur['noCommentaire'].'">'.$unVisiteur['dateheure'].'</div>';
                                                echo '<BR><BR><BR><BR><BR>';
                                            echo '<div class = "text-right"><a href="#signalementComm" class="btn btn-link SignalerComm" id ="'.$unVisiteur['noCommentaire'].'">Signaler</a></div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                                else if($unVisiteur['profil'] == 1)
                                {
                                    echo '<div class="media">';
                                        echo '<div class="media-left media-top">';
                                        echo '</div>';
                                        echo '<div class="col-sm-8">';
                                            echo '<div class="media-body" style="background-color:#ff6666;border-radius:10px;padding:10px">';
                                                echo '<table align="left">';
                                                    echo '<tr><td>';
                                                        echo '<div align="center">'.(img($unVisiteur['PhotoProfil'])).'<BR><BR>';
                                                        echo '<h4 class="media-heading" id ="nom'.$unVisiteur['noCommentaire'].'">'.$unVisiteur['nom'].' '.$unVisiteur['prenom'].'</h4>';
                                                        echo '<h5 class="media-heading" style="font-style: italic;color:#000000"><strong>( Acteur )</strong></h5></div>';
                                                    echo '</td><td>';
                                                        echo '<span style="padding:15px" id="commentaire'.$unVisiteur['noCommentaire'].'">'.$unVisiteur['commentaire'].'</span><BR>';
                                                    echo '</td></tr>';
                                                echo '</table>';
                                                echo '<div class = "text-right" style="font-style:italic;" id="date'.$unVisiteur['noCommentaire'].'">'.$unVisiteur['dateheure'].'</div>';
                                                echo '<BR><BR><BR><BR><BR>';
                                            echo '<div class="text-right"><a href="#signalementComm" class="btn btn-link SignalerComm" id ="'.$unVisiteur['noCommentaire'].'">Signaler</a></div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                    $i++;
                                }
                                else if($unVisiteur['profil'] == 2)
                                {
                                    echo '<div class="media">';
                                        echo '<div class="media-right media-top">';
                                        echo '</div>';
                                        echo '<div class="col-lg-4">';
                                        echo '</div>';
                                        echo '<div class="col-sm-8">';
                                            echo '<div class="media-body text-right" style="background-color:#ff9999; border-radius: 5px;padding:10px">';
                                                echo '<table align="right">';
                                                    echo '<tr><td>';
                                                        echo '<div style="padding:15px" id="commentaire'.$unVisiteur['noCommentaire'].'">'.$unVisiteur['commentaire'].'</div>';
                                                    echo '</td><td>';
                                                        echo '<div align="center">'.(img($unVisiteur['PhotoProfil'])).'<BR><BR>';
                                                        echo '<h4 class="media-heading" id ="nom'.$unVisiteur['noCommentaire'].'">'.$unVisiteur['nom'].' '.$unVisiteur['prenom'].'</h4>';
                                                        echo '<h5 class="media-heading" style="font-style: italic;color:#000000"><strong>( Membre de l\'action )</strong></h5></div>';                                            
                                                    echo '</td></tr>';
                                                echo '</table>';
                                                echo '<div class = "text-left" style="font-style:italic;" id="date'.$unVisiteur['noCommentaire'].'">'.$unVisiteur['dateheure'].'</div>';
                                                echo '<BR><BR><BR><BR><BR>';
                                            echo '<div class = "text-left"><a href="#signalementComm" class="btn btn-link SignalerComm" id ="'.$unVisiteur['noCommentaire'].'">Signaler</a></div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                    $i++;
                                }
                                else if($unVisiteur['profil'] == 4)
                                {
                                    echo '<div class="media">';
                                        echo '<div class="media-right media-top">';
                                        echo '</div>';
                                        echo '<div class="col-lg-4">';
                                        echo '</div>';
                                        echo '<div class="col-sm-8">';
                                        //#e6e6e6 : gris clair
                                            echo '<div class="media-body text-right" style="background-color:#80ff80; border-radius: 5px;padding:10px">';
                                                echo '<table align="right">';
                                                    echo '<tr><td>';
                                                        echo '<div style="padding:15px">'.$unVisiteur['commentaire'].'</div>';
                                                    echo '</td><td>';
                                                        echo '<div align="center">'.(img($unVisiteur['PhotoProfil'])).'<BR><BR>';
                                                        echo '<h4 class="media-heading">'.$unVisiteur['nom'].' '.$unVisiteur['prenom'].'</h4>';
                                                        echo '<h5 class="media-heading" style="font-style: italic;color:#cc0000"><strong>( Modérateur )</strong></h5></div>';                                            
                                                    echo '</td></tr>';
                                                echo '</table>';
                                                echo '<div class = "text-left" style="font-style:italic;">'.$unVisiteur['dateheure'].'</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                                
                            endforeach;
                        }
                            
                    echo '</div>';
                echo '</section>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
}


if($this->session->statut != 0 && $this->session->statut !=5)
{
    echo '<div class="row" style="background-color:#15B7D1;padding:20px" id="action">';
        echo '<div class="col-lg-1"></div>';
        echo '<div class="col-xs-10">';
            echo '<div class = "text-center">';
                echo '<section>';
                    echo '<div class = "section-inner" style="background-color:#139CBC;padding:20px">';
                        echo '<div class="form-group">';
                        echo form_open('Acteur/AjouterCommentaire/'.$Actions[0]['NOACTION']); 
                            echo form_label('Commentaire ', 'Desc');
                            echo form_textarea('Commentaire', '' ,Array("placeholder"=>"Commentez...","class"=>"form-control"));
                        echo '</div>';
                        echo '<div class="text-center">';
                            echo form_submit('Commenter', 'Commenter',array('class'=>'btn btn-danger'));
                            echo '</div>';
                        echo form_close();
                    echo '</div>';
                echo '</section>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

}
else if($this->session->noVisiteur!=null)
{
    echo '<div class="row" style="background-color:#15B7D1;padding:20px" id="action">';
        echo '<div class="col-lg-1"></div>';
        echo '<div class="col-xs-10">';
            echo '<div class = "text-center">';
                echo '<section>';
                    echo '<div class = "section-inner" style="background-color:#139CBC;padding:20px">';
                        echo '<div class="form-group">';
                        echo form_open('Visiteur/AjouterCommentaire/'.$Actions[0]['NOACTION']); 
                            echo form_label('Commentaire ', 'Desc');
                            echo form_textarea('Commentaire', '' ,Array("placeholder"=>"Commentez...","class"=>"form-control"));
                        echo '</div>';
                        echo '<div class="text-center">';
                            echo form_submit('Commenter', 'Commenter',array('class'=>'btn btn-danger'));
                            echo '</div>';
                        echo form_close();
                    echo '</div>';
                echo '</section>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
}

?>

<?php
echo '<div class="row SignalerCommentaire"  id="signalementComm" style="background-color:#15B7D1;padding:20px" id="action">';
    echo '<div class="col-lg-2"></div>';
    echo '<div class="col-xs-8">';
        echo '<div class = "text-center">';
            echo '<section>';
                echo '<div class = "section-inner" style="background-color:#139CBC;padding:20px">';
                    echo '<div class="form-group">';
                    echo form_open('Visiteur/AjouterSignalementsComm/'.$Actions[0]['NOACTION'],array('id'=>'form_signalComm')); 

                        echo form_label('Formulaire de Signalements ', 'Signalements');
                        echo '<div id="commASignaler"></div>';
                        echo form_dropdown('SignalementsComm', $Options,'' ,Array('class'=>'form-control',"id"=>"dropSignalements",'required'));
                        echo '</br>';
                        echo form_textarea('CommentaireComm', '' ,Array("placeholder"=>"Avis sur le signalement...","class"=>"form-control"));
                    echo '</div>';
                        echo form_submit('SignalerComm', 'Signaler',array('class'=>'btn btn-danger'));
                        echo form_input('Annuler', 'Annuler',array('class'=>'btn btn-danger', 'id'=>'annulerComm'));
                    echo form_close();
                echo '</div>';
            echo '</section>';
        echo '</div>';
    echo '</div>';
echo '</div>';
?>



