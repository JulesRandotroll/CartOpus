<ul class="nav navbar-nav navbar-right">

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6" style="padding:20px">
        <div style="padding:20px">
            <div class='text-center'>
                <H1 style="color:#FFFFFF">Finaliser l'Inscription</H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <H4>
                    <?php
                    echo form_open('Visiteur/Validation');
                    
                        echo validation_errors(); // mise en place de la validation
                        echo '<div class="row">';
                            echo '<div class="col-xs-3">';
                            echo '</div>';
                            echo '<div class="col-xs-6">';
                            echo '<div class="text-center">';
                                echo form_label('Veuillez consulter votre adresse mail pour finir votre inscription');
                                echo '</div>'; 
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-xs-10">';
                                echo '<a style="color:#FFFFFF" href="'.site_url('Visiteur/Validation').'">Renvoie du mail ?</a>';  
                            echo '</div>';
                            echo '<div class="col-xs-2">';
                            echo form_submit('annule', 'Annuler',array('class'=>'btn btn-danger'));
                                //echo '<a style="color:#FFFFFF" href="#" id="annule" name="annule">Annuler</a>';//'.site_url('Visiteur/loadAccueil').'
                            echo '</div>';
                        echo '</div>';
                        echo '<br>';
                        echo '<a style="color:#FFFFFF" id="affichmail">Afficher le mail: </a>';
                        echo form_label($mail,'mail',array('id'=>'affich'));
                      echo form_close();
                      
                        //var_dump($mail);
                   
                    ?>
                </H4>
                </div>
            <section>
        </div>
    </div>    
</div>

<script>
$(function()
{
    $("#affich").hide();
    
    $("#affichmail").on("click",function()
    {
        $("#affich").show();
    });
})


</script>