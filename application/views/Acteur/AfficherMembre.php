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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<!--<script src="<?php echo js_url('js_AfficherAction'); ?>"></script>-->
<script src="<?php echo js_url('js_supprMembre'); ?>"></script>

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
               
                        if (isset($message))
                        {
                           echo'<div class="alert alert-danger alert-dismissible">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                   <strong>Attention</strong> '.$message.'
                               </div>';
                        }

                        echo'<div class="table-responsive">';
                            $this->table->set_heading('Nom','Prenom','Mail','Responsable');
                            foreach($Membres as $unMembre)
                            {
                                if($this->session->statut==3)
                                {
                                    //var_dump($unMembre);
                                    if ($unMembre['NOPROFIL']==3)
                                    {
                                        if($unMembre['NOROLE']==0)
                                        {
                                            $cbx=form_checkbox('',$unMembre["NOACTEUR"], TRUE,array("class"=>"checkbox","disabled"=>"disabled"));
                                        }
                                        else
                                        {
                                            $cbx=form_checkbox('',$unMembre["NOACTEUR"], TRUE,array("class"=>"checkbox"));
                                        }
                                         
                                    }
                                    else
                                    {
                                        if($unMembre['NOROLE']==0)
                                        {
                                            $cbx=form_checkbox('',$unMembre["NOACTEUR"], FALSE,array("class"=>"checkbox","disabled"=>"disabled"));
                                        }
                                        else
                                        {
                                            $cbx=form_checkbox('', $unMembre["NOACTEUR"], FALSE,array("class"=>"checkbox"));
                                        }
                                        
                                    }
                                    $this->table->add_row($unMembre['NOMACTEUR'],$unMembre['PRENOMACTEUR'],$unMembre['MAIL'],$cbx,'<a href="'.site_url('Acteur/ModifierMembre/'.$unMembre['NOACTEUR'].'/'.$noAction).'" class="btn btn-danger" ><span class="glyphicon glyphicon-pencil"></a> <a href="#" class="btn btn-danger trash_Supprimer" id="'.$unMembre["NOACTEUR"].'" ><span class="glyphicon glyphicon-trash"></a>'); 
                                }
                                else
                                {
                                    //var_dump($unMembre['NOPROFIL']);
                                    if ($unMembre['NOPROFIL']==3)
                                    {
                                        $cbx=form_checkbox('',$unMembre["NOACTEUR"], TRUE,array("class"=>"checkbox","disabled"=>"disabled")); // 
                                    }
                                    else
                                    {
                                        $cbx=form_checkbox('', $unMembre["NOACTEUR"], FALSE,array("class"=>"checkbox","disabled"=>"disabled"));  
                                    }
                                    $this->table->add_row($unMembre['NOMACTEUR'],$unMembre['PRENOMACTEUR'],$unMembre['MAIL'],$cbx); 
                                }
                                
                            }
                            $Style = array('table_open' => '<table class="table" >');
                            $this->table->set_template($Style);
                            echo $this->table->generate();
                        echo'</div>'; 

                        echo '<div class="text-left">';
                            echo'<a href="'.site_url('Acteur/AfficherActionSelectionnee/'.$noAction).'" style="color:#000000"><button type="button" class="btn btn-danger">Retour</button> </a>';
                        echo '</div>';

                        echo form_open('Acteur/SupprimerMembre/'.$noAction.'',array("id"=>"form_suppr"));
                        echo form_close();
                        echo form_open('Acteur/ModifProfil/'.$noAction.'',array("id"=>"form_modifP"));
                        echo form_close();
                    ?>
                </div>
            </section>
        </div>
    </div>
    <?php 
        //var_dump($this->session->statut);
        if($this->session->statut==3)
        {
            echo"<div class='col-xs-2'>
                    <nav class='navbar' data-spy='affix'>
                        <ul class='nav nav-pills nav-stacked' style='background-color:#B64F53;border-radius:10px;'>
                            <li>
                            
                                <a href='".site_url('Acteur/AjoutMembre/'.$noAction)."' class='option' id='AjouterMembre'>
                                    <H4>
                                        <span class='glyphicon glyphicon-plus-sign' style='color:#FFFFFF'></span>
                                        <p id='txt_AjouterMembre' style='color:#FFFFFF'>Ajouter membre</p>
                                    </H4>
                                </a>
                            </li>
                            <li>
                                <a href='".site_url('Acteur/EnvoieMail/'.$noAction)."' class='option' id='EnvoieMail'>
                                    <H4>
                                        <span class='glyphicon glyphicon-envelope' style='color:#FFFFFF'></span>
                                        <p id='txt_EnvoieMail' style='color:#FFFFFF'>Envoie mail</p>
                                    </H4>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>";
        }
    ?>
  
</div>
</div>



