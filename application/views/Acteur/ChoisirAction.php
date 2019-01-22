<ul class="nav navbar-nav navbar-right">
                    <?php 
               echo '<li class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFFFFF ;background-color:#0E7896">Action
               <span class="caret"></span></a>
               <ul class="dropdown-menu" style="background-color:#139CBC">
                   <li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>
                   <li><a href="'.site_url('Acteur/ChoixAction/1').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-list-alt"></span> Afficher Action</a></li>
                   <li><a href="'.site_url('Acteur/ChoixAction/2').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-pencil"></span> Modifier Action</a></li>   
                   <li><a href="'.site_url('Acteur/ChoixAction/3').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter SousAction</a></li>
                   <li><a href="'.site_url('Acteur/ChoixAction/4').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-repeat"></span> Renouveler Action</a></li>
                   <li><a href="'.site_url('Acteur/ChoixAction/5').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-trash"></span> Supprimer Action</a></li>
               </ul>
            </li>';
            echo'<li><a href="'.site_url('Acteur/GestionProfil').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-cog"></span> Compte</a></li>';
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
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Choisir une action</H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                   // var_dump($message);
                    //var_dump($options);
                    if ($page ==1)
                    {
                        echo form_open('Acteur/ChoixAction/1');
                        $page="Afficher";
                    }
                    if ($page ==2)
                    {
                        echo form_open('Acteur/ChoixAction/2');
                        $page="Modifier";
                    }
                    if ($page ==3)
                    {
                        echo form_open('Acteur/ChoixAction/3');
                        $page="SousAction";
                    }
                    if ($page ==4)
                    {
                        echo form_open('Acteur/ChoixAction/4');
                        $page="Renouveler";
                    }
                    if ($page ==5)
                    {
                        echo form_open('Acteur/SupprimerAction',array("id"=>"form_suppr"));
                        $page="Supprimer";
                    }

                        echo '<div class="form-group">';
                        echo form_label('Action choisie : ', 'Action');
                        echo form_dropdown('Action', $options,'' ,Array('class'=>'form-control',"id"=>"dropAction"));
                        echo '</div>';

                        
                        echo '<div class="text-center">';
                            echo form_submit('Choix_'.$page,$page,array("class"=>"btn btn-danger btn-lg",'id'=>'btn_'.$page));
                        echo '</div>';
                        
                        //var_dump($page);
                        echo form_close();
                        
                    ?>
        
                </div>
            <section>
        </div>
    </div>    
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src=<?php echo('"'.js_url("js_supprAction").'"')?>></script>