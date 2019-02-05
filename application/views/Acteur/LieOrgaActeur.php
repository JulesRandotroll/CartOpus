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

<div class="row" style="background-color:#15B7D1;padding:20px" id="action">
    <!-- <div class="col-lg-2">
    </div> -->
    <div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Afficher les membres</H1>
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

                        echo form_open('Acteur/LieOrgaActeur/'.$noActeur);
                        echo form_close();
                    ?>
                </div>
            </section>
        </div>
    </div>
</div>
</div>



