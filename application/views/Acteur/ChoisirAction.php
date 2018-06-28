<ul class="nav navbar-nav navbar-right">
                    <?php 
                        echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
                        echo'<li><a href="'.site_url('Acteur/ContacterAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-send"></span> Contacter Nous</a></li>';
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
                <H1 style="color:#FFFFFF">Choisir une action à réitérer</H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                        echo form_open('Acteur/ReitererAction/0');

                        echo '<div class="form-group">';
                        echo form_label('Action choisie : ', 'Action');
                        echo form_dropdown('Action', $options,'' ,Array('class'=>'form-control'));
                        echo '</div>';

                        
                        echo '<div class="text-center">';
                            echo form_submit('Choix', 'Choisir',array("class"=>"btn btn-danger btn-lg"));
                        echo '</div>';
                        
                        echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont requis</h6> ';
                        echo form_close();
                        
                    ?>
                </div>
            <section>
        </div>
    </div>    
</div>

