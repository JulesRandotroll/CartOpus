<ul class="nav navbar-nav navbar-right">
                        <?php
                  echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
              echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
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
    <!-- <div class="col-lg-2">
    </div> -->
    <div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Afficher les membres</H1>
            </div>
            <section>
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php

                        $i = 0;
                  $noActeur=4;
                        var_dump($noAction);
                        echo '<div class="text-left">';
                        echo'<a href="'.site_url('Acteur/AfficherActionSelectionnee/'.$noAction).'" style="color:#000000"><button type="button" class="btn btn-danger">Retour</button> </a>';
                        echo '</div>';
                       
                        echo form_close();
                        
                    ?>
                </div>
            </section>
        </div>
    </div>
    <div class='col-xs-1'>
        <nav class="navbar navbar-inverse nav-pills nav-stacked" data-spy="affix" style="background-color:#B64F53;border-radius: 10px;">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url('Acteur/AjoutMembre/0'); ?>" class="option"><H4><span class="glyphicon glyphicon-user" style="color:#FFFFFF"></span></H4></strong></a></li>
            <li><a href="<?php echo site_url('Acteur/ModifierMembre/'.$noActeur); ?>" class="option"><H4><span class="glyphicon glyphicon-pencil" style="color:#FFFFFF"></span></H4></a></li>
                <li><a href="<?php echo site_url('Acteur/EnvoyerMessage/'); ?>" class="option"><H4><span class="glyphicon glyphicon-envelope" style="color:#FFFFFF"></span></H4></a></li>
                <li><a id="trash_Supprimer" href="#section3" class="option"><H4><span class="glyphicon glyphicon-trash" style="color:#FFFFFF"></span></H4></a></li>
            </ul>
        </nav>
    </div>
</div>

<?php 
    //echo $AffichageAction;
?>

