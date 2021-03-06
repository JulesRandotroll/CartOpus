                    <ul class="nav navbar-nav navbar-right">
                        <?php 
                            echo'<li><a href="'.site_url('SuperAdmin/AccueilSuperAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> Page Perso</a></li>';
                            echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<script src=<?php echo('"'.js_url("JavaScript_AjouterThematique").'"') ?>></script>


<!-- Messages affichés en cas d'erreur ou d'insertion correcte dans la BDD !-->
<div class="row" style="background-color:#15B7D1">
    <div class='col-sm-1'>
    </div>
    <div class='col-sm-10'>
        <?php
        if(isset($Message))
        {
            echo"<div class='alert alert-success alert-dismissible'>
                <a href='#' class = 'close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong> Message </strong>".$Message."
            </div>";
        }
        elseif(isset($Danger))
        {
            echo"<div class='alert alert-danger alert-dismissible'>
                <a href='#' class = 'close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong> Attention </strong> ".$Danger."
            </div>";
        }
        elseif(isset($Attention))
        {
            echo"<div class='alert alert-warning alert-dismissible'>
                <a href='#' class = 'close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong> Attention </strong> ".$Attention."
            </div>";
        }
        ?>
    </div>
</div>


<!--  Affichage de toute les thematiques et sous thematiques  -->
<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
        <div class = "text-center">
            <H1 align = "center" style="color:#FFFFFF">Liste des thématiques et sous thématiques</H1>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php

                        echo '<div class="form-group">';
                            echo form_label('Thématique et sous thématiques : ', 'lbl_thematique'); 
                            echo form_dropdown('Thema', $Theme_SsTheme, 'default',array('required'=>'required','class'=>'form-control'));
                        echo '</div>';

                    ?>
                </div>
            </section>
            <BR>
            <BR>        
        </div>
    </div>
</div>


<div class='row' style="background-color:#15B7D1">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class = "text-center">
            <H1 align = "center" style="color:#FFFFFF">Gestion des Thématiques</H1>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <div class="panel-group" id="accordion">
                        
                        <!-- Créer Thematique -->
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="color:#ccccb3">
                                        Créer Thématique
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <?php
                                        echo form_open('SuperAdmin/AjouterThematique');
                                        echo '<div class="form-group">';
                                        echo form_label('Nouvelle Thématique: ', 'NewTheme');
                                        echo form_input('nouvellethematique','',array('required'=>'required','placeholder'=>'Ex: Musique','pattern'=>'[a-zA-Z0-9 -.]{1,40}','class'=>'form-control')); 
                                        echo '</div>';

                                        echo '<div class="text-center">';
                                        echo form_submit('AjoutThematique', 'Ajouter',array('class'=>'btn btn-danger', 'id'=>'btn_Ajout_Thema'));
                                        echo '</div>';
                                        echo form_close();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Créer SsThematique -->
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="color:#ccccb3">
                                        Créer une sous-thématiques et la lier à une thématique
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <?php
                        
                                        echo form_open('SuperAdmin/CreerSsThematique',array('id'=>'form_crea_ssThematique'));
                                        echo '<div class="form-group">';
                                        echo '<span style="color:#FF0000"/> * </span>';
                                        echo form_label('Thématique : ', 'lbl_thematique'); 

                                    ?>

                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" value='0'>
                                            <span id='Dropdown_Ajouter_SsThematique'>Selectionnez une thématique</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <input class="form-control myInput" type="text" placeholder="Recherche">
                                            <li class="divider"></li>
                                            <?php 
                                                foreach ($Thematique as $uneThematique)
                                                {
                                                    echo '<li class="ajouter_SsThematique" value = "'.$uneThematique['NOTHEMATIQUE'].'"><a>'.$uneThematique['NOMTHEMATIQUE'].'</a></li>';
                                                }
                                            ?>
                                        </ul> 
                                    </div>

                                    <?php
                                        echo '</div>';

                                        echo '<div class="form-group">';
                                        echo form_label('Nouvelle Sous Thématique: ', 'NewSSTheme');
                                        echo form_input('nouvellesousthematique','',array('required'=>'required','placeholder'=>'Ex: Rock,Jazz,Pop','pattern'=>'[a-zA-Z0-9 -.]{1,40}','class'=>'form-control')); 
                                        echo '</div>';

                                        echo '<div class="text-center">';
                                    ?>

                                        <!--<input type="button" class="btn btn-danger" id="btn_ajout_SsThematique" value="Ajouter">-->
                                    
                                        
                                    <?php 
                                        echo form_submit('AjoutSSThematique', 'Ajouter',array('class'=>'btn btn-danger','id'=>'btn_ajout_SsThematique'));
                                        echo '</div>';
                                        echo form_close();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Lier thématique et sous-thématique existantes -->
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="color:#ccccb3">
                                        Lier thématique et sous-thématique existantes
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <?php
                                        echo form_open('SuperAdmin/lierThematiques',array('id'=>'form_lier_Thematiques'));
                                        echo '<div class="form-group">';
                                        echo '<span style="color:#FF0000"/> * </span>';
                                        echo form_label('Thématique : ', 'lbl_thematique');     
                                    ?> 
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" value='0'>
                                            <span id='Dropdown_Lier_Thematique'>Selectionnez une thématique</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <input class="form-control myInput" type="text" placeholder="Recherche">
                                            <li class="divider"></li>
                                            <?php 
                                                foreach ($Thematique as $uneThematique)
                                                {
                                                    echo '<li class="lier_Thematique" value = "'.$uneThematique['NOTHEMATIQUE'].'"><a>'.$uneThematique['NOMTHEMATIQUE'].'</a></li>';
                                                }
                                            ?>
                                        </ul> 
                                    </div>
                                    <?php 
                                        echo '</div>';


                                        echo '<div class="form-group">';
                                            echo '<span style="color:#FF0000"/> * </span>';
                                            echo form_label('Sous thématiques : ', 'lbl_thematique'); 
                                    ?>

                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" value='0'>
                                            <span id='Dropdown_Lier_SsThematique' value='0'>Selectionnez une sous-thématique</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <input class="form-control myInput" id="myInput" type="text" placeholder="Recherche">
                                            <li class="divider"></li>
                                            <?php 
                                                foreach ($SsThemes as $unSousTheme)
                                                {
                                                    echo '<li class="lier_SsThematique" value = "'.$unSousTheme['NOSOUSTHEMATIQUE'].'"><a>'.$unSousTheme['NOMTHEMATIQUE'].'</a></li>';
                                                }
                                            ?>
                                        </ul> 
                                    </div>

                                    <?php 
                                        echo '</div>';
                                        echo form_submit('lierThematiques', 'Lier',array('class'=>'btn btn-danger','id'=>'btn_lierThematiques'));
                                        echo form_close();
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Migration de sous-thématiques vers thématique -->
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="color:#ccccb3">
                                        Faire migrer une sous-thématiques en thématique
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <?php
                                        echo form_open('SuperAdmin/MigrationSousThematique',array("id"=>"form_Migrer"));

                                        echo '<div class="form-group">';
                                        
                                            echo form_label('Sous-thématique à migrer : ', 'NewTheme');
                                    ?>

                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" value='0'>
                                                    <span id='Dropdown_Migrer'>Selectionnez une sous-thématique</span>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <input class="form-control myInput" type="text" placeholder="Recherche">
                                                    <li class="divider"></li>
                                                    <?php 
                                                        foreach ($SsThemes as $unSousTheme)
                                                        {
                                                            echo '<li class="migrer_ssThematique" value = "'.$unSousTheme['NOSOUSTHEMATIQUE'].'"><a>'.$unSousTheme['NOMTHEMATIQUE'].'</a></li>';
                                                        }
                                                    ?>
                                                </ul> 
                                            </div>
                                    
                                        </div>
                                    <?php        
                                        echo '<BR><div class="text-center">';
                                        //echo form_submit('Migration', 'Faire migrer',array('class'=>'btn btn-danger','id'=>'btnMigrer'));
                                    ?>
                                    <input type="button" id='btnMigrer' name='btnMigration' value='Faire migrer' class='btn btn-danger'>
                                    <?php
                                        echo form_close();
                                        echo '</div>';
                                    ?>
                                </div>
                            </div>
                        </div>


                        <!-- Supprimer une thématique -->
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" style="color:#ccccb3">
                                        Supprimer une thématique
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <?php 
                                        echo form_open('SuperAdmin/SupprimerThematique',array("id"=>"form_SupprimerThematique"));
                                        echo '<div class="form-group">';
                                            echo form_label('Thématique à supprimer : ', 'NewTheme'); 
                                    ?>

                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" value='0'>
                                                        <span id='Dropdown_Supprimer_Thematique'>Selectionnez une thématique</span>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <input class="form-control myInput" type="text" placeholder="Recherche">
                                                        <li class="divider"></li>
                                                        <?php 
                                                            foreach ($Thematique as $uneThematique)
                                                            {
                                                                echo '<li class="supprimer_Thematique" value = "'.$uneThematique['NOTHEMATIQUE'].'"><a>'.$uneThematique['NOMTHEMATIQUE'].'</a></li>';
                                                            }
                                                        ?>
                                                    </ul> 
                                                </div>
                                    
                                    <?php
                                            echo '</div>';
                                        
                                        echo form_submit('SupprimerThematique', 'Supprimer',array('class'=>'btn btn-danger','id'=>'btn_suppr_Thematique'));
                                        echo form_close();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Supprimer une sous-thématique -->
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse6" style="color:#ccccb3">
                                        Supprimer une sous-thématique
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <?php 
                                        echo form_open('SuperAdmin/SupprimerSousThematique',array("id"=>"form_SupprimerSousThematique"));
                                        echo '<div class="form-group">';
                                        echo form_label('Sous-thématique à supprimer : ', 'NewTheme'); 
                                    ?>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" value='0'>
                                            <span id='Dropdown_Supprimer_SousThematique'>Selectionnez une sous - thématique</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <input class="form-control myInput" type="text" placeholder="Recherche">
                                            <li class="divider"></li>
                                            <?php 
                                                foreach ($SsThemes as $unSousTheme)
                                                {
                                                    echo '<li class="supprimer_SsThematique" value = "'.$unSousTheme['NOSOUSTHEMATIQUE'].'"><a>'.$unSousTheme['NOMTHEMATIQUE'].'</a></li>';
                                                }
                                            ?>
                                        </ul> 
                                    </div>
                                    <?php
                                        echo '</div>';
                                        
                                        echo form_submit('SupprimerSsThematique', 'Supprimer',array('class'=>'btn btn-danger','id'=>'btn_suppr_SousThematique'));
                                        echo form_close();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Délier une sous-thématique d'une thématique -->
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse7" style="color:#ccccb3">
                                        Délier une sous-thématique d'une thématique
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse7" class="panel-collapse collapse" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <?php 
                                        echo form_open('SuperAdmin/DelierUneSousThematiques',array("id"=>"form_Delier_SousThematiques"));
                                        echo '<div class="form-group">';
                                        echo form_label('Thématique à delier : ', 'NewTheme'); 
                                    ?>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" value='0'>
                                                <span id='Dropdown_Delier_SousThematique'>Selectionnez une thématique</span>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <input class="form-control myInput" type="text" placeholder="Recherche">
                                                <li class="divider"></li>
                                                <?php 
                                                    foreach ($Thematique as $uneThematique)
                                                    {
                                                        echo '<li class="delier_SousThematique" value = "'.$uneThematique['NOTHEMATIQUE'].'"><a>'.$uneThematique['NOMTHEMATIQUE'].'</a></li>';
                                                    }
                                                ?>
                                            </ul> 
                                        </div>
                                    </div>
                                    <br>
                                    <?php 
                                        echo '<div class="form-group">';
                                        echo form_label('sous-thématique à delier : ', 'NewTheme');
                                    ?>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" value="0">
                                                <span id="Dropdown_Delier_uneSousThematique">Selectionnez une sous-thématique</span>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" id="ici">
                                                <input class="form-control myInput" type="text" placeholder="Recherche">
                                                <li class="divider"></li>
                                                <li class="delier_uneSousThematique"><a>Selectionnez une thématique</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <BR>
                                    <?php
                                        echo form_submit('DelierSousThematique', 'Délier',array('class'=>'btn btn-danger','id'=>'btn_delier_SousThematique'));
                                        echo form_close();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Délier toutes les sous-thématiques d'une thématique -->
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse8" style="color:#ccccb3">
                                        Délier toutes les sous-thématiques d'une thématique
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse8" class="panel-collapse collapse" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <?php 
                                        echo form_open('SuperAdmin/DelierSousThematiques',array("id"=>"form_DelierSousThematiques"));
                                        echo '<div class="form-group">';
                                        echo form_label('Thématique à delier : ', 'NewTheme'); 
                                    ?>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" value='0'>
                                            <span id='Dropdown_Delier_Thematique'>Selectionnez une thématique</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <input class="form-control myInput" type="text" placeholder="Recherche">
                                            <li class="divider"></li>
                                            <?php 
                                                foreach ($Thematique as $uneThematique)
                                                {
                                                    echo '<li class="delier_Thematique" value = "'.$uneThematique['NOTHEMATIQUE'].'"><a>'.$uneThematique['NOMTHEMATIQUE'].'</a></li>';
                                                }
                                            ?>
                                        </ul> 
                                    </div>
                                    <?php
                                        echo '</div>';
                                        
                                        echo form_submit('DelierThematique', 'Délier',array('class'=>'btn btn-danger','id'=>'btn_delier_thematique'));
                                        echo form_close();
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>   
                </div>
            </section>
        </div>
    </div>
</div>

<div class='row' style="background-color:#15B7D1">
    <BR>
    <BR>
    <BR>
    <BR>
    <BR>
    <BR>
    <BR>
</div>