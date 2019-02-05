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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="<?php echo js_url('js_GererMotCles'); ?>"></script>



<div class="row" style="background-color:#15B7D1" id='modif'> 
    <div class="col-sm-2">
    </div> 
    <div class="col-sm-8">
        <section >
            <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                <H1 style="color:#FFFFFF" class="text-center">Suppression des Mots-Cles</H1>

                <div class='form-group'>
                    <label> Rechercher : </label>
                    <input class="form-control" id="myInput" type="text" placeholder="Rechercher..">
                </div>
                <table class="table" id="myTable">
                    <tr>
                        <?php 
                            // var_dump($motsCles);
                            $i = 0;
                            $lim = 5;
                            foreach($motsCles as $unMotCle)
                            {
                                if($i==$lim)
                                {
                                    echo'</tr><tr>';
                                    $i=0;
                                }

                                echo '<td><a class="supprMotCle" value="#" style="color:#FFFFFF" id="'.$unMotCle['MotCle'].'">'.$unMotCle['MotCle'].'</a></td>';
                                $i++;
                            }
                            //var_dump($i);
                            for($i;$i<$lim;$i++)
                            {
                                echo"<td></td>";
                            }
                        ?>
                    </tr>
                </table>
                <?php 
                    echo form_open('AdminValider/SupprimerMotCle',array("id"=>"form_supprMotcle")); 
                    echo form_close();
                ?>
                    <div class='text-right'>
                        <a href="#" class="btn btn-danger" data-toggle="popover" title="INFORMATIONS" data-content="Pour supprimer un Mot-Clé clickez dessus" data-trigger="hover"><span class="glyphicon glyphicon-info-sign"></span></a>
                    </div>
            </div>
        </section>
        <BR>
    </div>
</div>