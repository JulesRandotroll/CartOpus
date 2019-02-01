<ul class="nav navbar-nav navbar-right">
                        <?php 
                            if($this->session->statut == 4) 
                            {
                        ?>
                            <li>
                                <a href="<?php echo site_url('AdminValider/AccueilAdminValider'); ?>" style="color:#FFFFFF" >
                                    <span class='glyphicon glyphicon-home'></span> 
                                    Accueil Admin
                                </a>
                            </li>  
                            <li>
                                <a href="<?php echo site_url('Visiteur/SeDeconnecter'); ?>" style="color:#FFFFFF">
                                    <span class="glyphicon glyphicon-log-out"></span> 
                                    Se Déconnecter
                                </a>
                            </li>
                        <?php
                            }
                            elseif($this->session->statut == 5)
                            {
                                echo'<li><a href="'.site_url('SuperAdmin/AccueilSuperAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> Page Perso</a></li>';
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="row" style="background-color:#15B7D1" id='modif'> 
    <div class="col-sm-2">
    </div> 
    <div class="col-sm-8">
        <section >
            <div class = "section-inner" style="background-color:#139CBC;padding:20px">
            </div>
        </section>
    </div>
</div>