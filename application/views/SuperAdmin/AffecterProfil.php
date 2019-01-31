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

<div class='row' style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Affecter un profil à un utilisateur</H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="color:#ccccb3">
                                        Destitués
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <table class="table">
                                        <?php
                                            foreach ($Visiteur as $unActeur)
                                            {
                                                echo '<tr><td> <a href="'.site_url('Visiteur/AfficherActeur/'.($unActeur['NOACTEUR'])).'" style="color:FFFFFF">'.$unActeur['NOMACTEUR']." ".$unActeur['PRENOMACTEUR']."</a></td><td> ".$unActeur['MAIL']."</td><td>".'<a href="'.site_url('SuperAdmin/AffecterProfil/'.($unActeur['NOACTEUR']).'#Mod').'" class="btn btn-danger pull-right" >Modifier</a>'."</td></tr>";
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="color:#ccccb3">
                                        Acteurs
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse in" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <table class="table">
                                        <?php
                                            foreach ($Acteur as $unActeur)
                                            {
                                                echo '<tr><td> <a href="'.site_url('Visiteur/AfficherActeurAction/'.($unActeur['NOACTEUR'])).'" style="color:FFFFFF">'.$unActeur['NOMACTEUR']." ".$unActeur['PRENOMACTEUR']."</a></td><td> ".$unActeur['MAIL']."</td><td>".'<a href="'.site_url('SuperAdmin/AffecterProfil/'.($unActeur['NOACTEUR']).'#Mod').'" class="btn btn-danger pull-right" >Modifier</a>'."</td></tr>";
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="color:#ccccb3">
                                        Administrateurs Valider
                                    </a>
                                    
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <table class="table">
                                        <?php
                                            foreach ($AdminValider as $unActeur)
                                            {
                                                echo"<tr><td>".$unActeur['NOMACTEUR']." ".$unActeur['PRENOMACTEUR']."</td><td>"."</td><td> ".'<a href="'.site_url('SuperAdmin/AffecterProfil/'.($unActeur['NOACTEUR']).'#Mod').'" class="btn btn-danger pull-right" >Modifier</a>'."</td></tr>";
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" style="border:black">
                            <div class="panel-heading" style="background-color:#B64F53">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="color:#ccccb3">
                                        Super Administrateurs
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse" style="background-color:#15B7D1">
                                <div class="panel-body" style="border:black;">
                                    <table class="table">
                                        <?php
                                            foreach ($SuperAdmin as $unActeur)
                                            {
                                                if($unActeur['NOACTEUR']==$this->session->noActeur)
                                                {
                                                    echo"<tr><td>".$unActeur['NOMACTEUR']." ".$unActeur['PRENOMACTEUR']."</td><td>"."</td><td></td></tr>";
                                                }
                                                else
                                                {
                                                    echo"<tr><td>".$unActeur['NOMACTEUR']." ".$unActeur['PRENOMACTEUR']."</td><td>"."</td><td> ".'<a href="'.site_url('SuperAdmin/AffecterProfil/'.($unActeur['NOACTEUR']).'#Mod').'" class="btn btn-danger pull-right" >Modifier</a>'."</td></tr>";
                                                }
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
            </section>
        </div>
    </div>
</div>