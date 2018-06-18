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

        $this->load->library('image_lib');
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
        
        if ( $this->input->post('modif'))
        {
            $this->ModelActeur->UpdateActeur($Donnees,$noActeur);
        }

        $noActeur = $this->session->noActeur;
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

    public function RedimensionnerPhoto($Image,$Source,$Destination,$ratio)
    {

        if(substr(strtolower($Source.'\\'.$Image), (strlen($Source.'\\'.$Image)-4),4)==".gif"){
        $src=imagecreatefromgif($Source.'\\'.$Image);
        $ext = 'gif';
        }
        else if(substr(strtolower($Source.'\\'.$Image), (strlen($Source.'\\'.$Image)-4),4)==".png"){
        $src=imagecreatefrompng($Source.'\\'.$Image);
        $ext = 'png';
        }
        else if(substr(strtolower($Source.'\\'.$Image), (strlen($Source.'\\'.$Image)-4),4)==".jpg" || substr(strtolower($Source.'\\'.$Image), (strlen($Source.'\\'.$Image)-5),5)==".jpeg"){
        $src=imagecreatefromjpeg($Source.'\\'.$Image);
        $ext = 'jpg';
        }
        // echo'image';
        // var_dump($Image);
        // echo'source';
        // var_dump($Source);
        // echo'destination';
        // var_dump($Destination);
        // echo'ratio';
        // var_dump($ratio);
        $size = getimagesize($Source.'\\'.$Image);
        
        $largeur = $size[0];
        $hauteur = $size[1];

        if($largeur > $hauteur){
                  $newlargeur = $ratio;
                  $newhauteur = round(($hauteur/$largeur)*$ratio);
        }
        else {
                  $newlargeur = ($largeur/$hauteur)*$ratio;
                  $newhauteur = $ratio;
        }
        
        // the document recommends you to use truecolor to get better result
        $imtn = imagecreatetruecolor( $newlargeur, $newhauteur );
        // if the image has transparent color, we first extract the RGB value of it,
        // then use this color to fill the thumbnail image as the background. This color
        // is safe to be assigned as the new transparent color later on because it will
        // be filtered by imagecopyresize.
        $originaltransparentcolor = imagecolortransparent( $src );
        if(
            $originaltransparentcolor >= 0 // -1 for opaque image
            && $originaltransparentcolor < imagecolorstotal( $src )
            // for animated GIF, imagecolortransparent will return a color index larger
            // than total colors, in this case the image is treated as opaque ( actually
            // it is opaque )
        ) {
            $transparentcolor = imagecolorsforindex( $src, $originaltransparentcolor );
            $newtransparentcolor = imagecolorallocate(
                $imtn,
                $transparentcolor['red'],
                $transparentcolor['green'],
                $transparentcolor['blue']
            );
            // for true color image, we must fill the background manually
            imagefill( $imtn, 0, 0, $newtransparentcolor );
            // assign the transparent color in the thumbnail image
            imagecolortransparent( $imtn, $newtransparentcolor );
        }

        imagecopyresampled($imtn, $src, 0, 0, 0, 0, $newlargeur, $newhauteur, $largeur, $hauteur);
        if ($ext == 'jpg')
        {
                  imagejpeg($imtn, $Destination.$Image);
        }else if ($ext == 'png' ) {
                  imagepng($imtn, $Destination.$Image);
        } else if ($ext == 'gif') {
                  imagegif($imtn, $Destination.$Image);
        }

    }

    public function AfficherActionSelectionnee($noAction,$dateDebut)
    {
        var_dump($noAction);
        var_dump($dateDebut);
        //str_split($dateDebut,'$20%');
        $DateDebut=str_replace('%20',' ',$dateDebut);

        $Doonnes = array('a.noaction'=>$noAction,'datedebut'=>$DateDebut,);
        $Action = $this->ModelAction->getAction($Doonnes);
        var_dump($Action);

        $DonnéesTitre = array('TitreDeLaPage'=>$Action[0]['NOMACTION']);
        
        
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Acteur/AfficherAction');
        $this->load->view('templates/PiedDePage');

    }

    public function GestionPhoto()
    {
        ?> 
        
        <form method="POST" action="GestionPhoto" enctype="multipart/form-data">
        <!-- On limite le fichier à 100Ko -->
        <input type="hidden" name="MAX_FILE_SIZE" value="100000">
        Fichier : <input type="file" name="avatar">
        <input type="submit" name="envoyer" value="Envoyer le fichier">
        </form>
        <?php
        $noActeur = $this->session->noActeur;
       // var_dump($noActeur);
      //var_dump($_FILES);
        if(isset($_FILES['avatar']))
        { 
           // $dossier = 'upload/';
            $fichier = basename($_FILES['avatar']['name']);
         // var_dump($fichier);
            //var_dump($_FILES);
            if (is_uploaded_file($_FILES['avatar']['tmp_name']))
            //if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                // récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
                $extension = strrchr($_FILES['avatar']['name'], '.');
                //Ensuite on teste
                //var_dump($extension);
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
                    $NewPhoto=$fichier;
                    $Source='D:\Mes Documents\Mes Images\photo music';
                    $Destination='assets\images\\';
                    $ratio='150';
                    $this->RedimensionnerPhoto($NewPhoto,$Source,$Destination,$ratio);
                    $this->ModelActeur->UpdatePhoto($AnciennePhoto,$NewPhoto,$noActeur);
                    redirect('Acteur/AccueilActeur');
                }
               
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo 'Echec de l\'upload !';
            }
        }
       
        //$data = array('upload_data' => $this->upload->data());
       // $this->load->view('Visiteur/loadAccueil', $data);
   
        
    }
}
?>