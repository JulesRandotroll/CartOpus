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
                                        
                                        if($i == 0)
                                        {
                                            $class = "item active";
                                            //echo $class;
                                        }
                                                echo '<div class="'.$class.'">';
                                                    echo '<h1>'.$unFavoris['NOMACTION'].'</H1>';
                                                    echo '<h5>'.$unFavoris['DATEDEBUT'].'</H5>';
                                                    echo '<h5>'.$unFavoris['DATEFIN'].'</H5>';
                                                    echo'<br>';
                                                    echo '<div class="row">';
                                                        echo '<div class="col-sm-2">';
                                                        echo '</div>';
                                                        echo '<div class="col-sm-8">';
                                                            echo '<h5 class="center">'.$unFavoris['Description'].'</H5>';
                                                        echo '</div>';
                                                        echo '</br>';
                                                        echo '</br></br>';
                                                        echo'';
                                                    echo '</div>';
                                                    echo '</br>';
                                                    echo '<a href="'.site_url('Visiteur/AfficherAction/'.$unFavoris['NOACTION']).'" class="btn btn-danger">En savoir plus</a>';
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