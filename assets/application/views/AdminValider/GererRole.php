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
<script src="<?php echo js_url('js_GererRole'); ?>"></script>


<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <?php 
            if(isset($Message))
            {
                echo '<div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Message</strong> '.$Message.'
            </div>';
            }
            elseif(isset($Attention))
            {
                echo '<div class="alert alert-warning alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Attention</strong> '.$Attention.'
            </div>';
            }
            elseif(isset($Danger))
            {
                echo '<div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Attention ! </strong> '.$Danger.'
            </div>';
            }
        ?>
    </div>
</div>
<div class="row" style="background-color:#15B7D1"> 
    <div class="col-sm-1">
    </div> 
    <div class="col-sm-5">
        <H1 style="color:#FFFFFF" class='text-center'>
            Ajouter un Rôle
        </H1>
        <section >
            <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                <?php 
                    echo form_open('AdminValider/AjouterRole')."<BR>";
                ?>
                <div class="form-group">
                    <?php
                        echo form_label('Nouveau role','newRole');
                        echo form_input('nouvRole', '', array('class'=>'form-control','placeholder'=>'Saisir le nouveau role','required'=>'required','pattern'=>'[a-zA-Z éèëïùàäüôîê]{1,64}','title'=>'Lettres et accents autorisés jusqu\'a 64 caractères'));
                    ?>
                </div>
                <div class="text-center"> 
                    <?php
                        echo form_submit('AjoutRole','Ajouter',array('class'=>'btn btn-danger'));
                    ?>
                </div>
                
                <?php    
                    echo form_close();
                ?>

            </div>
        </section>
        <BR>
    </div>
    
    <div class="col-sm-5">
        <H1 style="color:#FFFFFF" class='text-center'>
            Supprimer un Rôle
        </H1>
        <section >
            <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                <BR>
                <div class='form-group'>
                    <label> Rechercher : </label>
                    <input class="form-control" id="myInput" type="text" placeholder="Rechercher..">
                </div>
                <table class="table" id="myTable">
                    <tr>
                        <?php 

                            $i = 0;
                            $lim = 3;
                            foreach($Roles as $unRole)
                            {
                                if($i==$lim)
                                {
                                    echo'</tr><tr>';
                                    $i=0;
                                }
                                if($unRole['noRole']==0)
                                {
                                    echo '<td>
                                            <a href="#" data-toggle="popover" title="Non supprimable" data-content="Ce rôle ne peut être supprimé, car il s\'agit du rôle attribué à la personne qui met en ligne l\'action" data-trigger="hover" style="color:#CCCCB3">'
                                                .$unRole['nomRole'].'
                                            </a>
                                        </td>'
                                    ;
                                }
                                elseif($unRole['noRole']==1)
                                {
                                    //#CCCCB3
                                    echo '<td>
                                            <a href="#" data-toggle="popover" title="Non supprimable" data-content="Ce rôle ne peut être supprimé, car il s\'agit du rôle attribué par défaut à toute personne dont le rôle a été supprimé" data-trigger="hover" style="color:#CCCCB3">'
                                                .$unRole['nomRole'].'
                                            </a>
                                        </td>'
                                    ;
                                }
                                else
                                {
                                    echo '<td>
                                            <a href="#" class="supprrole'.$unRole['Attribue'].'" style="color:#FFFFFF" id="'.$unRole['noRole'].'">'
                                                .$unRole['nomRole'].'
                                            </a>
                                        </td>'
                                    ;
                                }
                                
                                $i++;
                            }
                            for($i;$i<$lim;$i++)
                            {
                                echo"<td></td>";
                            }
                        ?>
                    </tr>
                </table>
                <?php 
                    echo form_open('AdminValider/SupprimerRole', array("id"=>"form_supprRole"));
                    echo form_close();
                ?>
                <div class='text-right'>
                    <a href="#" class="btn btn-danger" data-toggle="popover" title="INFORMATIONS" data-content="Pour supprimer un rôle clickez dessus" data-trigger="hover"><span class="glyphicon glyphicon-info-sign"></span></a>
                </div>
            </div>
        </section>
        <BR>
    </div>
</div>