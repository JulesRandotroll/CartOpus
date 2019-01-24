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
                                                            echo '<div class="panel-body">'.img($unSecteur['PhotoProfil']);
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
