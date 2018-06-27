                    <ul class="nav navbar-nav navbar-right">
                        <?php 
                        echo'<li><a href="'.site_url('Acteur/ContacterAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-send"></span> Contacter Nous</a></li>';
                        echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                            
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
        // var_dump($Organisation);
        //var_dump($Action);
        //var_dump($_FILES);
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
                    <?php 
                    echo'<a href="'.site_url('Acteur/GestionProfil').'" style="color:#000000"><span class="glyphicon glyphicon-wrench"></span> Modifier</a>';
                   ?>
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
                                    if($uneAction['DATEFIN']==null){$uneAction['DATEFIN']=0;}
                                    if(empty($uneAction['SiteURLAction']))
                                    {
                                        $this->table->add_row($uneAction['NOMACTION'],$uneAction['NOMROLE'],$uneAction['SiteURLAction'],$uneAction['DATEDEBUT'],$uneAction['Description'],'<a href="'.site_url('Acteur/AfficherActionSelectionnee/'.($uneAction['NOACTION']).'/'.($uneAction['DATEDEBUT']).'/'.($uneAction['DATEFIN'])).'" class="btn btn-danger" >Accès</a>');  
                                    }
                                    else
                                    {
                                        $this->table->add_row($uneAction['NOMACTION'],$uneAction['NOMROLE'],'<a href="'.$uneAction['SiteURLAction'].'" style="color:FFFFFF">Cliquer Ici</a>',$uneAction['DATEDEBUT'],$uneAction['Description'],'<a href="'.site_url('Acteur/AfficherActionSelectionnee/'.($uneAction['NOACTION']).'/'.($uneAction['DATEDEBUT']).'/'.($uneAction['DATEFIN'])).'" class="btn btn-danger" >Accès</a>');
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