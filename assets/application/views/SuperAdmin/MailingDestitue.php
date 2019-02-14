<ul class="nav navbar-nav navbar-right">
                        <?php 
                            echo'<li><a href="'.site_url('SuperAdmin/AccueilSuperAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> Page Perso</a></li>';
                            echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>


<div class='row' style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
        <div style="padding:20px">
            <section>
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php 
                        echo form_open('SuperAdmin/MailDebouter/'.$No);

                        echo'<div class="form-group ">'
                                .form_label('Mail : ', 'lbl_mail')
                                .form_input('mail',$Mail,array('class'=>'form-control','disabled'=>'disabled')) 
                            .'</div>'
                        ;

                        echo '<div class="form-group ">'
                                .form_label('Objet : ', 'lbl_objet')
                                .form_input('objet','Vous avez été destitué de vos droits en tant qu\'acteur ',array('class'=>'form-control',)) 
                            .'</div>'
                        ;

                        echo '<div class="form-group ">'
                                .form_label('Objet : ', 'lbl_objet')
                                .
                                form_textarea('Message',$proposition, array('class'=>'form-control','PLaceHolder'=>'Saisissez votre mail','required'=>'required'))
                            .'</div>'
                        ;

                        echo form_submit('Envoyer','Envoyer',array('class'=>'btn btn-danger btn-lg'));

                        echo form_close();
                    ?>
                </div>
            </section>
        </div>
    </div>
</div>