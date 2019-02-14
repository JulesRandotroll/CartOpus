                    <ul class="nav navbar-nav navbar-right">
                        <?php 
                            echo'<li><a href="'.site_url('Visiteur/SInscrire').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                           // echo'<li><a href="'.site_url('Visiteur/SeConnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>';
                        ?> 
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
            <H1 align = "center" style="color:#FFFFFF">Connexion</H1><BR>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <div class="form-inline">
                        <BR> <BR>    
                        <?php   
                            echo validation_errors(); // mise en place de la validation
                                /* set_value : en cas de non validation les données déjà
                                saisies sont réinjectées dans le formulaire */
                            
                            if ($message!="")
                            {
                            echo'<div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Attention</strong> '.$message.'
                                </div>';
                            }

                            echo form_open('Visiteur/seConnecter');
                            
                            echo '<div class="form-group">';
                            //echo ('Mail : '); // creation d'un label devant la zone de saisie
                            echo '<span style="color:#FF0000"/> * </span>';
                            echo form_label('Mail : ', 'Mail');
                            echo '   ';
                            echo form_input('mail','',array('required'=>'required','placeholder'=>'Ex :abc@exemple.com','class'=>'form-control'));
                            echo'</div> ';
                            echo '   ';

                            echo '<div class="form-group">';
                            //echo ('Mot de passe : ');
                            
                            echo '<span style="color:#FF0000"/> * </span>';
                            echo form_label('Mot De Passe : ', 'MDP');
                            echo '   ';
                            echo form_password('mdp','',array('required'=>'required','placeholder'=>'Votre mot de passe','class'=>'form-control'));
                            echo'</div> ';
                            
                            echo form_submit('submit', 'Se connecter',array('class'=>'btn btn-danger'));
                            
                            echo '<a style="color:#FFFFFF" href="'.site_url('Visiteur/RecupMDP').'">Mot de passe oublié ?</a>';
                            
                            echo form_close();
                           
                            echo '<br>';
                            echo '<a style="color:#FFFFFF" href="'.site_url('Visiteur/sInscrire').'">S\'inscrire ? </a>';
                            echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont requis</h6> ';
                        ?>
                    </div>
                </div>
            </section>
            <br>
        </div>
    </div>
</div>

