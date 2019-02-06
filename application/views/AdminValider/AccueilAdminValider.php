                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo site_url('AdminValider/GererFilActu') ?>" style="color:#FFFFFF;"><span class="glyphicon glyphicon-star"></span> Gérer fil actualité</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('AdminValider/GererMotCles') ?>" style="color:#FFFFFF;"><span class="glyphicon glyphicon-list-alt"></span> Gerer Mots Cles</a> 
                        </li>
                        <li>
                            <a href="<?php echo site_url('AdminValider/GererRole') ?>" style="color:#FFFFFF"><span class="glyphicon glyphicon-briefcase"></span> Gerer rôles</a>
                        </li>';
                           






                        <li>
                            <a href="<?php echo site_url('Visiteur/SeDeconnecter'); ?>" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a>
                        </li>
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
            <H1 align = "center" style="color:#FFFFFF">Accueil</H1><BR>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php 
                        var_dump($Actions)
                    ?>                    
                </div>
            </section>
            <BR>
        </div>
    </div>
</div>