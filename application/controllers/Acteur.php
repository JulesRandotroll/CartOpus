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
        
        //A RETIRER UNE FOIS LA CONNEXION OK
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
        
        //var_dump($Acteur); //=> sert à voir ce qui est contenu dans la variable (ici $Acteur)
        
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

    public function RedimensionnerPhoto($Image,$Source,$Destination,$ratio)
    {

        if(substr(strtolower($Source.$Image), (strlen($Source.$Image)-4),4)==".gif"){
        $src=imagecreatefromgif($Source.$Image);
        $ext = 'gif';
        }
        else if(substr(strtolower($Source.$Image), (strlen($Source.$Image)-4),4)==".png"){
        $src=imagecreatefrompng($Source.$Image);
        $ext = 'png';
        }
        else if(substr(strtolower($Source.$Image), (strlen($Source.$Image)-4),4)==".jpg" || substr(strtolower($Source.$Image), (strlen($Source.$Image)-5),5)==".jpeg"){
        $src=imagecreatefromjpeg($Source.$Image);
        $ext = 'jpg';
        }

        $size = getimagesize($Source.$Image);
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


}