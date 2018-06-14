                <div class = "text-center">
                    <BR>
                    <?php 
                        echo'<a href="'.site_url('Visiteur/SeDeconnecter').'" class="btn btn-danger" > Se deconnecter</a>';
                    
                    ?>  
                </div>
            </div>
        </div>
    </section>
</div>

<div class="row" style="background-color:#15B7D1;padding:20px">
    <?php 
        var_dump($Acteur);
        var_dump($Organisation);
        var_dump($Action);
    ?>
    <div class="col-sm-5">
        <div class = "text-center">
            <section>
                <div class = "section-inner" style="padding:20px">
                <?php echo ($this->session->statut);?>
                </div>
            </section>
        </div>
    </div>
</div>