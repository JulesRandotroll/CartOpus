<?php 
    $noOrganisation = $_REQUEST['noOrganisation'];
    $nomSecteur = $_REQUEST['nomSecteur'];

    $cnx=mysqli_connect('localhost','root','','cartopus');
    //TEST DOUBLON
    //var_dump($nomSecteur);
    $reqSecteur=$cnx->query("SELECT nosecteur FROM secteur WHERE nomsecteur ='". $nomSecteur."'");

    while($resultatS=mysqli_fetch_array($reqSecteur))
	{
        echo 'ce secteur existe dans la table secteur<br>';
        //var_dump($resultatS);
        $cnx5=mysqli_connect('localhost','root','','cartopus');
        $reqPosseder=$cnx5->query("SELECT nosecteur FROM posseder WHERE nosecteur =".$resultatS[0]." AND no_organisation =". $noOrganisation);
        mysqli_close($cnx5);

        if (!$reqPosseder)
        {
            printf("Error: %s\n", mysqli_error($cnx5));
            exit();
        }

        while($resultatP=mysqli_fetch_array($reqPosseder))
        {
            //echo 'il y a un doublon dans secteur et posseder<br>';
            //var_dump($resultatP);
            $msgError='Ce secteur existe déjà dans cette organisation';
            echo $msgError;
            exit;
            //break 3;
        }
        //var_dump($resultatS);
        $noNewSecteur=$resultatS[0];

        //echo'j\'insere que dans posseder<br>';
        $cnx6=mysqli_connect('localhost','root','','cartopus');
        $InsertPosseder=$cnx6->query("INSERT INTO posseder(NO_ORGANISATION, NOSECTEUR) VALUES ('".$noOrganisation."','".$noNewSecteur."')");
        mysqli_close($cnx6);
        break 2;
    }   
    mysqli_close($cnx);
    //echo'j\'insere dans secteur et posseder<br>';
    //var_dump($nomSecteur);
    $cnx2=mysqli_connect('localhost','root','','cartopus');
    $InsertSecteur=$cnx2->query("INSERT INTO secteur(NOMSECTEUR) VALUES ('".$nomSecteur."')");
    mysqli_close($cnx2);

    $cnx3=mysqli_connect('localhost','root','','cartopus');
    $reqNoSecteur=$cnx3->query("SELECT nosecteur FROM secteur WHERE nomsecteur ='". $nomSecteur."'");
    mysqli_close($cnx3);

    while($resultatS=mysqli_fetch_array($reqNoSecteur))
	 {
        $noNewSecteur=$resultatS[0];
     }

    $cnx4=mysqli_connect('localhost','root','','cartopus');
    $InsertPosseder=$cnx4->query("INSERT INTO posseder(NO_ORGANISATION, NOSECTEUR) VALUES ('".$noOrganisation."','".$noNewSecteur."')");
    mysqli_close($cnx4);

?>