<html>
<body>
<div class = "text-center">
                <BR>
                <?php 
                    echo'<a href="'.site_url('Visiteur/SInscrire').'" class="btn btn-danger" > S\'inscrire</a>   ';
                    echo'<a href="'.site_url('Visiteur/loadAccueil').'" class="btn btn-danger" > Se connecter</a>';
                ?>  
                </div>
            </div>
        </div>
    </section>
</div>
<?php echo ("Récupération du Mot de Passe") ?>
<?php
echo'<br>';
echo form_open('visiteur/recupmdp');
echo form_label('Mail: ','mail'); // creation d'un label devant la zone de saisie
echo form_input('mail','',array('required'=>'required'));

echo ("Par email :");
echo form_submit('recupmail', 'Envoyer');
echo'<br>';
p
echo '<a href="'.site_url('Visiteur/sInscrire').'">S\'inscrire ? </a>';
echo form_close();
?>
</body>
<html>