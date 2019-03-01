
        <div class="row" style="background-color:#B64F53">
            <section>
                <div class = "section-inner"> 
                    <div class="col-sm-2" style="padding:20px">
                    <?php
                            if ($this->session->statut==1||$this->session->statut==2||$this->session->statut==3)
                            {
                                echo'<a href="'.site_url('Acteur/ContacterAdmin').'" style="color:#000000"><span class="glyphicon glyphicon-send"></span> Contacter Nous</a>';
                            }
                        ?>
                    </div>
                    <div class="col-sm-8 text-center" style="padding:20px">
                        <p><em>&copy; MJC du Plateau</em></p>
                        <p>Site réalisé par GELIN Déborah, GOREGUES--CARMONA Jules et VOYER Jade, élèves de BTS SIO au Lycée François Rabelais à Saint Brieuc sous la supervision de CHEVALIER Léandre à la MJC du Plateau.</p>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
