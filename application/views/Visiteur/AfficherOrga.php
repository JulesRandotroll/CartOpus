
<ul class="nav navbar-nav navbar-right ">
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
                                echo'<li><a href="'.site_url('AdminValider/AccueilAdminValider').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso</a></li>'; 
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</a></li>'; 
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

<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2" style="padding:20px">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px"> 

                        <?php        
                            foreach ($lesOrganisations As $uneOrganisation):
                               
                                if(!empty($uneOrganisation['NOTELORGA'] && $uneOrganisation['NOFAXORGA'] && $uneOrganisation['SITEURL']))
                                {
                                    echo '<h1>'.$uneOrganisation['NOMORGANISATION'].'</h1></br>';
                                    echo '<h4>'.$uneOrganisation['ADRESSE'].'</h4>';
                                    echo '<h4>'.$uneOrganisation['CodePostal'].' - '.$uneOrganisation['Ville'].'</h4></br>';
    
                                    echo '<span style="text-decoration:underline"><h3>Nous Contacter : </h3></span></br>';

                                    echo '<h4> Tel : '.$uneOrganisation['NOTELORGA'].'</h4>';
                                    echo '<h4> Fax : '.$uneOrganisation['NOFAXORGA'].'</h4>';
                                    echo '<h4> Site : '.$uneOrganisation['SITEURL'].'</h4>';
                                }
                                else
                                {
                                    echo '<h1>'.$uneOrganisation['NOMORGANISATION'].'</h1></br>';
                                    echo '<h4>'.$uneOrganisation['ADRESSE'].'</h4>';
                                    echo '<h4>'.$uneOrganisation['CodePostal'].' - '.$uneOrganisation['Ville'].'</h4></br>';
                                } 
                                
                                echo '';
                            endforeach ;
                        ?>
    
                </div>
            </section>
        </div>
    </div>
</div>

<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-1" style="padding:20px">
    </div>
    <div class="col-sm-10" style="padding:20px">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px"> 
                    <h1> Les Secteurs </h1>
                    
                    <div class="container">
                        <div class="panel-group" id="accordion">

                            <?php
                            $i = 0;
                            $nomSecteur = "";
                            $nbParligne = 4;
                            $Qte = 0;
                            foreach($lesSecteurs as $unSecteur):
                                //var_dump($unSecteur);
                                              
                                if(!empty($unSecteur['NOMSECTEUR'] && $unSecteur['PhotoProfil'] && $unSecteur['NOMACTEUR'] && $unSecteur['PRENOMACTEUR']))
                                {         
                                    
                                    if($unSecteur['NOMSECTEUR'] == $nomSecteur)
                                    {
                                        if($Qte == $nbParligne)
                                        {
                                            echo'</tr><tr>';
                                            $Qte = 1;
                                        }
                                        echo '<td>';
                                    
                                        echo '<div class="panel-body">'.img($unSecteur['PhotoProfil']);
                                        echo '</td>';
                                        echo '<td>';
                                            echo '<h5>'.$unSecteur['NOMACTEUR'].'</br></br>';
                                            echo $unSecteur['PRENOMACTEUR'].'</h5>';
                                        echo '</td>';

                                        $Qte ++;
                                       // echo '</div>';
                                    }
                                    else 
                                    {
                                        if($i!=0)
                                        {
                                                            echo '</tr>';
                                                        echo '</table>';
                                                    echo '</div>';
                                                echo '</div>';
                                            //echo '</div>';
                                        }
                                        echo '<div class="panel panel-default" style="border:black">';
                                            echo '<div class="panel-heading"style="background-color:#B64F53">';
                                                echo '<h4 class="panel-title">';
                                                echo '<a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'">'.$unSecteur['NOMSECTEUR'].'</a>';
                                                echo '</h4>';
                                            echo '</div>';
                                            echo '<div id="collapse'.$i.'" class="panel-collapse collapse">';
                                            echo '<table class="table" style="background-color:#15B7D1">';
                                                    echo '<tr>';
                                                        echo '<td>';
                                                            echo '<div class="panel-body" style="border:black">'.img($unSecteur['PhotoProfil']);
                                                        echo '</td>';
                                                        echo '<td>';
                                                            echo '<h5>'.$unSecteur['NOMACTEUR'].'</br></br>';
                                                            echo $unSecteur['PRENOMACTEUR'].'</h5>';    
                                                        echo '</td>';

                                        $Qte = 1;
                                    }  
                                }
                                $i++;

                                $nomSecteur = $unSecteur['NOMSECTEUR'];
                            endforeach ;
                            if($i!=0)
                            {
                                                echo '</tr>';
                                            echo '</table>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            }
                            //var_dump($lesSecteurs);
                            ?>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>
