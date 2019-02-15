<?php 

class Visiteur extends CI_Controller 
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
      $this->load->model('ModelSeConnecter');
      $this->load->model('ModelSInscrire'); // on charge le modele correspondant
      $this->load->model('ModelAction');
      $this->load->library('session');
      $this->load->model('ModelOrga');
      $this->load->model('ModelRecherche');
      $this->load->model('ModelActeur');
      $this->load->model('ModelCommentaire');
      $this->load->library("pagination");
  } // __construct

  public function loadAccueil()
  {
    $DonneesTitre = array('TitreDeLaPage'=>'Cart\'Opus');

    if ($this->session->statut==null)
    {
      $this->session->statut = 0;
    }
    //echo $this->session->statut;
    if($this->session->statut==0 && $this->session->noVisiteur!=null)
    {
      //echo $this->session->noVisiteur;
      $pseudo=$this->ModelSeConnecter->getPseudo($this->session->noVisiteur);
      $this->session->pseudo=$pseudo[0]['pseudo']; 
      //var_dump($this->session->pseudo);
      //var_dump($pseudo);
    }

    $Where = array(
      'a.Favoris'=>true,
    );
  
    if($this->session->flashdata('message')!=null)
    {
      $DonneesMessage= array('message'=>$this->session->flashdata('message'));
      $DonneesInjectees=array('lesFavoris'=> $this->ModelAction->getActionFavorite($Where),);


     // var_dump($DonneesInjectees);
      $this->load->view('templates/Entete',$DonneesTitre);
      $this->load->view('Visiteur/BarreRecherche',$DonneesMessage);
      $this->load->view('Visiteur/FilActualite', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    
    }
    else
    {
      $DonneesInjectees['lesFavoris'] = $this->ModelAction->getActionFavorite($Where);

      $this->load->view('templates/Entete',$DonneesTitre);
      $this->load->view('Visiteur/BarreRecherche',$this->session->statut);
      $this->load->view('Visiteur/FilActualite', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
    //$DonneesTitre = array('TitreDeLaPage'=>'Cart\'Opus');
  } //fin loadAccueil

  public function GenererMotDePasse()
  {
      $characters = '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
      //=> tableau
      $MotDePasse = '';
      for ($i = 0; $i < 15; $i++) 
      {
          $MotDePasse = $MotDePasse . $characters[rand(0, 59)];
      }
      return $MotDePasse;
  } // fin GenererMotDePasse

  public function SInscrire()
  {

    // affichage des questions et des check cochés a revoir

    $DonnéesTitre = array('TitreDeLaPage'=>'Inscription');

    if ( $this->input->post('valider'))//si le bouton "Valider l'inscription" a été cliqué ...
    {
      $checktest=$this->input->post('checkmail');
              
      if (isset($checktest))
      {
        $visibleMail=true;
      }
      else
      {
        $visibleMail=false;
      }

      $checktest=$this->input->post('checktel');
      if (isset($checktest))
      {
        $visibleTel=true;
      }
      else
      {
        $visibleTel=false;
      }

      $NewDonnées=array(
          'nom'=>$this->input->post('nom'),
          'prenom'=>$this->input->post('prenom'),
          'mail'=>$this->input->post('mail'),
          'confmail'=>$this->input->post('confmail'),
          'tel'=>$this->input->post('tel'),
          'mdp'=>$this->input->post('mdp'),
          'confmdp'=>$this->input->post('confmdp'),
          'Questions'=>$this->input->post('question'),
          'reponse'=>$this->input->post('reponse'),
          'telvisible'=>$visibleTel,
          'mailvisible'=>$visibleMail,
          'message'=>'',
      );
      //var_dump($NewDonnées);

      $nomQuestion=$this->ModelSInscrire->getUneQuestion($NewDonnées['Questions']);
      //var_dump($nomQuestion);
      
      if(($NewDonnées['mail'])==($NewDonnées['confmail']))
      {
        if(($NewDonnées['mdp'])==($NewDonnées['confmdp']))// si ce que l'utilisateur a rentré dans la case mdp est égale a ce qu'il a rentré dans la case confmdp ...
        {
          $donneeATester=array('mail'=>$NewDonnées['mail']);// dans la variable donneeATester on met le mail rentré par l'utilisateur

          $testActeur = $this->ModelSInscrire->Test_Inscrit($donneeATester);// on appelle la fonction Test de ce modele et on passe la variable a tester en paramètre

          if($testActeur['count(*)']!=0) // si la fonction nous retourne un résultat différent de 0 ( si ce mail existe déjà dans la bdd ...)
          {
            $Options= $this->ObtenirQuestions_Secretes();
            $DonneesInjectees=array
            (
              'nom'=>'',
              'prenom'=>'',
              'mail'=>'',
              'tel' =>'',
              'message' => 'Vous êtes déjà inscrit avec cette adresse mail',
              'confmdp'=>'',
              'confmail'=>'',
              'Questions'=>$Options,
              'mailvisible'=>false,
              'telvisible'=>false,
              'reponse'=>'',
            );
            
              $this->load->view('templates/Entete',$DonnéesTitre);
              $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
              $this->load->view('templates/PiedDePage');
          }
          else // sinon on insert les bonnes valeurs dans la base de donnée
          {
            //echo'test Visiteur';
            $testVisiteur = $this->ModelSInscrire->Test_InscritVisiteur($donneeATester);
            //var_dump($testVisiteur);
            if($testVisiteur['count(*)']!=0) // si la fonction nous retourne un résultat différent de 0 ( si ce mail existe déjà dans la bdd ...)
            {
              $NewDonnées["transfert"]=TRUE;
              $NewDonnées["Questions"]=$nomQuestion[0]['nomQuestion'];
              //var_dump($NewDonnées);
              
              $this->load->view('templates/Entete',$DonnéesTitre);
              $this->load->view('Visiteur/sInscrire',$NewDonnées);
              $this->load->view('templates/PiedDePage');
            }
            else
            {
              $donneeAinserer=array(
                'noprofil'=>'1',
                'nomacteur'=>$this->input->post('nom'),
                'prenomacteur'=>$this->input->post('prenom'),
                'motdepasse'=>$this->input->post('mdp'),
                'mail' => $this->input->post('mail'),
                'notel' => $this->input->post('tel'),
                'photoprofil'=>'4pPaR31L_1Ph20T.png',
                'noquestion'=>$Options,
                'reponse'=>$this->input->post('reponse'),
                'mailvisible'=>$visibleMail,
                'notelvisible'=>$visibleTel,
                'finaliser'=>false,
              );
              //var_dump($donneeAinserer);
    
              $code=$this->GenererMotDePasse();
              $date= date('Y-m-d H:i:s');
              //var_dump($code);
              $donneeEncours=array(
                'code'=>$code,
                'mail'=> $this->input->post('mail'),
                'dateJour'=>$date,
              );
              $this->ModelSInscrire->Insert_Acteur($donneeAinserer);
              $this->ModelSInscrire->Insert_EnCours($donneeEncours);
              $mail=$this->input->post('mail');
              $this->session->set_flashdata('mail',$mail);
              $this->session->set_flashdata('code',$code);
              $this->Validation();
            }
          }
        }// if mdp== confmdp
        else //sinon ...
        {
          $Options= $this->ObtenirQuestions_Secretes();
  
          $DonneesInjectees=array(
            'nom'=>$this->input->post('nom'),
            'prenom'=>$this->input->post('prenom'),
            'mail' => $this->input->post('mail'),
            'tel' => $this->input->post('tel'),
            'confmail'=>$this->input->post('confmail'),
            'mdp'=>'',
            'confmdp'=>'',          
            'mailvisible'=>$visibleMail,
            'telvisible'=>$visibleTel,
            'reponse'=>$this->input->post('rep'),
            'Questions'=>$Options,
            'message' => 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit',
            'transfert'=>false,
          );
  
          $this->load->view('templates/Entete',$DonnéesTitre);
          $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
          $this->load->view('templates/PiedDePage');
          //echo 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit';
        }
      }
      else
      {
        $Options= $this->ObtenirQuestions_Secretes();
  
          $DonneesInjectees=array(
            'nom'=>$this->input->post('nom'),
            'prenom'=>$this->input->post('prenom'),
            'mail' => $this->input->post('mail'),
            'confmail'=>'',
            'mdp'=>'',
            'confmdp'=>'',
            'tel' =>$this->input->post('tel'),
            'mailvisible'=>$visibleMail,
            'telvisible'=>$visibleTel,
            'reponse'=>$this->input->post('rep'),
            'Questions'=>$Options,
            'message' => 'La confirmation de mail n\'est pas similaire au mail écrit',
            'transfert'=>false,
          );
  
          $this->load->view('templates/Entete',$DonnéesTitre);
          $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
          $this->load->view('templates/PiedDePage');
          //echo 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit';
      }  
    }// if bouton valider
    else //sinon ...
    {
      if($this->input->post('oui'))
      {
        $checktest=$this->input->post('checkmail');
              
        if (isset($checktest))
        {
          $visibleMail=true;
        }
        else
        {
          $visibleMail=false;
        }

        $checktest=$this->input->post('checktel');
        if (isset($checktest))
        {
          $visibleTel=true;
        }
        else
        {
          $visibleTel=false;
        }

        $noVisiteur=$this->ModelSInscrire->getVisiteur($this->input->post('mail'));
        //var_dump($noVisiteur);
        $Comm=$this->ModelCommentaire->getCommUnVisiteur($noVisiteur[0]["noVisiteur"]); 
        //var_dump($Comm);

        $donneeAinserer=array(
          'NOMACTEUR'=>$this->input->post('nom'),
          'PRENOMACTEUR'=>$this->input->post('prenom'),
          'MAIL'=>$this->input->post('mail'),
          'NOTEL'=>$this->input->post('tel'),
          'MOTDEPASSE'=>$this->input->post('mdp'),
          'noQuestion'=>$this->input->post('question'),
          'Reponse'=>$this->input->post('reponse'),
          'NoTelVisible'=>$visibleTel,
          'MailVisible'=>$visibleMail,
          'NOPROFIL'=>1,
          'PhotoProfil'=>'4pPaR31L_1Ph20T.png',
          'finaliser'=>false,
        );
        //var_dump($donneeAinserer);
    
        $code=$this->GenererMotDePasse();
        $date= date('Y-m-d H:i:s');
        //var_dump($code);
        $donneeEncours=array(
          'code'=>$code,
          'mail'=> $this->input->post('mail'),
          'dateJour'=>$date,
        );
  
        $noActeur=$this->ModelSInscrire->Insert_Acteur($donneeAinserer);
        $this->ModelSInscrire->Insert_EnCours($donneeEncours);
        $mail=$this->input->post('mail');

        foreach($Comm as $unComm)
        {
          $DonnéesAInserer=array(
            'NOACTEUR'=>$noActeur,
            'NOACTION'=>$unComm['NOACTION'],
            'DATEHEURE'=>$unComm['DATEHEURE'],
            'COMMENTAIRE'=>$unComm['COMMENTAIRE'],
  
          );
          var_dump($DonnéesAInserer);
          $this->ModelCommentaire->insererCommentaireActeur($DonnéesAInserer); 
        }

        $this->ModelCommentaire->DeleteVisiteur($noVisiteur[0]["noVisiteur"]);

        $this->session->set_flashdata('mail',$mail);
        $this->session->set_flashdata('code',$code);
        $this->Validation();
      
      
        // var_dump($DonneesInjectees);
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
        $this->load->view('templates/PiedDePage');

        
      }
      elseif($this->input->post('non'))
      {
        redirect('Visiteur/loadAccueil');
      }
      else
      {
        $Options= $this->ObtenirQuestions_Secretes();

        $DonneesInjectees=array
        (
          'nom'=>"",
          'prenom'=>"",
          'mail' =>"",
          'confmail'=>"",
          'mdp'=>"",
          'confmdp'=>"",
          'tel' => "",
          'message'=>'',
          'reponse'=>'',
          'Questions'=>$Options,
          'mailvisible'=>false,
          'telvisible'=>false,
          'transfert'=>false,
        );
        
        // var_dump($DonneesInjectees);
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    }
  } // fin SInscrire

  public function sInscrireVisiteur()
  {
    $DonnéesTitre = array('TitreDeLaPage'=>'Inscription Visiteur');

    if ( $this->input->post('valider'))//si le bouton "Valider l'inscription" a été cliqué ...
    {
      if(($this->input->post('mail'))==($this->input->post('confmail')))
      {
        if (($this->input->post('mdp'))==($this->input->post('confmdp')))// si ce que l'utilisateur a rentré dans la case mdp est égale a ce qu'il a rentré dans la case confmdp ...
        {
          $donneeATester=array('mail'=>$this->input->post('mail'));// dans la variable donneeATester on met le mail rentré par l'utilisateur
          $testActeur = $this->ModelSInscrire->Test_Inscrit($donneeATester);// on appelle la fonction Test de ce modele et on passe la variable a tester en paramètre
  
          if($testActeur['count(*)']!=0) // si la fonction nous retourne un résultat différent de 0 ( si ce mail existe déjà dans la bdd ...)
          {
            $DonneesInjectees=array
            (
              'pseudo'=>'',
              'mail'=>'',
              'confmail' =>'',
              'message' => 'Vous êtes déjà inscrit avec cette adresse mail en tant qu\'acteur',
              'mdp'=>'',
              'confmdp'=>'',
            );
            
            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('Visiteur/sInscrireVisiteur',$DonneesInjectees);
            $this->load->view('templates/PiedDePage');
          }
          else // sinon on insert les bonnes valeurs dans la base de donnée
          {
            $testVisiteur= $this->ModelSInscrire->Test_InscritVisiteur($donneeATester);
            if($testVisiteur['count(*)']!=0) 
            {
              $DonneesInjectees=array
              (
                'pseudo'=>'',
                'mail'=>'',
                'confmail' =>'',
                'message' => 'Vous êtes déjà inscrit avec cette adresse mail',
                'mdp'=>'',
                'confmdp'=>'',
              );
              
                $this->load->view('templates/Entete',$DonnéesTitre);
                $this->load->view('Visiteur/sInscrireVisiteur',$DonneesInjectees);
                $this->load->view('templates/PiedDePage');
            }
            else
            {
              $donneeAinserer=array(
              'pseudo'=>$this->input->post('pseudo'),
              'motdepasse'=>$this->input->post('mdp'),
              'mail' => $this->input->post('mail'),
              'Finaliser'=>false,
              );
              //var_dump($donneeAinserer);
  
              $code=$this->GenererMotDePasse();
              $date= date('Y-m-d H:i:s');
              //var_dump($code);
              $donneeEncours=array(
                'code'=>$code,
                'mail'=> $this->input->post('mail'),
                'dateJour'=>$date,
              );
              $this->ModelSInscrire->Insert_Visiteur($donneeAinserer);
              $this->ModelSInscrire->Insert_EnCours($donneeEncours);
              $mail=$this->input->post('mail');
              $this->session->set_flashdata('mail',$mail);
              $this->session->set_flashdata('code',$code);
              $this->Validation();
            }
          }
        }// if mdp== confmdp
        else //sinon ...
        {
          $DonneesInjectees=array(
            'pseudo'=>$this->input->post('pseudo'),
            'mail'=>$this->input->post('mail'),
            'confmail'=>$this->input->post('confmail'),
            'mdp'=>$this->input->post('mdp'),
            'confmdp'=>'',
            'message' => 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit'
          );

          $this->load->view('templates/Entete',$DonnéesTitre);
          $this->load->view('Visiteur/SInscrireVisiteur',$DonneesInjectees);
          $this->load->view('templates/PiedDePage');
          //echo 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit';
        }
      }// if bouton valider
      else //sinon ...
      {
        $DonneesInjectees=array(
          'pseudo'=>$this->input->post('pseudo'),
          'mail'=>$this->input->post('mail'),
          'confmail'=>'',
          'mdp'=>$this->input->post('mdp'),
          'confmdp'=>$this->input->post('confmdp'),
          'message'=>'La confirmation du mail n\'est pas semblable au mail écrit',
        );

        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Visiteur/SInscrireVisiteur',$DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      
      }
    }
    else //sinon ...
    {
      $DonneesInjectees=array(
        'pseudo'=>'',
        'mail'=>'',
        'confmail'=>'',
        'mdp'=>'',
        'confmdp'=>'',
      );

      $this->load->view('templates/Entete',$DonnéesTitre);
      $this->load->view('Visiteur/SInscrireVisiteur',$DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    
    }
  }

  public function Validation()
  {
    $mail=$this->session->flashdata('mail');
    $code=$this->session->flashdata('code');
    $DonneesInjectees=array('mail'=>$mail);
    //var_dump($mail);
    if($this->input->post('annule'))
    {
      //echo('tes la ?');
      //
      //var_dump($mail);
      $this->ModelSInscrire->deleteTempo($mail);
      redirect('Visiteur/loadAccueil');
    }
    else
    {
      //var_dump($mail);
      $SiteURL="http://127.0.0.1/SIO1/CartOpus/index.php/Visiteur/finaliser/".$code; 
      $message="Vous vous inscrivez actuellement sur le site de CartOpus, veuillez cliquer sur ce lien pour finaliser l'inscription: ".$SiteURL;
      $objet="Validation d'inscription";
      $this->email->from('cartopus22@gmail.com');
      $this->email->to($mail); 
      $this->email->subject($objet);
      $this->email->message($message."\r\n".'Ce message a été envoyé par : CartOpus. Contact: cartopus22@gmail.com');
      if (!$this->email->send())
      {
          $this->email->print_debugger();
      }
    
      //var_dump($DonneesInjectees);
      $DonnéesTitre=array ('TitreDeLaPage'=>'Finaliser');
      $this->load->view('templates/Entete',$DonnéesTitre);
      $this->load->view('Visiteur/Validation',$DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
  }

  public function finaliser($code)
  {
    // LIEN EXPIRé
    $donneeATester=array('code'=>$code);
    $test=$this->ModelSInscrire->Test_Existe($donneeATester);
    //var_dump($test);
    if ($test["mail"]=="")
    {
      $this->session->statut=0; 

      $message="lien expiré";
      $this->session->set_flashdata('message',$message);
    
      redirect("Visiteur/loadAccueil");
    }
    else
    {
      if($this->input->post("finalise"))
      {
        $mail=$test["mail"];
        $Acteur=$this->ModelSInscrire->getActeur($mail);
        //var_dump($Acteur);
        $noActeur=$Acteur[0]['NOACTEUR'];
        $DonnéesAUpdate=array(
          'finaliser'=>true,
          'noActeur'=>$noActeur);
        //var_dump($DonnéesAUpdate);
        $this->ModelSInscrire->Finaliser($DonnéesAUpdate);
      
        $this->session->statut=1; 
        $this->session->noActeur=$noActeur;

        redirect('Acteur/AccueilActeur');
      }
      else
      {
        $DonneesInjectees=array('code'=>$code);
        //var_dump($DonneesInjectees);
        $DonnéesTitre=array ('TitreDeLaPage'=>'Finaliser');
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Visiteur/Finalise',$DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    }
  }

  public function ObtenirQuestions_Secretes()
  {
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
      return $Options;
  } // fin ObtenirQuestions_Secretes
  
  public function SeConnecter()
  {
    $DonnéesTitre = array('TitreDeLaPage'=>'Connexion');
    $this->session->statut=0;
    $message=array(
      'message'=>'',
    );
    if($this->input->post('submit'))
    {
      $donneesATester=array
      (
        'mail'=>$this->input->post('mail'),
        'motdepasse'=>$this->input->post('mdp'),
        'Finaliser'=>true,
      );
      
      $testActeur = $this->ModelSeConnecter->Test_Inscrit($donneesATester);
      // echo'deja inscrit ?';
      // var_dump($test);
      if($testActeur['count(*)']==0) // s'il n'est pas acteur
      {
        $testVisiteur = $this->ModelSInscrire->Test_InscritVisiteur($donneesATester);
        if($testVisiteur['count(*)']==0)//s'il n'est pas visiteur
        {
          $message=array(
            'message'=>'Vous n\'êtes pas encore inscrit',
          );
          // var_dump($message);
          $this->load->view('templates/Entete',$DonnéesTitre);
          $this->load->view('Visiteur/SeConnecter',$message);
          $this->load->view('templates/PiedDePage');
        }
        else // s'il est visiteur
        {
          $noprofil = 0;
          $this->session->statut=$noprofil;
      
          $noVisiteur=$this->ModelSInscrire->getVisiteur($this->input->post('mail'));
          //var_dump($noVisiteur);
          $this->session->noVisiteur=$noVisiteur[0]['noVisiteur'];
          //echo $this->session->statut;
          $this->session->set_flashdata('pseudo',$this->input->post('pseudo'));
          redirect('Visiteur/loadAccueil');
        }
     
      }
      else // s'il est acteur
      {
        $noprofil = $this->ModelSeConnecter->GetNoProfil($donneesATester);
        $this->session->statut=$noprofil[0]['NoProfil'];
        //echo $this->session->statut;
        $noActeur = $this->ModelSeConnecter->GetNoActeur($donneesATester);
        $this->session->noActeur=$noActeur[0]['NoActeur'];

        if($this->session->statut==0)
        {
          $message="Vous avez été destitué(e) de vos droits en tant qu'acteur. Pour de plus amples informations veuillez consulter votre boite mail.";
          
          $this->session->set_flashdata('message',$message);
          //echo($this->session->flashdata('message'));
          redirect('Visiteur/loadAccueil');
          
        }
        if ($this->session->statut==1)
        {
          //var_dump($noActeur);
          redirect('Acteur/AccueilActeur');
        }
        if ($this->session->statut==4)
        {
          redirect('AdminValider/AccueilAdminValider');
        }
        if ($this->session->statut==5)
        {
          echo('noacteur');
          //var_dump($this->session->noActeur);
          redirect('SuperAdmin/AccueilSuperAdmin',$this->session->statut);
          echo'noprofil';
          // var_dump($noprofil[0]['NoProfil']);
          echo'une cape et un slip';
        }
      }
    }
    else
    {
      $this->load->view('templates/Entete',$DonnéesTitre);
      $this->load->view('Visiteur/SeConnecter',$message);
      $this->load->view('templates/PiedDePage');
    }
  } // fin SeConnecter

  public function RecupMDP()
  {
    $DonnéesTitre = array('TitreDeLaPage'=>'Récupération Mot de Passe');
    $this->load->model('ModelSInscrire'); // on charge le modele correspondant
    $question = $this->ModelSInscrire->QuestionSecrete();
    //var_dump($question);
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
    $DonneesInjectees=array
    (
      'Questions'=>$Options,
      'reponse'=>"",
      'message'=>"",
    );

    if ( $this->input->post('recupmail'))
    {
      $donneeATester=array(
        'message'=>"",
        'Questions'=>$this->input->post('question'),
        'reponse'=>$this->input->post('reponse'),
      );
      //var_dump($donneeATester);
      $test=$this->ModelSeConnecter->testQuestion_Reponse($donneeATester);

      $mail =  $this->input->post('mail');
      $ancienMDP = $this->ModelSeConnecter->Recup_mdp($mail);
      $MotDePasse =$this->GenererMotDePasse();

      if ($test != 0)
      {
        // if question et reponse ok pour le gens qui correspond à ce mail ...
        if ($ancienMDP['motdepasse']!=null){
          $this->email->from('cartopus22@gmail.com');
          $this->email->to($mail); 
          $this->email->subject('Récupération du mot de passe');
          $this->email->message("Voici votre nouveau mot de passe : ".$MotDePasse."  Pour le modifier rendez vous sur votre compte CartOpus");
          
          $this->ModelSeConnecter->Update_mdp($MotDePasse,$ancienMDP);

          if (!$this->email->send())
          {
              $this->email->print_debugger();
              echo "Error";
          }
          else
          {
          
            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('Visiteur/BarreRecherche');
            $this->load->view('Visiteur/FilActualite'); // accueil Acteur
            $this->load->view('templates/PiedDePage');
          }
        }
        else
        {
          $this->load->view('templates/Entete',$DonnéesTitre);
          $this->load->view('Visiteur/RecupMDP',$DonneesInjectees);
          $this->load->view('templates/PiedDePage');
        }
      }
      else
      {
        $DonneesInjectees=array(
          'Questions'=>$Options,
          'reponse'=>"",
          'message'=>'la question et/ou la réponse ne sont pas correcte(s).',
        );
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Visiteur/RecupMDP',$DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    }
    else
    {
      //var_dump($DonneesInjectees);
      $this->load->view('templates/Entete',$DonnéesTitre);
      $this->load->view('Visiteur/RecupMDP',$DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
  } // fin RecupMDP

  public function SeDeconnecter()
  {
    $this->session->sess_destroy();
    redirect('Visiteur/loadAccueil','refresh');
  } // fin SeDeconnecter

  public function BarreRecherche($Recherche)
  {
    $DonneesTitre = array('TitreDeLaPage'=>'Cart\'Opus');

    if(!($Recherche==NULL)&& !($Recherche==""))
    {
      $config = array();
      $config["Base_url"] = site_url('Visiteur/BarreRecherche/'.$Recherche);
      $config["total_rows"] = $this->ModelRecherche->nombreRecherche($Recherche);
      $config["total_rows"] = $this->ModelRecherche->nombreActeur($Recherche);
      $config["total_rows"] = $this->ModelRecherche->nombreOrganisation($Recherche);
      $config["total_rows"] = $this->ModelRecherche->nombreThematique($Recherche);
      $config["total_rows"] = $this->ModelRecherche->nombreMotCle($Recherche);
      $config["per_page"] = 10;
      $config["uri_segment"] = 3;

      $config['fist_link'] = 'Premier';
      $config['last_link'] = 'Dernier';
      $config['next_link'] = 'Suivant';
      $config['prev_link'] = 'Précédent';

      $this->pagination->initialize($config);

      $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

      $DonneesInjectees['lesActions'] = $this->ModelRecherche->actionRecherche($Recherche, $config['per_page'], $noPage);
      $DonneesInjectees['lesActeurs'] = $this->ModelRecherche->acteurRecherche($Recherche, $config['per_page'], $noPage);
      $DonneesInjectees['lesOrganisations'] = $this->ModelRecherche->organisationRecherche($Recherche, $config['per_page'], $noPage);
      $lesThematiques = $this->ModelRecherche->thematiqueRecherche($Recherche, $config['per_page'], $noPage);
      $lesMotsCles = $this->ModelRecherche->motCleRecherche($Recherche, $config['per_page'], $noPage);
      $DonneesInjectees['lienPagination'] = $this->pagination->create_links();

      if(!empty($lesThematiques))
      {
        foreach($lesThematiques as $uneThematique):
          $exist = FALSE;
          $noAction = $uneThematique['NOACTION'];
  
          if(!empty($DonneesInjectees['lesActions']))
          {
            foreach($DonneesInjectees['lesActions'] as $uneAction):
              // faire test sur les dates de debut
              if ($uneAction['NOACTION']==$noAction)
              {
                $exist = TRUE;
              }
            endforeach;
            if ($exist==FALSE)
            {
              array_push($DonneesInjectees['lesActions'],$uneThematique);
            }
          }
          else
          {
            $DonneesInjectees['lesActions'] = array(0=>$uneThematique);
          } 
        endforeach;
      }
  
      if(!empty($lesMotsCles))
      {
        foreach($lesMotsCles as $unMotCle):
          $exist = FALSE;
          $noAction = $unMotCle['NOACTION'];
  
          if(!empty($DonneesInjectees['lesActions']))
          {
            foreach($DonneesInjectees['lesActions'] as $uneAction):
              // faire test sur les dates de debut
              if ($uneAction['NOACTION']==$noAction)
              {
                $exist = TRUE;
              }
            endforeach;
            if ($exist==FALSE)
            {
              array_push($DonneesInjectees['lesActions'],$unMotCle);
            }
          }
          else
          {
            $DonneesInjectees['lesActions'] = array(0=>$unMotCle);
          } 
        endforeach;
      }

      $this->load->view('templates/Entete',$DonneesTitre);
      $this->load->view('Visiteur/BarreRecherche');
      $this->load->view('Visiteur/Recherche', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
    else 
    {
      $this->load->view('templates/Entete',$DonneesTitre);
      $this->load->view('Visiteur/BarreRecherche');
      $this->load->view('Visiteur/FilActualite');
      $this->load->view('templates/PiedDePage');
    }
  } // fin BarreRecherche

  public function BarreRechercheLieu($Recherche)
  {
    $DonneesTitre = array('TitreDeLaPage'=>'Cart\'Opus');
    
    if(!($Recherche==NULL)&& !($Recherche==""))
    {
      $config = array();
      $config["Base_url"] = site_url('Visiteur/BarreRecherche/'.$Recherche);
      $config["total_rows"] = $this->ModelRecherche->nombreLieu($Recherche);
      $config["per_page"] = 10;
      $config["uri_segment"] = 3;

      $config['fist_link'] = 'Premier';
      $config['last_link'] = 'Dernier';
      $config['next_link'] = 'Suivant';
      $config['prev_link'] = 'Précédent';

      $this->pagination->initialize($config);

      $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

      $lesLieux = $this->ModelRecherche->lieuRecherche($Recherche, $config['per_page'], $noPage);
      
      $DonneesInjectees['lienPagination'] = $this->pagination->create_links();

      //gestion des doublons dans les lieux)
      if(!empty($lesLieux['actions']))
      {
        foreach($lesLieux['actions'] as $Action):
          $exist = FALSE;
          $noAction = $Action['NOACTION'];
  
          if(!empty($DonneesInjectees['lesActions']))
          {
            foreach($DonneesInjectees['lesActions'] as $uneAction):
              // faire test sur les dates de debut
              if ($uneAction['NOACTION']==$noAction)
              {
                $exist = TRUE;
              }
            endforeach;
            if ($exist==FALSE)
            {
              array_push($DonneesInjectees['lesActions'],$Action);
            }
          }
          else
          {
            $DonneesInjectees['lesActions'] = array(0=>$Action);
          } 
        endforeach;
      }
  
      if(!empty($lesLieux['organisations']))
      {
        foreach($lesLieux['actions'] as $Organisation):
          $exist = FALSE;
          $noAction = $Organisation['NOACTION'];
  
          if(!empty($DonneesInjectees['lesActions']))
          {
            foreach($DonneesInjectees['lesActions'] as $uneAction):
              // faire test sur les dates de debut
              if ($uneAction['NOACTION']==$noAction)
              {
                $exist = TRUE;
              }
            endforeach;
            if ($exist==FALSE)
            {
              array_push($DonneesInjectees['lesActions'],$Organisation);
            }
          }
          else
          {
            $DonneesInjectees['lesActions'] = array(0=>$Organisation);
          } 
        endforeach;
      }


      $this->load->view('templates/Entete',$DonneesTitre);
      $this->load->view('Visiteur/BarreRecherche');
      $this->load->view('Visiteur/Recherche', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
    else 
    {
      $this->load->view('templates/Entete',$DonneesTitre);
      $this->load->view('Visiteur/BarreRecherche');
      $this->load->view('Visiteur/FilActualite');
      $this->load->view('templates/PiedDePage');
    }
  }

  public function Rechercher()
  {
    $recherche = false;
    $lesLieux = null;
    $DonneesTitre = array('TitreDeLaPage'=>'Cart\'Opus');

    $RechercheMotCle = $this->input->post('MotCle');
    $RechercheLieu = $this->input->post('MotCle');

    $config = array();
    $config["Base_url"] = site_url('Visiteur/Rechercher');

    $config["per_page"] = 10;
    $config["uri_segment"] = 3;

    $config['fist_link'] = 'Premier';
    $config['last_link'] = 'Dernier';
    $config['next_link'] = 'Suivant';
    $config['prev_link'] = 'Précédent';

    $this->pagination->initialize($config);

    $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
    $DonneesInjectees['lienPagination'] = $this->pagination->create_links();

    if($this->input->post('RechercheAvancee'))
    {
      $DateDebut = $this->input->post('DateD').' '.$this->input->post('HeureD');
      $DateFin = $this->input->post('DateF').' '.$this->input->post('HeureF');

      if($DateDebut != null && $DateFin != null)
      {
        $config["total_rows"] = $this->ModelRecherche->nombrePeriode($DateDebut, $DateFin);

        $lesDates = $this->ModelRecherche->periodeRecherche($DateDebut, $DateFin, $config['per_page'], $noPage);
      }
      else if($DateDebut != null)
      {
        $config["total_rows"] = $this->ModelRecherche->nombreDateDebut($DateDebut);

        $lesDates = $this->ModelRecherche->dateDebutRecherche($DateDebut, $config['per_page'], $noPage);
      }
      else if($DateFin != null)
      {
        $config["total_rows"] = $this->ModelRecherche->nombreDateFin($DateFin);

        $lesDates = $this->ModelRecherche->dateFinRecherche($DateFin, $config['per_page'], $noPage);
      }

    }

    if(!empty($RechercheMotCle))
    {
      $config["total_rows"] = $this->ModelRecherche->nombreRecherche($RechercheMotCle);
      $config["total_rows"] = $this->ModelRecherche->nombreActeur($RechercheMotCle);
      $config["total_rows"] = $this->ModelRecherche->nombreOrganisation($RechercheMotCle);
      $config["total_rows"] = $this->ModelRecherche->nombreThematique($RechercheMotCle);
      $config["total_rows"] = $this->ModelRecherche->nombreMotCle($RechercheMotCle);

      $DonneesInjectees['lesActions'] = $this->ModelRecherche->actionRecherche($RechercheMotCle, $config['per_page'], $noPage);
      $DonneesInjectees['lesActeurs'] = $this->ModelRecherche->acteurRecherche($RechercheMotCle, $config['per_page'], $noPage);
      $DonneesInjectees['lesOrganisations'] = $this->ModelRecherche->organisationRecherche($RechercheMotCle, $config['per_page'], $noPage);
      $lesThematiques = $this->ModelRecherche->thematiqueRecherche($RechercheMotCle, $config['per_page'], $noPage);
      $lesMotsCles = $this->ModelRecherche->motCleRecherche($RechercheMotCle, $config['per_page'], $noPage);

      $recherche = true;

    }

    if(!empty($RechercheLieu))
    {
      $config["total_rows"] = $this->ModelRecherche->nombreLieu($RechercheLieu);
      
      $lesLieux = $this->ModelRecherche->lieuRecherche($RechercheLieu, $config['per_page'], $noPage);
    }

    if(!empty($lesThematiques))
    {
      foreach($lesThematiques as $uneThematique):
        $exist = FALSE;
        $noAction = $uneThematique['NOACTION'];

        if(!empty($DonneesInjectees['lesActions']))
        {
          foreach($DonneesInjectees['lesActions'] as $uneAction):
            // faire test sur les dates de debut
            if ($uneAction['NOACTION']==$noAction)
            {
              $exist = TRUE;
            }
          endforeach;
          if($exist==FALSE)
          {
            array_push($DonneesInjectees['lesActions'],$uneThematique);
          }
        }
        else
        {
          $DonneesInjectees['lesActions'] = array(0=>$uneThematique);
        } 
      endforeach;
      $recherche = true;
    }

    if(!empty($lesMotsCles))
    {
      foreach($lesMotsCles as $unMotCle):
        $exist = FALSE;
        $noAction = $unMotCle['NOACTION'];

        if(!empty($DonneesInjectees['lesActions']))
        {
          foreach($DonneesInjectees['lesActions'] as $uneAction):
            // faire test sur les dates de debut
            if ($uneAction['NOACTION']==$noAction)
            {
              $exist = TRUE;
            }
          endforeach;
          if ($exist==FALSE)
          {
            array_push($DonneesInjectees['lesActions'],$unMotCle);
          }
        }
        else
        {
          $DonneesInjectees['lesActions'] = array(0=>$unMotCle);
        } 
      endforeach;
      $recherche = true;
    }

    if(!empty($lesLieux) || $lesLieux != null)
    {
      if(!empty($lesLieux['actions']))
      {
        foreach($lesLieux['actions'] as $Action):
          $exist = FALSE;
          $noAction = $Action['NOACTION'];

          if(!empty($DonneesInjectees['lesActions']))
          {
            foreach($DonneesInjectees['lesActions'] as $uneAction):
              // faire test sur les dates de debut
              if ($uneAction['NOACTION']==$noAction)
              {
                $exist = TRUE;
              }
            endforeach;
            if ($exist==FALSE)
            {
              array_push($DonneesInjectees['lesActions'],$Action);
            }
          }
          else
          {
            $DonneesInjectees['lesActions'] = array(0=>$Action);
          } 
        endforeach;
        $recherche = true;
      }

      if(!empty($lesLieux['organisations']))
      {
        foreach($lesLieux['organisations'] as $Organisation):
          $exist = FALSE;
          $noOrganisation = $Organisation['NO_ORGANISATION'];

          if(!empty($DonneesInjectees['lesOrganisations']))
          {
            foreach($DonneesInjectees['lesOrganisations'] as $uneOrganisation):
              // faire test sur les dates de debut
              if ($uneOrganisation['NO_ORGANISATION']== $noOrganisation)
              {
                $exist = TRUE;
              }
            endforeach;
            if ($exist==FALSE)
            {
              array_push($DonneesInjectees['lesOrganisations'],$Organisation);
            }
          }
          else
          {
            $DonneesInjectees['lesOrganisations'] = array(0=>$Organisation);
          } 
        endforeach;
        $recherche = true;
      }
    }

    if(isset($lesDates))
    {
      if(!empty($lesDates))
      {
        foreach($lesDates as $uneDate):
          $exist = FALSE;
          $noAction = $uneDate['NOACTION'];
  
          if(!empty($DonneesInjectees['lesActions']))
          {
            foreach($DonneesInjectees['lesActions'] as $uneAction):
              // faire test sur les dates de debut
              if ($uneAction['NOACTION']==$noAction)
              {
                $exist = TRUE;
              }
            endforeach;
            if ($exist==FALSE)
            {
              array_push($DonneesInjectees['lesActions'],$uneDate);
            }
          }
          else
          {
            $DonneesInjectees['lesActions'] = array(0=>$uneDate);
          } 
        endforeach;
        $recherche = true;
      }
    }

    //var_dump($recherche);
    if($recherche == false)
    {
      redirect('Visiteur/loadAccueil');
    }
    else
    {
      $this->load->view('templates/Entete',$DonneesTitre);
      $this->load->view('Visiteur/BarreRecherche');
      $this->load->view('Visiteur/Recherche', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
  }

  public function AfficherOrga($noOrganisation)
  {
    $DonneesTitre = array('TitreDeLaPage'=>'Cart\'Opus');

    if(!empty($noOrganisation))
    {
      $DonneesInjectees['lesOrganisations'] = $this->ModelOrga->getOrgaSimple($noOrganisation);
      $DonneesInjectees['lesSecteurs'] = $this->ModelOrga->getSecteur($noOrganisation);
      $DonneesInjectees['lesActeurs'] = $this->ModelOrga->getSecteur($noOrganisation);
    }
    
    $this->load->view('templates/Entete', $DonneesTitre);
    $this->load->view('Visiteur/AfficherOrga', $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
  }

  public function AfficherAction($noAction)
  {
      $Where = array('a.noAction'=>$noAction);
      $Actions = $this->ModelAction->getAction($Where);
      //$Commentaire = $this->input->post('Commentaire');

      $DateDebut=$Actions[0]['DATEDEBUT'];
      
      $Donnes = array('NOACTION'=>$noAction,'DATEACTION'=>$DateDebut,);
      $Fichiers = $this->ModelAction->getFichersPourAction($Donnes);

      $Signalements = $this->ModelAction->getSignalements();
      //var_dump($Signalements);
      foreach($Signalements as $unSignalement)
      {
        if(empty($Options))
        {
            $Options = array(($unSignalement['noSignalement'] == 0)=>$unSignalement['libelleSignalement']);
        }
        else
        {
            $temporaire = array($unSignalement['noSignalement']=>$unSignalement['libelleSignalement']);
            $Options = $Options + $temporaire;
        }
      }

      if(empty($Fichiers))
      {
          
          $Données = array(
              'Actions'=>$Actions,
              'Options'=>$Options,
          );
      }
      else
      {
          $Données = array(
              'Actions'=>$Actions,
              'Fichiers'=>$Fichiers,
              'Options'=>$Options,
          );
      }
      
      $DonnéesTitre = array('TitreDeLaPage'=>$Actions[0]['NOMACTION']);
      
      $Données['lesVisiteurs'] = $this->ModelCommentaire->getCommentaires($noAction);
      $Données['lesMotCles'] = $this->ModelAction->getMotClePourAction($noAction);
      $Données['lesPartenaires'] = $this->ModelAction->getPartenaire($noAction);

      $this->load->view('templates/Entete',$DonnéesTitre);
      $this->load->view('Visiteur/AfficherAction',$Données);
      $this->load->view('templates/PiedDePage');
  }

  public function AfficherActeurAction($noActeur)
  {
    
      $Acteur = $this->ModelActeur->getActeur($noActeur);
      //var_dump( $Acteur);
      //On va chercher les information concernant l'acteur connecté dans la BDD 
      
      $Organisation = $this->ModelActeur->getOrganisation($noActeur);
      //on va chercher les information concernant l'organisation à laquelle appartient l'acteur connecté
      //il se peut que cette variable soit "null", auquel cas il faut mettre une condition dans la view
      // pour ne pas tenter de l'afficher s'l n'y a rien de dedans ^^ 

      $Action = $this->ModelActeur->getActions($noActeur);
      //Même topo que pour $Organisation
      //var_dump($Action);
      if ($Action==null)
      {
          $this->session->nbaction=0;
      }
      else
      {
          $this->session->nbaction=1;
      }

      $Données = array(
          'Acteur'=>$Acteur[0],
          'Organisation'=> $Organisation,
          'Action'=> $Action,
      );
      $DonnéesTitre = array('TitreDeLaPage'=>'Cart\'Opus');
      
      $this->load->view('templates/Entete',$DonnéesTitre);
      $this->load->view('Visiteur/AfficherActeurAction',$Données);
      $this->load->view('templates/PiedDePage');

  }

  public function AjouterCommentaire($noAction)
  {
    if($this->input->post('Commenter'))
    {
      $Commentaire = $this->input->post('Commentaire');
      $noVisiteur = $this->session->noVisiteur;
      $toDay = date('Y-m-d H:i:s');
      $Action=$this->ModelAction->getActionSimple($noAction);

      $donneeAinserer = array
      (
        'DateHeure' => $toDay,
        'NoAction' => $noAction,
        'NoVisiteur' => $noVisiteur,
        'Commentaire' => $Commentaire,
      );
      
      $DonneesInjectees = $this->ModelCommentaire->insererCommentaireVisiteur($donneeAinserer);
      redirect('Visiteur/AfficherAction/'.$noAction);
    }
    else
    {
      redirect('Visiteur/AfficherAction/'.$noAction);
    }
  }

  
  public function AjouterSignalements($noAction)
  {
    //insertion
    if($this->input->post('Signaler'))
    {
      $Action = $this->ModelAction->getActionSimple($noAction);
      $Signalement = $this->input->post('Signalements');
      $Commentaire = $this->input->post('Commentaire');
      $toDay = date('Y-m-d H:i:s');
    
      $donneeAinserer = array
      (
        'noAction' => $noAction,
        'noSignalement' => $Signalement,
        'commentaire' => $Commentaire,
        'DateSignalement' => $toDay,
      );
      
      $DonneesInjectees = $this->ModelAction->insererSignalement($donneeAinserer);
      redirect('Visiteur/AfficherAction/'.$noAction);
    }
    else
    {
      redirect('Visiteur/AfficherAction/'.$noAction);
    }
  }

  public function AjouterSignalementsComm($noAction,$noCommentaire,$acteur)
  {
    //insertion
    if($this->input->post('SignalerComm'))
    {
      //$Action = $this->ModelCommentaire->getCommentaires($noAction);
      $SignalementComm = $this->input->post('SignalementsComm');
      $CommentaireComm = $this->input->post('CommentaireComm');
      $toDay = date('Y-m-d H:i:s');
    
      
      $donneeAinserer = array
      (
        'noCommentaire'=>$noCommentaire,
        'DateSignalComm' => $toDay,
        'motifSignalement' => $CommentaireComm,
        'noSignalement' => $SignalementComm,
        'acteur'=>$acteur,
      );
      
      $DonneesInjectees = $this->ModelCommentaire->insererSignalementComm($donneeAinserer);
      redirect('Visiteur/AfficherAction/'.$noAction);
    }
    else
    {
      redirect('Visiteur/AfficherAction/'.$noAction);
    }
  }

}//Fin Visiteur

?>