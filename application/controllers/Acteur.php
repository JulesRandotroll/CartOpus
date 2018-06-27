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

        $this->session->statut = 1;
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
            $DonneesAModifier=array
            (
                'nom'=>$this->input->post('nom'),
                'prenom'=>$this->input->post('prenom'),
                'mail'=>$this->input->post('mail'),
                'notel'=>$this->input->post('notel'),
                'noquestion'=>$this->input->post('Question'),
                'reponse'=>$this->input->post('reponse'),
                'message'=>'plop is good plop is life',
            );
            // var_dump( $DonneesAModifier['noquestion']);
            // var_dump($DonneesAModifier);
            $this->ModelActeur->UpdateActeur($DonneesAModifier,$noActeur);
        }
        else
        {
            //$Acteur = $this->ModelActeur->getActeur($noActeur);
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

            $Acteur=$this->ModelActeur->getActeur($noActeur);
            //var_dump($Acteur);

            $DonneesAInjectees=array
            (
                'nom'=>$Acteur[0]['NOMACTEUR'],
                'prenom'=>$Acteur[0]['PRENOMACTEUR'],
                'mail'=>$Acteur[0]['MAIL'],
                'notel'=>$Acteur[0]['NOTEL'],
                'Question'=>$Options,
                'noQuestion'=>$Acteur[0]['noQuestion'],
                'reponse'=>$Acteur[0]['Reponse'],
                'message'=>'plop is good plop is life',
                'Acteur'=>$Acteur,
            );
            //var_dump($DonneesAInjectees);
        
            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('Acteur/GestionProfil', $DonneesAInjectees);
            $this->load->view('templates/PiedDePage');
        }

        
    }

    public function ModifierMDP()
    {   
        $noActeur = $this->session->noActeur;
        if ( $this->input->post('modif'))
        {
            $mdpBDD= $this->ModelActeur-> getActeur($noActeur);
            //var_dump($mdpBDD['0']['MOTDEPASSE']);
            if ($mdpBDD['0']['MOTDEPASSE']==$this->input->post('motdepasse')) 
            {
            // si mdp == mdp deja rentrer dans la bdd
                var_dump($this->input->post('newmotdepasse'));
                var_dump($this->input->post('confmdp'));
                
                if ($this->input->post('newmotdepasse')==$this->input->post('confmdp'))
                {
                    $Donnees=$this->input->post('newmotdepasse');
                    $this->ModelActeur->UpdateMDP($Donnees,$noActeur);
                    redirect ('Acteur/AccueilActeur');
                } 
                else
                {
                    $DonneesAInjectees=array
                    (
                        'message'=>'La confirmation de mot de passe n\'est pas semblable au nouveau mot de passe.',
                    );

                    $DonnéesTitre = array('TitreDeLaPage'=>'Modification du mot de passe');
                    $this->load->view('templates/Entete',$DonnéesTitre);
                    $this->load->view('Acteur/ModifierMDP',$DonneesAInjectees);
                    $this->load->view('templates/PiedDePage');      
                }
            }
            else
            {
                $DonneesAInjectees=array
                    (
                        'message'=>'Le mot de passe rentré ne vous ai pas attribué.',
                    );

                $DonnéesTitre = array('TitreDeLaPage'=>'Modification du mot de passe');
                $this->load->view('templates/Entete',$DonnéesTitre);
                $this->load->view('Acteur/ModifierMDP',$DonneesAInjectees);
                $this->load->view('templates/PiedDePage');      
            }  
           
        }
        else
        {
        $DonnéesTitre = array('TitreDeLaPage'=>'Modification du mot de passe');
        $message=array(
            'message'=>'',
        );
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Acteur/ModifierMDP',$message);
        $this->load->view('templates/PiedDePage');
        }
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
         //var_dump($noAction);
        //var_dump($dateDebut);
        //str_split($dateDebut,'$20%');
        $DateDebut=str_replace('%20',' ',$dateDebut);

        $Donnees = array('a.noaction'=>$noAction,'datedebut'=>$DateDebut,);
        $Action = $this->ModelAction->getAction($Donnees);
       // var_dump($Action);

        // $Doonnes = array('a.noaction'=>$noAction,'datedebut'=>$DateDebut,);
        // $Action = $this->ModelAction->getAction($Doonnes);
        //var_dump($Action);
        $Donnes = array('NOACTION'=>$noAction,'DATEACTION'=>$DateDebut,);
        //var_dump($Donnes);
        $Fichiers = $this->ModelAction->getFichersPourAction($Donnes);
        //var_dump($Fichiers);
        if(empty($Fichiers))
        {
           
            $Données = array(
                'Actions'=>$Actions,
            );
        }
        else
        {
            $Données = array(
                'Actions'=>$Actions,
                'Fichiers'=>$Fichiers,
            );
        }
        

        $DonnéesTitre = array('TitreDeLaPage'=>$Actions[0]['NOMACTION']);
        
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Acteur/AfficherAction',$Données);
        $this->load->view('templates/PiedDePage');

    }

    public function RenommerPhoto($Image)
    {
        //Je T'aime
        $noActeur = $this->session->noActeur;
        return $Image=$noActeur.'_'.date('Y-m-d_H_i_s');
    }

    public function GestionPhoto($Photo)//$ratio
    {
        
        
        // <!-- <form method="POST" action="GestionPhoto" enctype="multipart/form-data">-->
        // <!-- On limite le fichier à 2Mo -->
        // <!--<input type="hidden" name="MAX_FILE_SIZE" value="2000000">-->
        // <!--Fichier : <input type="file" name="avatar">-->
        // <!--<input type="submit" name="envoyer" value="Envoyer le fichier">-->
        // <!--</form> -->
        
        
        //var_dump($Acteur);
        $Données = array("Photo"=> $Photo);
        $DonnéesTitre = array('TitreDeLaPage'=>'Modifier Photo');
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Acteur/GestionPhoto',$Données);
        $this->load->view('templates/PiedDePage');
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
                    $message = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
                }
                else
                {
                    $message= 'Upload effectué avec succès !';

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
                    //var_dump($ratio);
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

    public function NouvelleAction()
    {
        if($this->input->post('Ajouter'))
        {
            $NomAction = $this->input->post('NomAction');
            $Adresse = $this->input->post('Adresse');
            $CP = $this->input->post('CodePostale');
            $Ville = $this->input->post('Ville');
            $DateDebut = $this->input->post('DateDebut');
            $HeureDebut = $this->input->post('HeureDebut');
            $DateFin = $this->input->post('DateFin');
            $HeureFin = $this->input->post('HeureFin');
            $Public = $this->input->post('Public');
            $Description = $this->input->post('Description');
            $SiteURL = $this->input->post('SiteURL');
            
            //echo $coucou;
            $DateD = $DateDebut.' '.$HeureDebut;
            $DateF = $DateFin.' '.$HeureFin;

            $Donnes = array(
                'a.nomAction' => $NomAction,
                'datedebut' => $DateDebut.' '.$HeureDebut,
            );

            //var_dump($Donnes);

            $Action = $this->ModelAction->getAction($Donnes);
            if(!empty($Action))
            {
                // echo 'coucou il y a déjà une action de ce nom créée à cette date ^^';
                //var_dump($Action);
                // $Doonnes = array('a.noaction'=>$Action[0]['NOACTION'],'datedebut'=>$Date,);
                // $Fichiers = $this->ModelAction->getFichersPourAction($Donnes,$DateFin);

                $Données = array(
                    'Actions'=>$Action,
                    //'Fichiers'=>$Fichiers,
                );

                $DonnéesTitre = array('TitreDeLaPage'=>$Action[0]['NOMACTION']);
        
                $this->load->view('templates/Entete',$DonnéesTitre);
                $this->load->view('Acteur/AfficherAction',$Données);
                $this->load->view('templates/PiedDePage');

                
            }
            else
            {
                $DonnéesDeux = array('a.nomAction'=>$NomAction,);
                $ActionVague = $this->ModelAction->getAction($DonnéesDeux);
                
                if(!empty($ActionVague))
                {
                    //echo 'coucou il y a déjà une action du même nom xD';
                    var_dump($ActionVague);
                    // update ou lien vers l'update ? 
                }
                else
                {
                    // echo 'n\'existe pas';
                    
                    $donnéesAction = array(
                        'nomaction'=>$NomAction,
                        'publiccible'=>$Public,
                        'SiteURLAction'=>$SiteURL,
                    );
                    $noAction = $this->ModelAction->insertAction($donnéesAction);
                    
                    //gestion du lieu de l'action
                    $donnéesLieu = array(
                        'adresse'=>$Adresse,
                        'CodePostal'=>$CP,
                        'ville'=>$Ville,
                    );
                    //test si le lieu est dejà dans la BDD
                    $noLieu = $this->ModelAction->getLieu($donnéesLieu);
                    //Si pas dans la BDD => insert
                    if(empty($noLieu)) //penser à trouver les coodonnées => léandre API  ?
                    {
                        //penser aux coordonnées
                        $noLieu = $this->ModelAction->insertLieu($donnéesLieu);
                    }

                   $donnéesAvoirLieu = array(
                       'DateDebut'=>$DateD,
                       'NoAction'=>$noAction,
                       'TitreAction'=>$NomAction,
                       'NoLieu'=>$noLieu,
                       'DateFin'=>$DateF,
                       'Description'=>$Description,
                   );

                   $this->ModelAction->insertAvoirLieu($donnéesAvoirLieu);

                   $donnéesEtrePartenaire = array(
                        'NoAction'=>$noAction,
                        'NoActeur'=> $this->session->noActeur,
                        'NoRole'=> '2147483642',
                        'DateDebut'=>$DateD,
                        'DateFin'=>$DateF,
                   );

                   $this->ModelAction->insertEtrePartenaire($donnéesEtrePartenaire);

                   $donnéesProfilPourAction = array(
                        'NoActeur'=> $this->session->noActeur,
                        'NoAction'=>$noAction,
                        'DateDebut'=>$DateD,
                        'NoProfil'=>'3',
                        'DateFin'=>$DateF,
                   );
                   
                   $noProfil = $this->ModelAction->insertProfilPourAction( $donnéesProfilPourAction);
                   $this->session->statut = $noProfil;

                   $this->AfficherActionSelectionnee($noAction,$DateD,$DateF);
                   //Charger la page de l'action créée. 

                } 
            }    
        
        }
        else
        {
            $DonnéesTitre = array('TitreDeLaPage'=>'Ajouter une Action');
        
            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('Acteur/AjouterUneAction');
            $this->load->view('templates/PiedDePage');

        }
    }
    
    public function ModifierAction()
    {

        $noActeur = $this->session->noActeur;
        //var_dump($noActeur);
        $this->load->model('ModelActeur'); // on charge le modele correspondant
        $action= $this->ModelActeur->getActions($noActeur);
        $i=0;
        //var_dump($action);
        foreach($action as $uneAction)
        {
            if(empty($Options))
            {
                $Options = array($uneAction['NOACTION']=>$uneAction['NOMACTION']);
            }
            else
            {
                $temporaire = array($uneAction['NOACTION']=>$uneAction['NOMACTION']);
                $Options = $Options + $temporaire;
            }
        }

        $DonnéesTitre = array('TitreDeLaPage'=>'Modification Action');
        $DonneesAInjectees=array(
            'options'=>$Options,
        );
        //var_dump($DonneesAInjectees['options'][2]);
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Acteur/ModifierAction',$DonneesAInjectees);
        $this->load->view('templates/PiedDePage');

    }

    public function ContacterAdmin()
    {
        $noActeur = $this->session->noActeur;
        if ( $this->input->post('Envoyer'))
        {
            $objet = $this->input->post('subject');
            $message=$this->input->post('Message');
            $mail = $this->input->post('mail');
            //1cape1slip@gmail.com mdp: goldebutger007
            $nom = $this->input->post('nom');
            $prenom = $this->input->post('prenom');
            //1cape1slip@gmail.com mdp: goldfinger007
            $this->email->from('cartopus22@gmail.com');
            $this->email->to('1cape1slip@gmail.com'); 
            $this->email->subject($objet);
            $this->email->message($message."\r\n".'Ce message a été envoyé par : '.$nom.' '.$prenom.'. Contact: '.$mail);
            if (!$this->email->send())
            {
                $this->email->print_debugger();
            }
            else
            {

            }
            
        }
        else{
            $acteur=$this->ModelActeur->getActeur($noActeur); 
            //var_dump($acteur);
            $DonneesAInjectees=array
            (
                'mail'=> $acteur[0]['MAIL'],
                'nom'=>$acteur[0]['NOMACTEUR'],
                'prenom'=>$acteur[0]['PRENOMACTEUR'],
            );
            //var_dump($DonneesAInjectees);
            $DonnéesTitre = array('TitreDeLaPage'=>'Contactez Nous');
            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('Acteur/ContacterAdmin',$DonneesAInjectees);
            $this->load->view('templates/PiedDePage');
        }
    }
    public function AjoutThematique()
    {
        $DonnéesTitre = array('TitreDeLaPage'=>'Ajout Thématique');
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Acteur/AjoutThematique');
        $this->load->view('templates/PiedDePage');
    }
}
?>