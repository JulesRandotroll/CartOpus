<ul class="nav navbar-nav navbar-right">
                        <?php 
                            //echo'<li><a href="'.site_url('Visiteur/SInscrire').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                            echo'<li><a href="'.site_url('Visiteur/SeConnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>';
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="row" style="background-color:#15B7D1">
    
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6" style="padding:20px">
        <div style="padding:20px">
            <div class='text-center'>
                <H1 style="color:#FFFFFF">Finaliser l'Inscription</H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <H4>
                    <?php
                        echo validation_errors(); // mise en place de la validation
                        echo form_open('Visiteur/finaliser/'.$code);
           

                        echo '<div class="row">';
                            echo '<div class="col-xs-1">';
                            echo '</div>';
                            echo '<div class="col-xs-10">';
                                echo '<div class="text-center">';
                                    echo form_submit('finalise','Valider mon Compte',array('id'=>'finalise','class'=>"btn btn-danger"));
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                  
                        echo form_close();
                    ?>
                </H4>
                </div>
            <section>
        </div>
    </div>    
</div>
