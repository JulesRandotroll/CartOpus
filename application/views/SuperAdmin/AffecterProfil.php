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
<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
            <div style="padding:20px">
                    <div class = "text-center">
                        <H1 style="color:#FFFFFF">Affecter un profil à un utilisateur</H1>
                    </div>
                    <section >
                        <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                            <H4>
                            <table class="table" >
                                    <thead>
                                        <tr>
                                            <th>Acteur</th>
                                            <th ><button type="button" style="color:black; font-size:100%" class="btn btn-link btn-sm pull-right "><strong>+</strong></button></th> 
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <div class="container">
                                            <?php
                                                foreach ($Acteur as $unActeur)
                                                {
                                                echo"<tr><td>".$unActeur['NOMACTEUR']." ".$unActeur['PRENOMACTEUR']."</td><td>".'<a href="'.site_url('SuperAdmin/AffecterProfil/'.($unActeur['NOACTEUR']).'#Mod').'" class="btn btn-danger pull-right" >Modifier</a>'."</td></tr>";
                                                }
                                            ?>
                                        </div>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Admin Valider</th>
                                            <th ><button type="button" style="color:black; font-size:100%" class="btn btn-link btn-sm pull-right "><strong>+</strong></button></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($AdminValider as $unActeur)
                                            {
                                            echo"<tr><td>".$unActeur['NOMACTEUR']." ".$unActeur['PRENOMACTEUR']."</td><td>".'<a href="'.site_url('SuperAdmin/AffecterProfil/'.($unActeur['NOACTEUR']).'#Mod').'" class="btn btn-danger pull-right" >Modifier</a>'."</td></tr>";
                                            }
                                        ?>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Super Admin</th>
                                            <th ><button type="button" style="color:black; font-size:100%" class="btn btn-link btn-sm pull-right   "><strong>+</strong></button></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($SuperAdmin as $unActeur)
                                        {
                                           echo"<tr><td>".$unActeur['NOMACTEUR']." ".$unActeur['PRENOMACTEUR']."</td><td>".'<a href="'.site_url('SuperAdmin/AffecterProfil/'.($unActeur['NOACTEUR']).'#Mod').'" class="btn btn-danger pull-right" >Modifier</a>'."</td></tr>";
                                        }
                                    ?>
                                    </tbody>
                            </table>
                        </div>
                                <?php
                                    echo form_close();
                                ?>
                                </H4>
                            </div>
                        <section>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
