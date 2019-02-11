<ul class="nav navbar-nav navbar-right">
                        <?php
                 echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
                 echo'<li><a href="'.site_url('Acteur/ChoixAction/1').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-list-alt"></span> Afficher Action</a></li>';
                 echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<script src="<?php echo js_url('js_lieOrgaActeur'); ?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<div class="row" style="background-color:#15B7D1;padding:20px" id="action">
    <!-- <div class="col-lg-2">
    </div> -->
    <div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Gestion organisation</H1>
            </div>
            <section>
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    
                <?php
                        // if (isset($message))
                        // {
                        //    echo'<div class="alert alert-danger alert-dismissible">
                        //            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        //            <strong>Attention</strong> '.$message.'
                        //        </div>';
                        // }
                        ?>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" value='0'>
                                <span id='Dropdown_Organisation'>Selectionnez une Organisation</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" >
                                <input class="form-control myInput" type="text" placeholder="Recherche">
                                <li class="divider"></li>
                                <?php 
                                    foreach ($Organisations as $uneOrganisation)
                                    {
                                    // var_dump($uneOrganisation);
                                        echo '<li class="Orga" id="'.$uneOrganisation['NO_ORGANISATION'].'"><a>'.$uneOrganisation['NOMORGANISATION'].'</a></li>';
                                    }
                                    echo'<li><a href="'.site_url('Acteur/AjoutOrga').'">Ajouter une nouvelle organisation</a></li>';
                                ?>
                            </ul> 
                        </div>

                        <br>

                        <div class="col-sm-6">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle form-control disabled" id="secteur" type="button" data-toggle="dropdown" value='0'>
                                    <span id='Dropdown_Secteur'>Selectionnez Secteur</span>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu"  id="ici"></ul> 
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <button class="btn btn-default form-control disabled" type="button" id="modif">Modifier Organisation</button> 
                        </div>
                        <br>  <br>
                        <button type="button" id="lier" class="btn btn-danger form-control disabled"=>Travailler dans</button> 
                        
                </div>
            </section>
        </div>
    </div>
</div>
</div>
<?php
   echo form_open('Acteur/ModifierOrga',array("id"=>"form_modif"));
   echo form_close();
?>



