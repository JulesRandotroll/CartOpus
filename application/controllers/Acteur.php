<?php 

class Acteur extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('assets'); // helper 'assets' ajouté a Application
        $this->load->library("pagination");
        $this->load->library('email');
        $this->load->library('table');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->model('ModelActeur');
        $this->load->model('ModelAction');
        $this->load->library('upload');

      
        //A RETIRER UNE FOIS LA CONNEXION OK
        if ($this->session->statut==0)
        {
            redirect('Visiteur/loadAccueil');
        };
        //$this->session->noActeur = 1;
        // A RETIRER UNE FOIS LA CONNEXION OK

       //$this->load->model('ModeleArticle'); // chargement modèle, obligatoire
       //$this->load->model('ModeleUtilisateur');
    } // __construct

    public function AccueilActeur()
    {

        $noActeur = $this->session->noActeur;
        //On stocke dans une variable locale l'identifiant BDD de l'acteur connecté

        $Acteur = $this->ModelActeur->getActeur($noActeur);
        //On va chercher les information concernant l'acteur connecté dans la BDD 
        
       // var_dump($Acteur); //=> sert à voir ce qui est contenu dans la variable (ici $Acteur)
        
        $Organisation = $this->ModelActeur->getOrganisation($noActeur);
        //on va chercher les information concernant l'organisation à laquelle appartient l'acteur connecté
        //il se peut que cette variable soit "null", auquel cas il faut mettre une condition dans la view
        // pour ne pas tenter de l'afficher s'l n'y a rien de dedans ^^ 
        //echo 'orga : ';
        //var_dump($Organisation);
        $Action = $this->ModelActeur->getActions($noActeur);
        //Même topo que pour $Organisation
        //var_dump($Action);
        $Données = array(
            'Acteur'=>$Acteur[0],
            'Organisation'=> $Organisation,
            'Action'=> $Action,
        );
        $DonnéesTitre = array('TitreDeLaPage'=>$Acteur[0]['NOMACTEUR'].' '.$Acteur[0]['PRENOMACTEUR']);
        
        $this->load->view('templates/Entete',$DonnéesTitre);
        
        $this->load->view('Acteur/AccueilActeur',$Données);
        $this->load->view('templates/PiedDePage');

    }
    public function GestionProfil()
    {
        $noActeur = $this->session->noActeur;
        if ( $this->input->post('modif'))
        {
            $this->ModelActeur->UpdateActeur($Donnees,$noActeur);
        }
        //On stocke dans une variable locale l'identifiant BDD de l'acteur connecté

        $Acteur = $this->ModelActeur->getActeur($noActeur);
        //On va chercher les information concernant l'acteur connecté dans la BDD 
        $DonnéesTitre = array('TitreDeLaPage'=>'Gestion du compte');
        $this->load->model('ModelSInscrire'); // on charge le modele correspondant
        $question = $this->ModelSInscrire->QuestionSecrete();
        $i=0;
        foreach($question as $uneQuestion)
        {
          if(empty($Options))
          {
            $Options = array($uneQuestion['noQuestion']=>$uneQuestion['nomQuestion']);
          }
          else
          {
            $temporaire = array($uneQuestion['noQuestion']=>$uneQuestion['nomQuestion']);
            $Options = $Options + $temporaire;
          }
        }

        $DonneesAInjectees=array(
            'nom'=>'',
            'prenom'=>'',
            'mail'=>'',
            'tel'=>'',
            'message'=>'plop is good, plop is life',
            'Questions'=>$Options,
            'reponse'=>'',
            'Acteur'=>$Acteur,
        );
        //var_dump($DonneesAInjectees);
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Acteur/GestionProfil', $DonneesAInjectees);
        $this->load->view('templates/PiedDePage');
    }

    public function RedimensionnerPhoto($Image,$Source,$Destination,$ratio,$ext)
    {
        $src = $ext;
       // echo $src;
        if($src==".jpeg")
        {
            $src=imagecreatefromjpeg($Source.$Image);
            $ext = 'jpeg';
        }
        else if($src==".png")
        {
            $src=imagecreatefrompng($Source.$Image);
            $ext = 'png';
        }
        else if($src==".jpg")
        {
            $src=imagecreatefromjpeg($Source.$Image);
            $ext = 'jpg';
        }
        else
        {
            echo 'erreur';
        }

        //echo 'taille avant :';
        $size = getimagesize($Source.$Image);
        $largeur = $size[0];
        $hauteur = $size[1];
        //var_dump($size);
        if($largeur > $hauteur)
        {
            $newlargeur = $ratio;
            $newhauteur = round(($hauteur/$largeur)*$ratio);
        }
        else {
            $newlargeur = ($largeur/$hauteur)*$ratio;
            $newhauteur = $ratio;
        }
        // the document recommends you to use truecolor to get better result
        $imtn = imagecreatetruecolor( $newlargeur, $newhauteur );
  

        imagecopyresampled($imtn, $src, 0, 0, 0, 0, $newlargeur, $newhauteur, $largeur, $hauteur);
        //var_dump($Destination.$Image);
        if ($ext == 'jpg')
        {
            imagejpeg($imtn, $Destination.$Image);
        
        }
        else if ($ext == 'png' ) 
        {
            imagepng($imtn, $Destination.$Image);
        }
        else if ($ext == 'jpeg') {
            imagejpeg($imtn, $Destination.$Image);
       
        }
        return $Image;
    }

    public function AfficherActionSelectionnee($noAction,$dateDebut,$dateFin)
    {

        $DateFin = str_replace('%20',' ',$dateFin);
        $DateDebut=str_replace('%20',' ',$dateDebut);

        $Actions =$this->ModelAction->getSousAction($noAction,$DateDebut,$DateFin); 
        
        //var_dump($Actions);

        // $Doonnes = array('a.noaction'=>$noAction,'datedebut'=>$DateDebut,);
        // $Action = $this->ModelAction->getAction($Doonnes);
        //var_dump($Action);
        $Donnes = array('NOACTION'=>$noAction,'DATEHEURE'=>$DateDebut,);
        $Fichiers = $this->ModelAction->getFichersPourAction($Donnes,$DateFin);
        //var_dump($Fichiers);
        
        $Données = array(
            'Actions'=>$Actions,
            'Fichiers'=>$Fichiers,
        );

        $DonnéesTitre = array('TitreDeLaPage'=>$Actions[0]['NOMACTION']);
        
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Acteur/AfficherAction',$Données);
        $this->load->view('templates/PiedDePage');

    }

    public function GestionPhoto()
    {
        ?> 
        
        <form method="POST" action="GestionPhoto" enctype="multipart/form-data">
        <!-- On limite le fichier à 2Mo -->
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        Fichier : <input type="file" name="avatar">
        <input type="submit" name="envoyer" value="Envoyer le fichier">
        </form>
        <?php
        $noActeur = $this->session->noActeur;
        if(isset($_FILES['avatar']))
        { 
            //var_dump($_FILES);
            if (is_uploaded_file($_FILES['avatar']['tmp_name']))
            {
                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                // récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
                $extension = strrchr($_FILES['avatar']['name'], '.');

                //Ensuite on teste
                if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                {
                    $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
                }
                else
                {
                    echo 'Upload effectué avec succès !';

                    $temp=$this->ModelActeur->GetPhoto($noActeur);
                    //var_dump($temp);
                    $AnciennePhoto=$temp[0]['photoprofil'];
                    
                    $str=$_FILES['avatar']['tmp_name'].'\\';
                    $chaine=explode('\\',$str);
                    $Source=$chaine[0].'/'.$chaine[1].'/'.$chaine[2].'/';
                   // echo '<br>Source:';
                    //var_dump($Source);
                    $PhotoTempo=$chaine[3];
                    //echo 'phototempo: ';
                    //var_dump($PhotoTempo);
                 
                    $str=$_FILES['avatar']['type'];
                    $chaine=explode('/',$str);
                    //echo 'Extension:';
                    $ext='.'.$chaine[1];
                    //var_dump($ext);

                    $Destination='assets\images\\';
                    //echo 'Destination :';
                    //var_dump($Destination);
                    $ratio='150';
                    $Redimension=$this->RedimensionnerPhoto($PhotoTempo,$Source,$Destination,$ratio,$ext);

                    //echo 'photo redimensionnée :';
                    //var_dump($Redimension);
                    
                    $nomPhoto=$this->RenommerPhoto($Redimension);
                    //echo 'renommage: ';
                    //var_dump($nomPhoto);
             

                    $new=$nomPhoto.$ext;
                    //echo 'photo toute belle renommée: ';
                    //var_dump($new);

                    rename($Destination.$Redimension,$Destination.$new);
                    //var_dump(rename($Destination.$Redimension,$Destination.$new) );
                                
                    $this->ModelActeur->UpdatePhoto($AnciennePhoto,$nomPhoto.$ext,$noActeur);
                    //unlink($Destination.$PhotoTempo);
                   redirect('Acteur/AccueilActeur');
                }
               
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo 'Echec de l\'upload !';
            }
        }
               
    }
    
}
?>