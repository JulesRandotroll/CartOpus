

<div class="row" style="background-color:#127991">
    
    <section>
        <div class = "section-inner"> 
            <div class="col-sm-2" style="padding:20px">
                <?php 
                    echo'<a href="'.site_url('Visiteur/loadAccueil').'">'.img('logoAccueil.png').'</a>';
                ?>
            </div>
            <div class="col-sm-7" style="padding:20px">
                <div class = "text-center">
                    <?php 
                        echo img('Banderole.png');
                    ?>
                </div>
            </div>
            <div class="col-sm-3" style="padding:20px">
                <div class = "text-center">
                <BR>
                <?php 
                    echo'<a href="'.site_url('Visiteur/loadAccueil').'" class="btn btn-danger" > S\'inscrire</a>   ';
                    echo'        <a href="'.site_url('Visiteur/loadAccueil').'" class="btn btn-danger" > Se connecter</a>';
                ?>  
                </div>
            </div>
        </div>
    </section>
</div>



