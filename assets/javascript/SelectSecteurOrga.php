<?php 
    $cnx=mysqli_connect('localhost','root','','cartopus');

    $noOrganisation = $_REQUEST['noOrganisation'];

    //echo $noThematique.'<BR>';
    
    $req=$cnx->query("SELECT s.nosecteur, s.nomsecteur FROM secteur s, posseder p WHERE s.nosecteur = p.nosecteur AND p.no_organisation =". $noOrganisation);
    
    while($resultat=mysqli_fetch_array($req))
	{
        if(isset($msgRetour))
        {
            $msgRetour = $msgRetour . "<li class='secteur' value=".$resultat['nosecteur']."><a>".$resultat['nomsecteur']."</a></li>";
        }
        else
        {
            $msgRetour =  "<li class='secteur' value=".$resultat['nosecteur']."><a>".$resultat['nomsecteur']."</a></li>";
        }
		
    }

    //echo $msgRetour;

    //var_dump($msgRetour);
    if(isset($msgRetour))
    {
        echo $msgRetour;
    }
     echo '<li><a href="AjoutSecteur">Ajouter un Secteur</a></li>' ;
    //return $msgRetour;
    mysqli_close($cnx);

?>