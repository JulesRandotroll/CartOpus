 
<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6" style="padding:20px">
        <div style="padding:20px">
            <div class = "text-center">
                <H1 style="color:#FFFFFF">Affecter un profil à un utilisateur</H1>
            </div>
            <section id='Mod'>
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php 
                        echo 
                        form_open('SuperAdmin/ModifierProfil');
                        
                        //var_dump($Acteur);
                        foreach($Profils as $unProfil)
                        {
                            if($unProfil['NOPROFIL'] != 0 && $unProfil['NOPROFIL'] != 2 && $unProfil['NOPROFIL'] != 3)
                            {
                                if(empty($Options))
                                {
                                    $Options = array($unProfil['NOPROFIL'] => $unProfil['NOMPROFIL']);
                                }
                                else
                                {
                                    $temporaire = array($unProfil['NOPROFIL'] => $unProfil['NOMPROFIL']);
                                    $Options = $Options + $temporaire;   
                                }
                            }
                                
                        }
                        
                        echo '<div class="form-group">';
                        
                        echo form_hidden('noActeur', $Acteur['NOACTEUR']);
                        
                        echo form_label($Acteur['NOMACTEUR'].' '.$Acteur['PRENOMACTEUR'],'username');
                     
                        echo form_dropdown('Profil', $Options, $Acteur['NOPROFIL'],array('class'=>'form-control'));
                        
                        echo '</div>';   
                    
                        echo form_submit('Modifier', 'Modifier',array('class'=>'btn btn-danger pull-right'));

                    ?>
                    <BR>
                </div>
            </section>
        </div>
    </div>
</div>            