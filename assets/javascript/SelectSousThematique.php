<?php 
    $cnx=mysqli_connect('localhost','root','','cartopus');


    $noThematique = $_REQUEST['noThematique'];

    //echo $noThematique.'<BR>';
    

    $msgEntete='<input class="form-control myInput" type="text" placeholder="Recherche"><li class="divider"></li>';
    echo $msgEntete;

    $req=$cnx->query("SELECT t.nothematique, t.nomthematique FROM sousthematique s, thematique t WHERE s.noSousThematique = t.noThematique AND s.noThematique =". $noThematique);
        
    
    
    while($res=mysqli_fetch_array($req))
	{
        if(isset($msgRetour))
        {
            $msgRetour = $msgRetour . "<li class='delier_uneSousThematique' value=".$res['nothematique']."><a>".$res['nomthematique']."</a></li>";
        }
        else
        {
            $msgRetour =  "<li class='delier_uneSousThematique' value=".$res['nothematique']."><a>".$res['nomthematique']."</a></li>";
        }
		
    }

    //echo $msgRetour;

    //var_dump($msgRetour);
    if(isset($msgRetour))
    {
        echo $msgRetour;
    }
    else
    {

        echo '<li class="delier_uneSousThematique" value="0"><a>Aucune Sous Thematique</a></li>' ;
    }
    //return $msgRetour;

    mysqli_close($cnx);

?>
