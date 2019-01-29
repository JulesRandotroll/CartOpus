                    <ul class="nav navbar-nav navbar-right ">
                        <?php 
                            if ($this->session->nbaction==0)
                            {
                                echo '<li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>';
                                echo'<li><a href="'.site_url('Acteur/GestionProfil').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-cog"></span> Compte</a></li>';
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                            }
                            else
                            {
                                echo '<li class="dropdown">
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
                                echo'<li><a href="'.site_url('Acteur/GestionProfil').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-cog"></span> Compte</a></li>';
                                echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                            }    
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>


<?php 

    $tailleDescription = 250;

?>

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
                            echo $Acteur['PRENOMACTEUR'].'<BR><BR>';
                            if($Acteur['NoTelVisible'] == 0)
                            {
                                echo '<div style="color:#ccccb3" data-toggle="popover" title="LE NUMERO DE TELPHONE EST NON VISIBLE PAR TOUS LE MONDE" data-trigger="hover" data-content="LE NUMERO DE TELPHONE EST NON VISIBLE PAR TOUS LE MONDE">'.$Acteur['NOTEL'].'</div>';
                            }
                            else 
                            {
                                echo '<div style="color:#000000" data-toggle="popover" title="LE NUMERO DE TELPHONE EST VISIBLE PAR TOUS LE MONDE" data-trigger="hover" data-content="LE NUMERO DE TELPHONE EST VISIBLE PAR TOUS LE MONDE">'.$Acteur['NOTEL'].'</div>';
                            }
                            if($Acteur['MailVisible'] == 0)
                            {
                                echo '<div style="color:#ccccb3" data-toggle="popover" title="LE MAIL EST NON VISIBLE PAR TOUS LE MONDE" data-trigger="hover" data-content="LE MAIL EST NON VISIBLE PAR TOUS LE MONDE">'.$Acteur['MAIL'].'</div><BR>';
                            }
                            else 
                            {
                                echo '<div style="color:#000000" data-toggle="popover" title="LE MAIL EST VISIBLE PAR TOUS LE MONDE" data-trigger="hover" data-content="LE MAIL EST VISIBLE PAR TOUS LE MONDE">'.$Acteur['MAIL'].'</div><BR>';
                            }

                            echo '</td></tr>
                            <tr><td colspan="2">';

                            echo '<script>
                            $(document).ready(function(){
                            $("[data-toggle="popover"]").popover(); 
                            });
                            </script>';

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
                            // if ($message!="")
                            // {
                            // echo'<div class="alert alert-danger alert-dismissible">
                            // <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            //         <strong>Attention</strong> '.$message.'
                            //     </div>';
                            // }
                            echo'<div class="table-responsive">';
                            $this->table->set_heading('Nom','Rôle de '.$Acteur['NOMACTEUR'].' '.$Acteur['PRENOMACTEUR'],'Site Internet','Date de debut','Description','');
                            //var_dump($Action);
                            if($Action != null)
                            {
                                foreach($Action as $uneAction)
                                {
                                    if($uneAction['DATEFIN']==null){$uneAction['DATEFIN']=0;}

                                    if(strlen($uneAction['Description'])>$tailleDescription)
                                    {
                                        $Description = substr($uneAction['Description'],0,$tailleDescription).' [...]';
                                    }
                                    else
                                    {
                                        $Description = $uneAction['Description'];
                                    }


                                    if(empty($uneAction['SiteURLAction']))
                                    {
                                        $this->table->add_row($uneAction['NOMACTION'],$uneAction['NOMROLE'],$uneAction['SiteURLAction'],$uneAction['DATEDEBUT'],$Description,'<a href="'.site_url('Acteur/AfficherActionSelectionnee/'.($uneAction['NOACTION'])).'" class="btn btn-danger" >Accès</a><br><br><a href="'.site_url('Acteur/AjoutMembre/'.($uneAction['NOACTION']).'/'.($uneAction['DATEDEBUT']).'/'.($uneAction['DATEFIN'])).'" class="btn btn-danger" >Ajouter Membre à l\'équipe</a>');  
                                    }
                                    else
                                    {
                                        $this->table->add_row($uneAction['NOMACTION'],$uneAction['NOMROLE'],'<a href="'.$uneAction['SiteURLAction'].'" style="color:FFFFFF">Cliquer Ici</a>',$uneAction['DATEDEBUT'],$Description,'<a href="'.site_url('Acteur/AfficherActionSelectionnee/'.($uneAction['NOACTION'])).'" class="btn btn-danger" >Accès</a><br><br><a href="'.site_url('Acteur/AjoutMembre/'.($uneAction['NOACTION']).'/'.($uneAction['DATEDEBUT']).'/'.($uneAction['DATEFIN'])).'" class="btn btn-danger" >Ajouter Membre à l\'équipe</a>');
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