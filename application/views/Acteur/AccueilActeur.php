                    <ul class="nav navbar-nav navbar-right">
                        <?php 
                            echo'<li><a href="'.site_url('Visiteur/SeConnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
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
                            $this->table->set_heading();
                            foreach($Action as $uneAction)
                            {

                            }
                        ?>
                </div>
            </section>
        </div>
    </div>
    
</div>