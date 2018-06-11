<html>
<body>
            <div class = "text-center">
                <BR>
                <?php 
                    echo'<a href="'.site_url('Visiteur/SInscrire').'" class="btn btn-danger" > S\'inscrire</a>   ';
                    //echo'<a href="'.site_url('Visiteur/SeConnecter').'" class="btn btn-danger" > Se connecter</a>';
                ?>  
                </div>
            </div>
        </div>
    </section>
</div>
<div class="row" style="background-color:#15B7D1"> 
    <div class="col-sm-2">
    </div> 
    <div class="col-sm-8">
        <div class = "text-center">
            <H1 align = "center" style="color:#FFFFFF">Connexion</H1><BR>;
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php   
                        echo validation_errors(); // mise en place de la validation
                                /* set_value : en cas de non validation les données déjà
                                saisies sont réinjectées dans le formulaire */
                            
<<<<<<< HEAD
                        echo form_open('Visiteur/seConnecter');
                        echo form_label('Mail : ','mail'); // creation d'un label devant la zone de saisie
                        echo form_input('mail','',array('required'=>'required'));
                        echo' ';
                        echo form_label('Mot de passe : ','mdp');
                        echo form_password('mdp','',array('required'=>'required'));
                        echo' ';
                        echo form_submit('submit', 'Se connecter');
                        echo' ';
                        echo '<a href="'.site_url('Visiteur/RecupMDP').'">Mot de passe oublié ?</a>';
                        echo form_close();
                        echo '<a href="'.site_url('Visiteur/sInscrire').'">S\'inscrire ? </a>';
                    ?>
                </div>
=======
                            echo form_open('Visiteur/seConnecter');
                            echo ('Mail : '); // creation d'un label devant la zone de saisie
                            echo form_input('mail','',array('required'=>'required'));
                            echo' ';
                            echo ('Mot de passe : ');
                            echo form_password('mdp','',array('required'=>'required'));
                            echo' ';
                            echo form_submit('submit', 'Se connecter');
                            echo' ';
                            echo '<a style="color:#FFFFFF" href="'.site_url('Visiteur/RecupMDP').'">Mot de passe oublié ?</a>';
                            echo form_close();

                            echo '<a style="color:#FFFFFF" href="'.site_url('Visiteur/sInscrire').'">S\'inscrire ? </a>';
                        
                        ?>
                    </div>
>>>>>>> 40c35538a0f53311c66934c0c261e477a25f1e07
            </section>
            <br>
        </div>
    </div>
</div>

