<ul class="nav navbar-nav navbar-right">
                        <?php 
                             echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div><div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">
            <?php
            $ActionSelect='BabelDance'; // faire passer le nom choisie en paramètre
                echo '<H1 style="color:#FFFFFF">Ajouter une thématique pour '.$ActionSelect.'</H1>';
            ?>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                         echo form_label('Thématique :', 'lbl_Thematique');
                         echo ' ';
                         $option = array(
                             'Musique'=>array('Musique','Rock','Jazz','Blues'),
                             'Sport'=>array('Sport','Kayak','Karate')
                         );
                        echo 
                        form_dropdown('thematique', $option, 'default');
                        
                         ?>
                         <form action="AjoutThematique.php" method="post">
                         <!-- <?php 
                        // foreach ($option as $uneOption) 
                       //  {
                         //    foreach($uneOption as $uneThematique):
                         //       echo' <input type="checkbox" name="theme[]" value='.$uneThematique.' />'.$uneThematique.'<br>';
                         //    endforeach;
                        // }
                         ?>
                            <input type="checkbox" name="prenom[]" value="adriana" />Adriana<br>
                            <input type="checkbox" name="prenom[]" value="alessandra" />Alessandra<br>
                            <input type="checkbox" name="prenom[]" value="candice" />Candice<br>
                            <input type="checkbox" name="prenom[]" value="lili" />Lili<br>
                            <input type="submit" value="Lier" />
                        </form> -->
                        <?php

                            echo'<li><a href="'.site_url('Acteur/ContacterAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Nouvelle Thématique ?</a></li>';
                         ?>
                
                </div>
            <section>
        </div>
    </div>    
</div>
