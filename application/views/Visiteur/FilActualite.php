
<?php 
    $tailleDescription = 500;
?>

<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2" style="padding:20px">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <H1 style="color:#FFFFFF">Actualités</H1>
                    <div class="container-fluid">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">

                            <ol class='carousel-indicators'>
                            <?php
                                $j=0;
                                foreach($lesFavoris as $unFavoris)
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
                            ?>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">

                                <?php
                                $i=0;
                                if(!empty($lesFavoris))
                                {
                                    foreach($lesFavoris as $unFavoris)
                                    {
                                        $class="item";
                                        
                                        date_default_timezone_set('Europe/Paris');
                                        // --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
                                        //setlocale(LC_TIME, 'fr_FR.UTF8','fra');// OK
                                        setlocale (LC_TIME, 'fr_FR.UTF-8','fra');
                                        // strftime("jourEnLettres jour moisEnLettres annee") de la date courante
                                    
                                        $DateDebut = date_create($unFavoris['DATEDEBUT']);
                                        $DD = date_timestamp_get($DateDebut);
        
                                        if($unFavoris['DATEFIN'] != null)
                                        {
                                            $DateFin = date_create($unFavoris['DATEFIN']);
                                            $DF = date_timestamp_get($DateFin);
                                            //echo 'Test : '.(($DF-$DD)/60/60/24).'<BR><BR><BR>';
                                            if(($DF-$DD)/60/60/24 >= 1)
                                            {
                                                $Horaire = "Du : ".strftime("%A %d %B %Y %H h %M",$DD).'<BR> Au : '.strftime("%A %d %B %Y %H h %M",$DF).'<BR>';   
                                            }
                                            else
                                            {
                                                $Horaire = "De : ".strftime("%Hh%M",$DD).' à '.strftime("%Hh%M",$DF).'<BR><BR>';  
                                            } // >= 1
                                        } // != numm
                                        else
                                        {  
                                            $Horaire = 'A partir du : '.strftime("%A %d %B %Y %H h %M",$DD).'<BR><BR>';
                                        } // != null

                                        if($i == 0)
                                        {
                                            $class = "item active";
                                        }


                                        if(strlen($unFavoris['Description'])>$tailleDescription)
                                        {
                                            $Description = substr($unFavoris['Description'],0,$tailleDescription).' [...]';
                                        }
                                        else
                                        {
                                            $Description = $unFavoris['Description'];
                                        }

                                                echo '<div class="'.$class.'">';
                                                    echo '<h1>'.$unFavoris['NOMACTION'].'</H1>';
                                                    echo '<H4><em>'.$Horaire.'</em></H4>';
                                                    echo'<br>';
                                                    echo '<div class="row">';
                                                        echo '<div class="col-sm-2">';
                                                        echo '</div>';
                                                        echo '<div class="col-sm-8">';
                                                            echo '<h4 class="center">'.$Description.'</H4>';
                                                        echo '</div>';
                                                        echo '</br>';
                                                        echo '</br></br>';
                                                        echo'';
                                                    echo '</div>';
                                                    echo '</br>';
                                                    echo '<a href="'.site_url('Visiteur/AjouterCommentaire/'.$unFavoris['NOACTION']).'" class="btn btn-danger">En savoir plus</a>';
                                                    echo '</br></br>';
                                                    echo '</br></br>';
                                                    echo '</br></br>';
                                                    echo'';
                                                echo '</div>';
                                        $i++;
                                    }
                                }  
                                ?>

                            </div>
                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
            </section>
            <BR>
        </div>
    </div>
</div>