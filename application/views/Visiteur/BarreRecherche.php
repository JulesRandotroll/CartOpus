<ul class="nav navbar-nav navbar-right">
                        <?php
                        //var_dump($this->session->statut);
                        if ($this->session->statut==0)
                        {
                            echo'<li><a href="'.site_url('Visiteur/SInscrire').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                            echo'<li><a href="'.site_url('Visiteur/SeConnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>';
                        }
                        else
                        {
                            if ($this->session->statut==1)
                            {
                                if ($this->session->nbaction==0)
                                {
                                    echo '<li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>';
                                    echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';    
                                    echo'<li><a href="'.site_url('Acteur/GestionProfil').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-cog"></span> Compte</a></li>';
                                    echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                                }
                                else
                                {
                                    echo 
                                    '<li class="dropdown">
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
                                    echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';
                                    echo'<li><a href="'.site_url('Acteur/GestionProfil').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-cog"></span> Compte</a></li>';
                                    echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                                }       
                            }
                            if($this->session->statut==4)
                            {
                                echo'<li><a href="'.site_url('#').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>';
                                echo'<li><a href="'.site_url('#').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</a></li>';
                            }
                            if($this->session->statut==5)
                            {
                                echo'<li><a href="'.site_url('SuperAdmin/AccueilSuperAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>';
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</a></li>';
                            }
                        }
                        ?>
                    </ul>

                </div>
            </div>
        </nav>
    </div>
</div>
<!--Barre de recherche-->
 <div class="row" style="background-color:#15B7D1;padding:20px">
    <?php
        if(isset($message))
        {
            echo '<div class="alert alert-warning">
            <strong>Attention !</strong> '.$message.
          '</div>';
        }
        echo form_open('Visiteur/Rechercher');
    ?>
    <div class="col-sm-1">   
    </div>
    <div class="col-sm-3" style="padding:10px">
        <div class = "text-center">
            <section>
                <div class = "section-inner" style="padding:10px">
                    <label>Recherche : </label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="MotCle">
                        <div class="input-group-btn">
                        <button class="btn btn-default form-control" type="submit" name="Recherche">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="col-sm-3" style="padding:10px">
        <div class = "text-center">
            <section>
                <div class = "section-inner" style="padding:10px">
                    <div class="form-group">
                        <?php
                            echo form_label('Date Début :', 'lbl_DateDebut');
                            echo '  ';
                        
                            //$ToDay = date('d/m/Y');
                            $ToDay = date('Y-m-d');
                            //var_dump($ToDay);
                            echo '<input class="form-control" name="DateD" id="dateD" type="date" value="'.$ToDay.'">';

                            echo form_label('Date Fin :', 'lbl_DateFin');
                            echo '  ';
                        
                            echo '<input class="form-control" name="DateF" id="dateF" type="date">';

                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="col-sm-2" style="padding:10px">
        <div class = "text-center">
            <section>
                <div class = "section-inner" style="padding:10px">
                    <div class="form-group">
                        <?php
                            echo form_label('Heure Début :', 'lbl_HeureDebut');
                            echo '  ';
                        
                            echo '<input class="form-control" name="HeureD" id="heureD" type="time">';

                            echo form_label('Heure Fin :', 'lbl_HeureFin');
                            echo '  ';
                        
                            echo '<input class="form-control" name="HeureF" id="heureF" type="time">';

                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <div class="col-sm-1">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="padding:20px">
                    <BR>
                    <div class="form-group">
                        <?php 
                            echo form_submit('RechercheAvancee','Rechercher',array('class'=>'btn-danger btn-lg'));
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php 
        echo form_close(); 
    ?>
</div>