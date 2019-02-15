<ul class="nav navbar-nav navbar-right">
                        <?php
                            if($this->session->statut ==5)
                            {
                                echo '<li><a href="'.site_url('SuperAdmin/AjouterThematique').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajouter Thématique</a></li>';
                                echo '<li><a href="'.site_url('SuperAdmin/AffecterProfil/0').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> Affecter un profil à un Utilisateur</a></li>';
                                echo'<li><a href="'.site_url('SuperAdmin/AccueilSuperAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>';
                                echo '<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                            }
                            elseif($this->session->statut==4)
                            {
                                echo'<li><a href="'.site_url('#').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>'; 
                                echo'<li><a href="'.site_url('#').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</a></li>'; 
                            }
                            elseif($this->session->statut==1)
                            {
                                echo'<ul class="nav navbar-nav">';
                                echo '<li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFFFFF ;background-color:#0E7896">Action
                                    <span class="caret"></span></a>
                                    <ul class="dropdown-menu" style="background-color:#139CBC">
                                        <li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>
                                        <li><a href="'.site_url('Acteur/ReitererAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-repeat"></span> Réitérer Action</a></li>
                                        <li><a href="'.site_url('Acteur/ModifierAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-pencil"></span> Modifier Action</a></li>
                                    </ul>
                                </li>';
                               // echo'<li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Creation Action</a></li>';
                                echo'<li><a href="'.site_url('Acteur/GestionProfil').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-cog"></span> Compte</a></li>';
                                echo'</ul>';
                                echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>'; 
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</a></li>'; 
                            }
                            else
                            {   
                                if($this->session->pseudo!=null)
                                {
                                    //echo $this->session->pseudo;
                                    echo'<li> <a href="" style="color:#FFFFFF">Bonjour '.$this->session->pseudo.'</a></li>';
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                                }
                                else
                                {
                                    echo'<li><a href="'.site_url('Visiteur/SInscrire').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                                    echo'<li><a href="'.site_url('Visiteur/SeConnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>';
                                }     
                               
                            }
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="row" style="background-color:#15B7D1;padding:20px">
    <?php 
        // var_dump($Acteur);

        $tailleDescription = 250;
    ?>
    
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
        <div class = "text-center">
            <section>
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <table class="table">
                        <?php
                        
                            echo '<tr><td>';
                            echo (img($Acteur['PhotoProfil']));
                            echo '</td><td>';
                            echo $Acteur['NOMACTEUR'].'<BR>';
                            echo $Acteur['PRENOMACTEUR'].'<BR>';
                            
                           
                            echo '</td></tr>
                            <tr><td colspan="2">';

                            if(!empty($Organisation))
                            {
                                foreach($Organisation as $uneOrga)
                                {
                                    echo $uneOrga['NOMORGANISATION'].'<BR>';
                                    echo $uneOrga['ADRESSE'].'<BR>';
                                    echo $uneOrga['CodePostal'].', '.$uneOrga['Ville'].'<BR>';
                                    if($uneOrga['SITEURL']!= null)
                                    {
                                        echo $uneOrga['SITEURL'].'<BR><BR>'.'</td></tr>
                                        <tr><td colspan="2">' ;
                                    }
                                    else
                                    {
                                        echo '<BR><BR>'.'</td></tr>
                                        <tr><td colspan="2">';
                                    }
                                }
                            }
                        ?>
                        </td></tr>

                    </table>
                </div>
              
            </section>
        </div>
    </div>
</div>
<div class="row" style="background-color:#15B7D1;padding:20px">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <div class = "text-center">
            <section>
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                        <?php 
                            echo'<div class="table-responsive">';
                            $this->table->set_heading('Nom','Rôle de '.$Acteur['NOMACTEUR'].' '.$Acteur['PRENOMACTEUR'],'Site Internet','Date de debut','Description','');
                            //var_dump($Action);
                            if($Action != null)
                            {
                                foreach($Action as $uneAction)
                                {

                                    if(strlen($uneAction['Description'])>$tailleDescription)
                                    {
                                        $Description = substr($uneAction['Description'],0,$tailleDescription).' [...]';
                                    }
                                    else
                                    {
                                        $Description = $uneAction['Description'];
                                    }


                                    if($uneAction['DATEFIN']==null){$uneAction['DATEFIN']=0;}
                                    if(empty($uneAction['SiteURLAction']))
                                    {
                                        $this->table->add_row($uneAction['NOMACTION'],$uneAction['NOMROLE'],$uneAction['SiteURLAction'],$uneAction['DATEDEBUT'],$Description,'<a href="'.site_url('Acteur/AfficherActionSelectionnee/'.($uneAction['NOACTION']).'/'.($uneAction['DATEDEBUT']).'/'.($uneAction['DATEFIN'])).'" class="btn btn-danger" >Accès</a>');  
                                    }
                                    else
                                    {
                                        $this->table->add_row($uneAction['NOMACTION'],$uneAction['NOMROLE'],'<a href="'.$uneAction['SiteURLAction'].'" style="color:FFFFFF">Cliquer Ici</a>',$uneAction['DATEDEBUT'],$Description,'<a href="'.site_url('Acteur/AfficherActionSelectionnee/'.($uneAction['NOACTION']).'/'.($uneAction['DATEDEBUT']).'/'.($uneAction['DATEFIN'])).'" class="btn btn-danger" >Accès</a>');
                                    }
                                    
                                }
                                $Style = array('table_open' => '<table class="table" >');
                                $this->table->set_template($Style);
                                
                                echo $this->table->generate();
                            }
                            else
                            {
                                echo '<H4> N\'a participé à aucun évènement pour l\'instant. </H4>';
                            }
                            
                        ?>
                </div>
            </section>
        </div>
    </div>
</div>