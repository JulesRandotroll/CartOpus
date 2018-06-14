                    <ul class="nav navbar-nav navbar-right">
                        <?php 
                            echo'<li><a href="'.site_url('Visiteur/SInscrire').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                            echo'<li><a href="'.site_url('Visiteur/SeConnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>';
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
    <div class="col-sm-8">
        <div class = "text-center">
            <H1 align = "center" style="color:#FFFFFF">Récupération du Mot de Passe</H1><BR>;
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                            echo'<br>';
                            echo form_open('visiteur/recupmdp');
                            echo ('Mail: '); // creation d'un label devant la zone de saisie
                            echo form_input('mail','',array('required'=>'required'));

                            echo ("Par email :");
                            echo form_submit('recupmail', 'Envoyer');
                            echo'<br>';

                            echo '<a style="color:#FFFFFF" href="'.site_url('Visiteur/sInscrire').'">S\'inscrire ? </a>';
                            echo form_close();
                    ?>
                </div>
            </section>
            <br>
        </div> 
    </div> 
  
</div>
</body>
<html>