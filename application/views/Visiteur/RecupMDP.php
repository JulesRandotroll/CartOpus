                    <ul class="nav navbar-nav navbar-right">
                        <?php 
                            echo'<li><a href="'.site_url('Visiteur/SInscrire').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                            echo'<li><a href="'.site_url('Visiteur/SeConnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>';
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
        <H1 align = "center" style="color:#FFFFFF">Récupération du Mot de Passe</H1><BR>;
        <section >
            <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                <?php
                    echo form_open('visiteur/recupmdp');
                        
                    echo'<div class="form-group">';
                    echo '<span style="color:#FF0000"/> * </span>';
                    echo form_label('Mail : ', 'Mail');   // creation d'un label devant la zone de saisie
                    echo form_input('mail','',array('required'=>'required','placeholder'=>'Ex : abc@exemple.com','class'=>'form-control'));
                    echo '</div>';
                            
                    echo'<div class="form-group">';
                    echo '<span style="color:#FF0000"/> * </span>';
                    echo form_label('Question Secrète', 'Question');  // creation d'un label devant la zone de saisie
                    echo form_dropdown('question', $Questions, 'default',array('class'=>'form-control'));
                    echo '</div>';
                        
                    echo'<div class="form-group">';
                    echo '<span style="color:#FF0000"/> * </span>';
                    echo form_label('Reponse : ', 'Rep');
                    echo form_input('reponse',$reponse,array('required'=>'required','placeholder'=>'La réponse à votre question secrète','pattern'=>'[A-Za-z0-9 ]{1,40}','class'=>'form-control'));
                    echo '</div>';

                    echo ($message);

                    echo '<div class="text-center">';  
                    echo form_submit('recupmail', 'Envoyer par mail',array('class'=>'btn btn-danger'));
                    echo '</div>';
                    echo form_close();
                    
                    echo '<a style="color:#FFFFFF" href="'.site_url('Visiteur/sInscrire').'">S\'inscrire ? </a>';
                    echo '<br><h6><span style="color:#FF0000"/> *</span> Ces champs sont requis</h6> ';
                    
                ?>
            </div>
        </section>
        <br>        
    </div> 
</div>
