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
    <div class="col-sm-2">
    </div>
    <div class="col-sm-4">
    <section>
        <div class = "section-inner" style="background-color:#139CBC;padding:20px">
            <table class="text-center">
                <tr>
                    <th>Thématique</th>
                
                </tr>

                <tr>
                    <td>Carmen</td>

                </tr>
                <tr>
                    <td>Michelle</td>

                </tr>
                </table>
            
        </div>

    </section>
    </div>
    <div class="col-sm-4">
    <section>
        <div class = "section-inner" style="background-color:#139CBC;padding:20px">
        
        </div>
    </section>
    </div>
</div>


<div class="row" style="background-color:#15B7D1">
<div  style="padding:20px">
    <?php       
        echo '<div class="text-center">';
            echo form_submit('lier', 'Lier',array('class'=>'btn btn-danger'));
        echo '</div>';

        echo '<div class="text-right">';
            echo'<h6><a href="'.site_url('Acteur/ContacterAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span>  Nouvelle Thématique ?</a></h6>';
        echo '</div>';
            
    ?>
</div> 
    
</div> 