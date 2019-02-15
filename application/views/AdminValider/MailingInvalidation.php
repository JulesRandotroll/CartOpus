<ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo site_url('AdminValider/GererFilActu') ?>" style="color:#FFFFFF;"><span class="glyphicon glyphicon-star"></span> Gérer fil actualité</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('AdminValider/GererMotCles') ?>" style="color:#FFFFFF;"><span class="glyphicon glyphicon-list-alt"></span> Gerer Mots Cles</a> 
                        </li>
                        <li>
                            <a href="<?php echo site_url('AdminValider/GererRole') ?>" style="color:#FFFFFF"><span class="glyphicon glyphicon-briefcase"></span> Gerer rôles</a>
                        </li>';
                           






                        <li>
                            <a href="<?php echo site_url('Visiteur/SeDeconnecter'); ?>" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="row" style="background-color:#15B7D1"> 
    <div class="col-sm-2">
    </div> 
    <div class="col-sm-8">
        <div class = "text-center">
            <H1 align = "center" style="color:#FFFFFF">Invalider "<?php echo $nomAction; ?>"</H1><BR>
        </div>
        <section >
            <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                <?php 
                    echo form_open($path.$noAction);
                ?>
                <div class='form-group'>
                    <?php 
                        echo form_label('Mail : ','lblmail');
                        echo form_input('mail',$mail,array('class'=>'form-control','required'=>'required','disabled'=>'disabled'));
                    ?>
                </div>
                <div class='form-group'>
                    <?php 
                        // echo $objet;
                        echo form_label('Objet : ','lblobjet');
                        echo form_input('objet',$objet,array('class'=>'form-control','required'=>'required'));
                    ?>
                </div>
                <div class='form-group'>
                    <?php 
                        echo form_label('Message : ','lblmessage');
                        echo form_textarea('message','',array('class'=>'form-control','required'=>'required'));
                    ?>
                </div>
                <div class='text-center'>
                    <?php 
                        echo form_submit('Envoyer','Envoyer',array('class'=>'btn btn-danger'));
                    ?>
                </div>
                <?php
                    echo form_close();
                ?>
                <BR><BR>
                <div class='text-left'>
                    <a href="<?php echo site_url('AdminValider/AccueilAdminValider');?>" class="btn btn-danger"> Retour à l'accueil </a>                   
                </div>
            </div>
        </section>
        <br>
    </div>
</div>