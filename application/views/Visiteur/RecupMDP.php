<html>
<body>
<div class = "text-center">
                <BR>
                <?php 
                    echo'<a href="'.site_url('Visiteur/SInscrire').'" class="btn btn-danger" > S\'inscrire</a>   ';
                    echo'<a href="'.site_url('Visiteur/SeConnecter').'" class="btn btn-danger" > Se connecter</a>';
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
            <H1 align = "center" style="color:#FFFFFF">Récupération du Mot de Passe</H1><BR>;
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php
                            echo('<table style="width:100%" border=0>');
                            echo form_open('visiteur/recupmdp');
                           
                            echo('<tr><td>');
                            echo ('Mail: '); // creation d'un label devant la zone de saisie
                            echo('</td><td>');
                            echo form_input('mail','',array('required'=>'required'));
                            echo('</td></tr>');

                            echo('<tr><td>');
                            echo ('Question Secrète: '); // creation d'un label devant la zone de saisie
                            echo('</td><td>');
                            echo form_dropdown('question', $Questions, 'default');
                            echo('</td></tr>');
                            echo('<tr><td>');
                            echo ('Reponse: '); 
                            echo('</td><td>');
                            echo form_input('reponse',$reponse,array('required'=>'required','pattern'=>'[A-Za-z0-9 ]{1,40}'));
                            echo('</td></tr>');
                            echo ($message);
                            echo('<tr><td>');
                            echo ("Par email :");
                            echo('</td><td>');
                            echo form_submit('recupmail', 'Envoyer');
                            echo('</td></tr>');

                            echo form_close();
                            echo('</table>');
                            echo '<a style="color:#FFFFFF" href="'.site_url('Visiteur/sInscrire').'">S\'inscrire ? </a>';
                       
                    ?>
                </div>
            </section>
            <br>
        </div> 
    </div> 
  
</div>
</body>
<html>