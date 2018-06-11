<html>
<body>
<div class = "text-center">
                <BR>
                <?php 
                    //echo'<a href="'.site_url('Visiteur/SInscrire').'" class="btn btn-danger" > S\'inscrire</a>   ';
                    echo'<a href="'.site_url('Visiteur/loadAccueil').'" class="btn btn-danger" > Se connecter</a>';
                ?>  
                </div>
            </div>
        </div>
    </section>
</div>
<h2><?php echo ('Inscription') ?></h2>

<?php

echo validation_errors(); // mise en place de la validation

echo form_open('visiteur/sInscrire');

echo('<table>');
echo('<tr><td>');
echo('Nom: ');
echo('</td><td>');
echo form_input('nom',$nom,array('required'=>'required','pattern'=>'[a-zA-Z]{1,40}')); 
echo('</td></tr>');


echo('<tr><td>');
echo ('Prénom: ');
echo('</td><td>');
echo form_input('prenom',$prenom,array('pattern'=>'[a-zA-Z]{1,20}')); 
echo('</td></tr>');

echo('<tr><td>');
echo ('Email d\'identification: '); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_input('mail',$mail,array('required'=>'required','pattern'=>'[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})'));
echo('</td></tr>');

echo('<tr><td>');
echo ('Téléphone du responsable: '); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_input('tel',$tel,array('pattern'=>'[0-9]{10}'));
echo('</td></tr>');

echo('<tr><td>');
echo ('Mot de Passe: '); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_password('mdp','',array('required'=>'required')).$message;
echo('</td></tr>');

echo('<tr><td>');
echo ('Confirmation du mot de passe: '); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_password('confmdp','',array('required'=>'required'));// VERIF si confirme == mdp
echo('</td></tr>');

echo('</table>');
echo ('</br></br>');

echo form_submit('valider', 'Valider l\'inscription');

//echo form_submit('retour', 'Retour');
echo form_close();
?>


</body>
<html>