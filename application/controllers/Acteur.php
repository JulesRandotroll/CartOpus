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
 
        //var_dump($this->session->statut);
    
        if ($this->session->statut==0)
        {
            redirect('Visiteur/loadAccueil');
        };
    } // __construct

    public function AccueilActeur()
    {

        $this->session->statut = 1;
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
                //var_dump($this->input->post('newmotdepasse'));
                //var_dump($this->input->post('confmdp'));
                
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
        //$DateDebut=str_replace('%20',' ',$dateDebut);

        $Donnees = array('a.noaction'=>$noAction,'datedebut'=>$DateDebut,);
        $Action = $this->ModelAction->getAction($Donnees);
        //var_dump($Action);

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

    public function ChoixAction($page)
    {
        $noActeur = $this->session->noActeur;

        //var_dump($page);
        if($this->input->post('Choix_Renouveler'))
        {
            $noAction=$this->input->post('Action');
            //var_dump($noAction);
            redirect('Acteur/ReitererAction/'.$noAction);
                         
        }
        if($this->input->post('Choix_Modifier'))
        {
            $noAction=$this->input->post('Action');
            redirect('Acteur/ModifierAction/'.$noAction);
           // $this->ModifierAction($noAction);
           
        }
        if($this->input->post('Choix_Supprimer'))
        {
            $noAction=$this->input->post('Action');
            $this->SupprimerAction($noAction);
        }
        if($this->input->post('Choix_Ajout_Collaborateur'))
        {
            $noAction=$this->input->post('Action');
            redirect('Acteur/AjoutCollaborateur/'.$noAction); 
        }
        else
        {
            //$noActeur = $this->session->noActeur;
            $this->load->model('ModelActeur'); // on charge le modele correspondant
            $action= $this->ModelActeur->getActions($noActeur);
            $i=0;
            //var_dump($action);
            foreach($action as $uneAction)
            {
                if(empty($Options))
                {
                    $Options = array($uneAction['NOACTION']=>$uneAction['NOMACTION'].' '.$uneAction['DATEDEBUT']);
                }
                else
                {
                    $temporaire = array($uneAction['NOACTION']=>$uneAction['NOMACTION'].' '.$uneAction['DATEDEBUT']);
                    $Options = $Options + $temporaire;
                }
            }
            //var_dump($Options);
            
            $DonneesAInjectees=array
            (
                'options'=>$Options,
                'page'=>$page,
            );
            //var_dump($DonneesAInjectees);
            $DonnéesTitre = array('TitreDeLaPage'=>'Choisir Action');
            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('Acteur/ChoisirAction', $DonneesAInjectees);
            $this->load->view('templates/PiedDePage');     
        }
    }
    public function ReitererAction($noAction)
    {
        $noActeur = $this->session->noActeur;
        //var_dump($noAction);
        $DonnéesDeTest= array
        (
            'a.NoAction' => $noAction,
        );
        $Action=$this->ModelAction->getAction($DonnéesDeTest);

        if ($this->input->post('Renouveler'))
        {     
            $DateDebut = $this->input->post('DateDebut');
            $HeureDebut = $this->input->post('HeureDebut');
            $DateFin = $this->input->post('DateFin');
            $HeureFin = $this->input->post('HeureFin');

            $DateD = $DateDebut.' '.$HeureDebut;
            $DateF = $DateFin.' '.$HeureFin;
            //var_dump($DateD);

            if ($Action[0]['DATEFIN']>$DateD||$DateF<$DateD)
            {
                $message="dates incorrectes";
                //echo("date incorrecte");
                $DonneesAInjectees=array
                (
                    'noAction'=>$Action[0]['NOACTION'],
                    'NomAction'=>$Action[0]['NOMACTION'],
                    'Adresse'=>$Action[0]['ADRESSE'],
                    'CodePostale'=>$Action[0]['CodePostal'],
                    'Ville'=>$Action[0]['Ville'],
                    'DateDebut'=>'',
                    'DateFin'=>'',
                    'HeureDebut'=>'',
                    'HeureFin'=>'',
                    'Public'=>$Action[0]['PublicCible'],
                    'Description'=>$Action[0]['Description'],
                    'SiteURL'=>$Action[0]['SiteURLAction'],
                    'message'=>$message,
                );
                $DonnéesTitre = array('TitreDeLaPage'=>'Renouveler');
                $this->load->view('templates/Entete',$DonnéesTitre);
                $this->load->view('Acteur/ReitererAction',$DonneesAInjectees);
                $this->load->view('templates/PiedDePage');
            }
            else
            {
                //echo("ok ! ^^");
                $message="";

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

                $DonneesAInjectees=array
                (
                    'noAction'=>$Action[0]['NOACTION'],
                    'NomAction'=>$NomAction,
                    'Adresse'=>$Adresse,
                    'CodePostale'=>$CP,
                    'Ville'=>$Ville,
                    'DateDebut'=>$DateDebut,
                    'DateFin'=>$DateFin,
                    'HeureDebut'=>$HeureDebut,
                    'HeureFin'=>$HeureFin,
                    'Public'=>$Public,
                    'Description'=>$Description,
                    'SiteURL'=>$SiteURL,
                    'message'=>$message,
                );
                //var_dump($DonneesAInjectees);
                //var_dump($Action);
                $noAction=$Action[0]['NOACTION'];
                $Action=$this->NouvelleAction($noAction);
                //var_dump($noActeur);
                redirect ('Acteur/AccueilActeur/'.$message);
            }               
        }
        else
        {
            $message="";
            //var_dump($Action);
            $DonneesAInjectees=array
            (
                'noAction'=>$Action[0]['NOACTION'],
                'NomAction'=>$Action[0]['NOMACTION'],
                'Adresse'=>$Action[0]['ADRESSE'],
                'CodePostale'=>$Action[0]['CodePostal'],
                'Ville'=>$Action[0]['Ville'],
                'DateDebut'=>'',
                'DateFin'=>'',
                'HeureDebut'=>'',
                'HeureFin'=>'',
                'Public'=>$Action[0]['PublicCible'],
                'Description'=>$Action[0]['Description'],
                'SiteURL'=>$Action[0]['SiteURLAction'],
                'message'=>$message,
            );
            $DonnéesTitre = array('TitreDeLaPage'=>'Renouveler');
            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('Acteur/ReitererAction',$DonneesAInjectees);
            $this->load->view('templates/PiedDePage');
        }
        
    }
    public function RenommerPhoto($Image)
    {
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

    public function NouvelleAction($noAction)
    {
        if($this->input->post('Ajouter')||$this->input->post('Renouveler'))
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
            
            $DateD = $DateDebut.' '.$HeureDebut;
            $DateF = $DateFin.' '.$HeureFin;

            if ($DateF<$DateD)
            {
                $message="dates incorrectes";
                //echo("date incorrecte");
                $DonneesAInjectees=array
                (
                    'NomAction'=>$NomAction,
                    'Adresse'=>$Adresse,
                    'CodePostale'=>$CP,
                    'Ville'=>$Ville,
                    'DateDebut'=>'',
                    'DateFin'=>'',
                    'HeureDebut'=>'',
                    'HeureFin'=>'',
                    'Public'=>$Public,
                    'Description'=>$Description,
                    'SiteURL'=>$SiteURL,
                    'message'=>$message,
                );
                if ($this->input->post('Ajouter'))
                {
                    $DonnéesTitre = array('TitreDeLaPage'=>'Ajouter');
                    $this->load->view('templates/Entete',$DonnéesTitre);
                    //$DonneesAInjectees=array ('message'=>$message);
                    $this->load->view('Acteur/AjouterUneAction',$DonneesAInjectees);
                    $this->load->view('templates/PiedDePage');
                }
                if($this->input->post('Renouveler'))
                {
                    $DonnéesTitre = array('TitreDeLaPage'=>'Renouveler');
                    $this->load->view('templates/Entete',$DonnéesTitre);
                    $this->load->view('Acteur/ReitererAction',$DonneesAInjectees);
                    $this->load->view('templates/PiedDePage');
                }
            
            }
            else
            {
                //echo("ok ! ^^");
                $message="";

                $TestActionExistante = array(
                'a.nomAction' => $NomAction,
                'datedebut' => $DateDebut.' '.$HeureDebut, 
                );
            
                $ActionExistante = $this->ModelAction->getAction($TestActionExistante);
               // var_dump($ActionExistante);
                if(!empty($ActionExistante))
                {   
                    
                    echo '<script> alert("Cet évènement existe déjà"); </script>';
                    //traitement profilpourEvenement si evenement non validé.
                    
                    $this->AfficherActionSelectionnee($ActionExistante[0]['NOACTION'],$ActionExistante[0]['DATEDEBUT'],$ActionExistante[0]['DATEFIN']);
                }
                else // Action déjà existante
                {
                    $DonnéesActionMemeNom = array('a.nomAction'=>$NomAction,);
                    $ActionMemeNom = $this->ModelAction->getAction($DonnéesActionMemeNom);
                    
                    if(empty($ActionMemeNom))
                    {
                        $donnéesAction = array(
                            'nomaction'=>$NomAction,
                            'publiccible'=>$Public,
                            'SiteURLAction'=>$SiteURL,
                        );

                        $noAction = $this->ModelAction->insertAction($donnéesAction);
                    } // fin si action du même nom existe.
                    elseif($this->input->post('Renouveler'))
                    {
                        $donnéesAction = array(
                            'nomaction'=>$NomAction,
                            'publiccible'=>$Public,
                            'SiteURLAction'=>$SiteURL,
                        );

                        $noAction = $this->ModelAction->insertAction($donnéesAction);
                    }
                    else
                    {
                        $noAction = $ActionMemeNom[0]['NOACTION'];
                    } //fin si pas action même nom

                        ///Insertion ÊtrePartenaire :
                        $donnéesEtrePartenaire = array(
                            'NoAction'=>$noAction,
                            'NoActeur'=> $this->session->noActeur,
                            'NoRole'=> '2147483642',
                            'DateDebut'=>$DateD,
                            'DateFin'=>$DateF,
                        );
                        //var_dump($donnéesEtrePartenaire);
                        $this->ModelAction->insertEtrePartenaire($donnéesEtrePartenaire);
                    
                        ///Insertion  Profil Pour Action :
                        $donnéesProfilPourAction = array(
                            'NoActeur'=> $this->session->noActeur,
                            'NoAction'=>$noAction,
                            'DateDebut'=>$DateD,
                            'NoProfil'=>'3',
                            'DateFin'=>$DateF,
                        );     

                        $this->ModelAction->insertProfilPourAction( $donnéesProfilPourAction);
                        $this->session->statut = 3;

                        ///Test si Lieu existe déjà : 
                        $donnéesLieu = array(
                            'adresse'=>$Adresse,
                            'CodePostal'=>$CP,
                            //'ville'=>$Ville,
                        );
                        //var_dump($donnéesLieu);
                        $Lieux = $this->ModelAction->getLieu($donnéesLieu);
                        //var_dump($Lieux);
                    
                        //var_dump($noLieu);
                        if($Lieux==null) //penser à trouver les coodonnées => léandre API  ?
                        {
                            //penser aux coordonnées
                            $donnéesLieu = array(
                                'adresse'=>$Adresse,
                                'CodePostal'=>$CP,
                                'ville'=>$Ville,
                            );
                            $noLieu = $this->ModelAction->insertLieu($donnéesLieu);
                            
                        } //si le lieu n'existe pas
                        else
                        {
                            $noLieu = $Lieux[0]['nolieu'];
                        }

                        /// Insertion Avoir Lieu : 
                        $donnéesAvoirLieu = array(
                            'DateDebut'=>$DateD,
                            'NoAction'=>$noAction,
                            'TitreAction'=>$NomAction,
                            'NoLieu'=>$noLieu,
                            'DateFin'=>$DateF,
                            'Description'=>$Description,
                        );

                        $this->ModelAction->insertAvoirLieu($donnéesAvoirLieu);
                    
                    echo '<script> alert("Insetion effectuée avec succès"); </script>';
                    $this->AfficherActionSelectionnee($noAction,$DateD,$DateF);
                    //Charger la page de l'action créée. 

                } //Fin Action N'existe aps => insertion
            }
        }
        else //input Ajouter
        {
            $DonnéesTitre = array('TitreDeLaPage'=>'Ajouter une Action');
            $message="";
            $DonneesAInjectees=array 
            (
                'NomAction'=>'',
                'Adresse'=>'',
                'CodePostale'=>'',
                'Ville'=>'',
                'DateDebut'=>'',
                'DateFin'=>'',
                'HeureDebut'=>'',
                'HeureFin'=>'',
                'Public'=>'',
                'Description'=>'',
                'SiteURL'=>'',
                'message'=>$message,
            );
            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('Acteur/AjouterUneAction',$DonneesAInjectees);
            $this->load->view('templates/PiedDePage');

        }//Fin input Ajouter
    }
    
    public function ModifierAction($noAction)
    {
        $noActeur = $this->session->noActeur;
        //var_dump($noAction);
             
        $DonnéesDeTest= array(
            'a.NoAction' => $noAction,
            //'datedebut'=>$dateDebut,
        );
        $Action=$this->ModelAction->getAction($DonnéesDeTest);
        //var_dump($Action);
        if ($this->input->post('Modifier'))
        { 
            $noAction=$Action[0]['NOACTION'];
          
            $DateDebut = $this->input->post('DateDebut');
            $HeureDebut = $this->input->post('HeureDebut');
            $DateFin = $this->input->post('DateFin');
            $HeureFin = $this->input->post('HeureFin');

            $DateD = $DateDebut.' '.$HeureDebut;
            $DateF = $DateFin.' '.$HeureFin;

            if($DateF<$DateD)
            {
                $message="dates incorrectes";
                //echo("date incorrecte");
                $DonneesAInjectees=array
                (
                    'noAction'=>$Action[0]['NOACTION'],
                    'NomAction'=>$Action[0]['NOMACTION'],
                    'Adresse'=>$Action[0]['ADRESSE'],
                    'CodePostale'=>$Action[0]['CodePostal'],
                    'Ville'=>$Action[0]['Ville'],
                    'DateDebut'=>'',
                    'DateFin'=>'',
                    'HeureDebut'=>'',
                    'HeureFin'=>'',
                    'Public'=>$Action[0]['PublicCible'],
                    'Description'=>$Action[0]['Description'],
                    'SiteURL'=>$Action[0]['SiteURLAction'],
                    'message'=>$message,
                );
                $DonnéesTitre = array('TitreDeLaPage'=>'Modifier');
                $this->load->view('templates/Entete',$DonnéesTitre);
                $this->load->view('Acteur/ModifierAction',$DonneesAInjectees);
                $this->load->view('templates/PiedDePage');
            }
            else
            {
                $DonneesAModifierAction=array(
                    'NomAction'=>$this->input->post('NomAction'),
                    'PublicCible'=>$this->input->post('Public'),
                    'SiteURLAction'=>$this->input->post('SiteURL'),
                );
               //echo'Action';
                //var_dump($DonneesAModifierAction);
                $Action=$this->ModelAction->UpdateAction($noAction,$DonneesAModifierAction);
                
                 ////////////////////////////////////////////////////////////////////////////////////////////////
                $DonneesAModifierLieu=array(
                    'Adresse'=>$this->input->post('Adresse'),
                    'CodePostal'=>$this->input->post('CodePostale'),
                    'Ville'=>$this->input->post('Ville'),
    
                );
                //echo'Lieu';
                //var_dump($DonneesAModifierLieu);
                $noLieu=$this->ModelAction->getLieu($DonneesAModifierLieu);
                if ($noLieu==null){
                    $Lieu=$this->ModelAction->insertLieu($DonneesAModifierLieu);
                    $noLieu=$Lieu['noLieu'];
                }
                
                $DateDebut = $this->input->post('DateDebut');
                $HeureDebut = $this->input->post('HeureDebut');
                $DateFin = $this->input->post('DateFin');
                $HeureFin = $this->input->post('HeureFin');

                $DateD = $DateDebut.' '.$HeureDebut;
                $DateF = $DateFin.' '.$HeureFin;
                // var_dump($noLieu);              
                /////////////////////////////////////////////////////////////////////////////////////////////////
                $DonneesAModifierEtrePartenaire=array(
                    'DateDebut'=>$DateD,
                    'DateFin'=>$DateF,
                );
                $DonnéesDeTest=array(
                    'NoAction'=>$noAction,
                    'NoActeur'=>$noActeur,
                );
                $EtrePartenaire=$this->ModelAction->UpdateEtrePartenaire($DonnéesDeTest,$DonneesAModifierEtrePartenaire);
                /////////////////////////////////////////////////////////////////////////////////////////////////
                $DonneesAModifierAvoirLieu=array(
                    'DateDebut'=>$DateD,
                    'NoLieu'=>$noLieu,
                    'DateFin'=>$DateF,
                    'TitreAction'=>$this->input->post('NomAction'),
                    'Description'=>$this->input->post('Description'),
                    );
                    //echo'AvoirLieu';
                    //var_dump($DonneesAModifierAvoirLieu);
                    //var_dump($noLieu[0]['nolieu']);
                    $AvoirLieu=$this->ModelAction->UpdateAvoirLieu($noAction,$noLieu[0]['nolieu'],$DonneesAModifierAvoirLieu);
    
                redirect ('Acteur/AccueilActeur/'.$noActeur);
            }
        }
        else
        {
            //var_dump($Action);
            $DonneesAInjectees=array
            (
                'noAction'=>$Action[0]['NOACTION'],
                'NomAction'=>$Action[0]['NOMACTION'],
                'Adresse'=>$Action[0]['ADRESSE'],
                'CodePostale'=>$Action[0]['CodePostal'],
                'Ville'=>$Action[0]['Ville'],
                'DateDebut'=>$Action[0]['DATEDEBUT'],
                'DateFin'=>$Action[0]['DATEFIN'],
                // 'HeureDebut'=>$Action[0]['HeureDebut'],
                // 'HeureFin'=>$Action[0]['HeureFin'],
                'Public'=>$Action[0]['PublicCible'],
                'Description'=>$Action[0]['Description'],
                'SiteURL'=>$Action[0]['SiteURLAction'],
                //'options'=>$Options,
                //'choix'=>0,
            );
        
            $DonnéesTitre = array('TitreDeLaPage'=>'Modification Action');

            //var_dump($DonneesAInjectees['options'][2]);
            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('Acteur/ModifierAction',$DonneesAInjectees);
            $this->load->view('templates/PiedDePage');
        }
        
 
    }

    public function SupprimerAction($noAction)
    {
        //echo("tu supprimes :'(");
        $donneeAsupprimer=$noAction;

        $this->ModelAction->Suppr_AvoirLieu($donneeAsupprimer);
        $this->ModelAction->Suppr_EtrePartenaire($donneeAsupprimer);
        $this->ModelAction->Suppr_ProfilPourAction($donneeAsupprimer);
        $this->ModelAction->Suppr_Action($donneeAsupprimer);
        if ($this->input->post("Choix_Supprimer"))
        {
            redirect('Acteur/ChoixAction/3','refresh');
        }
        else
        {
            redirect('Acteur/AccueilActeur/'.$noActeur);
        }
     
        //echo ($noAction);

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
                $this->AccueilActeur();
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
    
    public function AjoutCollaborateur($noAction)
    {
        $DonnéesTitre = array('TitreDeLaPage'=>'Ajout Collaborateur');
        $noActeur = $this->session->noActeur;

        if ($this->input->post('valider'))
        {
            $Nom=$this->input->post('nom');
            $Prenom=$this->input->post('prenom');
            $Mail=$this->input->post('mail');
            $ConfMail=$this->input->post('confmail');
            $Role=$this->input->post('role');

            //var_dump($Nom);
            //echo 'plop';
            if ($Mail!=$ConfMail)
            {
                $message='La confirmation de mail n\'est pas semblable au mail rentré ';

                $DonneesAInjecter=array(
                    'noAction'=>$noAction,
                    'Nom'=>$Nom,
                    'Prenom'=>$Prenom,
                    'Mail'=>$Mail,
                    'ConfMail'=>"",
                    'Role'=>$Role,
                    'message'=>$message,
               );
   
               $this->load->view('templates/Entete',$DonnéesTitre);
               $this->load->view('Acteur/AjoutCollaborateur',$DonneesAInjecter);
               $this->load->view('templates/PiedDePage');
  
            }
            else
            {
                $test=$this->ModelActeur->GetMail($Mail);
                //var_dump($test);
                if ($test==null)
                { 
                    $Acteur=$this->ModelActeur->GetActeur($noActeur);
                    //var_dump($Acteur);

                    $SiteURL=site_url("Visiteur/SInscrire");
                    $objet ='Demande d\inscription';
                    $message = $Acteur[0]['NOMACTEUR'].' '.$Acteur[0]['PRENOMACTEUR'].' souhaiterai que vous soyez son collaborateur pour l\'évenement '.$noAction.' Et pour ceci il faut vous inscrire sur le site : '.$SiteURL;
                    
                    $mail = $this->input->post('mail');
                    //var_dump($mail);

                    $this->email->from('cartopus22@gmail.com');
                    $this->email->to($mail); 
                    $this->email->subject($objet);
                    $this->email->message($message);

                    if (!$this->email->send())
                    {
                        $this->email->print_debugger();
                    }
                }
                else
                {
                    echo' insert dans etrepartenaire avec le role du dropdown et l\'acteur choisi pour l\'action selectionnée';
                }
            }
        }
        else
        {
            $this->load->model('ModelActeur'); // on charge le modele correspondant
            $Role = $this->ModelActeur->GetRole();
            $i=0;
            foreach($Role as $unRole)
            {
                if(empty($Options))
                {
                    $Options = array($unRole['NOROLE']=>$unRole['NOMROLE']);
                }
                else
                {
                    $temporaire = array($unRole['NOROLE']=>$unRole['NOMROLE']);
                    $Options = $Options + $temporaire;
                }
            }

            $message="";
            $DonneesAInjecter=array(
                'noAction'=>$noAction,
                'Nom'=>"",
                'Prenom'=>"",
                'Mail'=>"",
                'ConfMail'=>"",
                'message'=>$message,
                'Role'=>$Options,
            );

            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('Acteur/AjoutCollaborateur',$DonneesAInjecter);
            $this->load->view('templates/PiedDePage');
        }
    }
    public function AjoutThematique($NomAction)
    {
        // sortir toutes les thématiques dans faire références puis recup le nom correspondant puis les injectées
        $DonnéesAInjecter=array(
            'NomAction'=>$NomAction,
        );
        $DonnéesTitre = array('TitreDeLaPage'=>'Ajout Thématique');
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Acteur/AjoutThematique',$DonnéesAInjecter);
        $this->load->view('templates/PiedDePage');
    }

    
}
?>