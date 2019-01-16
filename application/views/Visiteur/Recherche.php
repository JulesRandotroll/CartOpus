<?php
if(!empty($lesActions))
{
?>
    <div class="row" style="background-color:#15B7D1">
        <div class="col-sm-2" style="padding:20px">
        </div>
        <div class="col-sm-8" style="padding:20px">
            <div class = "text-center">
                <section >
                    <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                        <H1 style="color:#FFFFFF">Les Actions</H1>
                        <table class='table'>
                            <tr>
                                <th>Nom Action</th>
                                <th>Public Cible</th>
                                <th>Site URL</th>
                            </tr>
                            <?php
                                foreach ($lesActions As $uneAction):
                                    echo '<tr>';
                                    echo '<td><h4>'.$uneAction['NOMACTION'].'</h4></td>';
                                    echo '<td><h4>'.$uneAction['PublicCible'].'</h4></td>';
                                    echo '<td><h4>'.$uneAction['SiteURLAction'].' </h4></td>';
                                    echo '</tr>';
                                endforeach ;
                            ?>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php 
};

if(!empty($lesActeurs))  
{
?>
<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-4" style="padding:20px">
    </div>
    <div class="col-sm-4" style="padding:20px">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <H1 style="color:#FFFFFF">Les Acteurs</H1>
                    <table class='table'>
                        <tr>
                            <th></th>
                            <th>Nom Acteur</th>
                        </tr>
                        <?php
                            foreach ($lesActeurs As $unActeur):
                                echo '<tr>';
                                echo '<td><img src="'.img_url($unActeur['PhotoProfil']).'"></td>';
                                echo '<td><h4>'.$unActeur['NOMACTEUR'].'</h4>';
                                echo '<h5>'.$unActeur['PRENOMACTEUR'].'</h5></td>';
                                echo '</tr>';
                            endforeach ;
                        ?>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>

<?php 
}

if(!empty($lesOrganisations))
{
?>
    <div class="row" style="background-color:#15B7D1">
        <div class="col-sm-1" style="padding:20px">
        </div>
        <div class="col-sm-10" style="padding:20px">
            <div class = "text-center">
                <section >
                    <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                        <H1 style="color:#FFFFFF">Les Organisations</H1>    
                        <table class='table'>
                            <tr>
                                <th>Nom Organisation</th>
                                <th>Numéro de Téléphone</th>
                                <th>Numéro de Fax</th>
                                <th>Site URL</th>
                            </tr>
                            <?php        
                                foreach ($lesOrganisations As $uneOrganisation):
                                    echo '<tr>';
                                    echo '<td><h4>'.$uneOrganisation['NOMORGANISATION'].'</h4></td>';
                                    echo '<td><h4>'.$uneOrganisation['NOTELORGA'].'</h4></td>';
                                    echo '<td><h4>'.$uneOrganisation['NOFAXORGA'].'</h4></td>';
                                    echo '<td><h4>'.$uneOrganisation['SITEURL'].'</h4></td>';
                                    echo '</tr>';
                                endforeach ;
                            ?>
                        </table>
                        
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php
}
?>