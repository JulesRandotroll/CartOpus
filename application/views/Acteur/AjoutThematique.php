                    <ul class="nav navbar-nav navbar-right">
                            <?php 
                                echo'<li><a href="'.site_url('Acteur/ChoixAction/1').'" style="color:#FFFFFF"><span class="glyphicon list-alt"></span> Afficher Action</a></li>';
                                echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                            ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
            <div class = "text-center">
                <?php
                    echo '<H1 style="color:#FFFFFF">Liée une thématique à une action</H1>';
                ?>
            </div>
    </div>
</div>

<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-5">
    <section>
        <div class = "section-inner" style="background-color:#139CBC;padding:20px">
        <H1 style="color:#FFFFFF" class="text-center">Thématiques</H1>

            <?php
                //var_dump($lesThematiques);
                if(isset($lesThematiques))
                {
                    echo '<ul>';
                    foreach($lesThematiques as $uneThematique)
                    {
                        $i = 0;
                        echo '<ul>';

                        //var_dump($uneThematique);

                        if(isset($uneThematique))
                        {
                            foreach($uneThematique as $uneSsThematique)
                            {
                                //var_dump($uneSsThematique);
                                if($i==0)
                                {
                                    // les thematiques 
                                    echo '<h4><input class="Thematique" type="checkbox" value="#" style="color:#FFFFFF" id="'.$uneSsThematique['NOMTHEMATIQUE'].'"> '.$uneSsThematique['NOMTHEMATIQUE'].'</input></h4>';
                                    echo '<ul>';
                                    $i++;
                                }
                                else
                                {
                                    // les sous thematiques
                                    echo '<h4><input class="SousThematique" type="checkbox" value="#" style="color:#FFFFFF" id="'.$uneSsThematique['NOMTHEMATIQUE'].'"> '.$uneSsThematique['NOMTHEMATIQUE'].'</input><BR></h4>';
                                }
                            }
                            echo '</ul>';
                        }
                        
                        echo '</ul>';
                    }
                    
                }
                


                echo '<div class="text-center">';
                    echo form_submit('lier', 'Lier',array('class'=>'btn btn-danger'));
                echo '</div>';
            ?>

        </div>

    </section>
    </div>
    <div class="col-sm-5">
    <section>
        <div class = "section-inner" style="background-color:#139CBC;padding:20px">

            <H1 style="color:#FFFFFF" class="text-center">Mots-Clés</H1>

                <div class='form-group'>
                    <label> Rechercher : </label>
                    <input class="form-control" id="myInput" type="text" placeholder="Rechercher..">
                </div>
                <table class="table" id="myTable">
                    <tr>
                        <?php 
                             //var_dump($motsCles);
                            $i = 0;
                            $lim = 4;
                            if(isset($motsCles))
                            {
                                foreach($motsCles as $unMotCle)
                                {
                                    if($i==$lim)
                                    {
                                        echo'</tr><tr>';
                                        $i=0;
                                    }
    
                                    echo '<td><h4><input class="MotCle" type="checkbox" value="#" style="color:#FFFFFF" id="'.$unMotCle['MotCle'].'"> '.$unMotCle['MotCle'].'</input></h4></td>';
                                    $i++;
                                }
                            }
                         
                            //var_dump($i);
                            for($i;$i<$lim;$i++)
                            {
                                echo"<td></td>";
                            }
                        ?>
                    </tr>
                </table>

            <?php
                echo '<div class="text-center">';
                    echo form_submit('lier', 'Lier',array('class'=>'btn btn-danger'));
                echo '</div>';
            ?>
        
        </div>
    </section>
    </div>
</div>


<div class="row" style="background-color:#15B7D1">
<div  style="padding:20px">
    <?php       

        echo '<div class="text-right">';
            echo'<h6><a href="'.site_url('Acteur/ContacterAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span>  Nouvelle Thématique ?</a></h6>';
        echo '</div>';
            
    ?>
</div> 
    
</div> 
<script src=<?php echo('"'.js_url("js_ActeurAjoutThematique").'"')?>></script>