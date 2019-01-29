<?php 
    $cnx=mysqli_connect('localhost','root','','cartopus');

    $msgRetour=
    '<div class="dropdown">'+
        '<button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" value="0">'+
            '<span id="Dropdown_Supprimer_Thematique">Selectionnez une sous-thématique</span>'+
            '<span class="caret"></span>'+
        '</button>'+
        '<ul class="dropdown-menu">'+
            '<input class="form-control myInput" type="text" placeholder="Recherche">'+
            '<li class="divider"></li>'
    ;

    $req=$cnx->query("SELECT t.nothematique, t.nomthematique FROM sousthematique s, thematique t WHERE s.noSousThematique = t.noThematique AND s.noThematique = "+$noThematique);
		
    while($res=mysqli_fetch_array($req))
	{
		$msgRetour = $msgRetour . "<option value=".$res["ca_id"].">".$res["ca_id"].'/ '.$res['ca_libelle']."</option>";
    }
    echo $msgRetour;


?>
