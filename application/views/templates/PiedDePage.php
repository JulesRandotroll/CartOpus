
        <div class="row" style="background-color:#B64F53">
            <section>
                <div class = "section-inner"> 
                    <div class="col-sm-5" style="padding:20px">
                    <?php
                            if ($this->session->statut==1||$this->session->statut==2||$this->session->statut==3)
                            {
                                echo'<a href="'.site_url('Acteur/ContacterAdmin').'" style="color:#000000"><span class="glyphicon glyphicon-send"></span> Contacter Nous</a>';
                            }
                        ?>
                    </div>
                    <div class="col-sm-2" style="padding:20px">
                        <p><em>&copy; MJC du Plateau</em></p>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
