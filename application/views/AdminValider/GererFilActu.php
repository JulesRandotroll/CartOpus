                    <ul class="nav navbar-nav navbar-right">
                        <?php 
                            if($this->session->statut == 4) 
                            {
                        ?>
                            <li>
                                <a href="<?php echo site_url('AdminValider/AccueilAdminValider'); ?>" style="color:#FFFFFF" >
                                    <span class='glyphicon glyphicon-home'></span> 
                                    Accueil Admin
                                </a>
                            </li>  
                            <li>
                                <a href="<?php echo site_url('Visiteur/SeDeconnecter'); ?>" style="color:#FFFFFF">
                                    <span class="glyphicon glyphicon-log-out"></span> 
                                    Se Déconnecter
                                </a>
                            </li>
                        <?php
                            }
                            elseif($this->session->statut == 5)
                            {
                                echo'<li><a href="'.site_url('SuperAdmin/AccueilSuperAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> Page Perso</a></li>';
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<?php 
    $tailleDescription = 250;
?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="<?php echo js_url('js_GererFilActu'); ?>"></script>



<div class="row" style="background-color:#15B7D1" id='modif'> 
    <div class="col-sm-2">
    </div> 
    <div class="col-sm-8">
        <H1 align = "center" style="color:#FFFFFF">Gestion des favoris</H1><BR>
        <section >
            <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                <div class='row'>
                    <div class='col-sm-4'>
                        <div class='form-group'>
                            <label> Rechercher : </label>
                            <input class="form-control" id="myInput" type="text" placeholder="Rechercher..">
                        </div>
                    </div>
                    <div class="col-sm-5">
                    </div>
                    <div class="col-sm-3">
                        <H4 class='text-right'><a href="#filActu" id="affichActu" style="color:#FFFFFF">Afficher le contenu</a></H4>
                    </div>
                </div>
                <table class="table table-responsive" id="myTable">
                    <tr>
                        <th> Nom </th>
                        <th> Date Debut </th>
                        <th> Description </th>
                        <th> Favori </th>
                    </tr>
                    <?php 
                        
                        if(!empty($lesActions))
                        {
                            foreach ($lesActions as $uneAction) 
                            {
                                echo 
                                    '<tr>
                                        <td>'.$uneAction['NOMACTION'].'</td>
                                        <td>'.$uneAction['DATEDEBUT'].'</td>';
                                     
                                if(strlen($uneAction['Description'])>$tailleDescription)
                                {
                                    echo '<td>'.(substr($uneAction['Description'],0,$tailleDescription)).' [...] </td>';
                                }
                                else
                                {
                                    echo'<td>'.$uneAction['Description'].'</td>';
                                }
                                
                                echo'
                                <td>'.form_checkbox($uneAction['NOACTION'], $uneAction['NOACTION'], $uneAction['Favoris'],array('class'=>'cbx star')).'</td>
                                <tr>';
                            }
                        }
                        
                        echo form_open('AdminValider/ChangerFavoris',array('id'=>'form_favoris'));
                        echo form_close();
                    ?>
                </table>
            </div>
            
        </section>
        <BR>
    </div>
    <div class='col-sm-2'>
    </div>
    <br>
</div>


<div class="row" style="background-color:#15B7D1" id="filActu">
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
                    <div class="text-right">
                        <H4><a href="#modif" id="enHaut" style="color:#FFFFFF"><span class="glyphicon glyphicon-arrow-up" style="color:#FFFFFF"></span>Retour en Haut</a></H4>
                    </div>
                </div>   
            </section>
            <BR>
        </div>
    </div>
</div>


<style>
    .star {
        visibility:hidden;
        font-size:30px;
        cursor:pointer;
    }
    .star:before {
    content: "\2606";
    position: absolute;
    visibility:visible;
    color: #FFC107;
    }
    .star:checked:before {
    content: "\2605";
    position: absolute;
    color: #FFC107;
    }
</style>