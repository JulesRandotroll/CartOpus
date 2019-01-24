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

      $this->load->model('ModelRecherche');
      $this->load->library("pagination");
  } // __construct

  public function loadAccueil()
  {
    $DonneesTitre = array('TitreDeLaPage'=>'Cart\'Opus');

    if ($this->session->statut==null)
    {
      $this->session->statut = 0;
    }

    $Where = array(
      'a.Favoris'=>true,
    );
  
    if($this->session->flashdata('message')!=null)
    {
      $DonneesInjectees=array(
        'message'=>$this->session->flashdata('message'),
        'lesFavoris'=> $this->ModelAction->getActionFavorite($Where),
      );

      $this->load->view('templates/Entete',$DonneesTitre);
      $this->load->view('Visiteur/BarreRecherche',$this->session->statut);
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
    $DonnéesTitre = array('TitreDeLaPage'=>'Inscription');
    if ( $this->input->post('valider'))//si le bouton "Valider l'inscription" a été cliqué ...
    {
      if (($this->input->post('mdp'))==($this->input->post('confmdp')))// si ce que l'utilisateur a rentré dans la case mdp est égale a ce qu'il a rentré dans la case confmdp ...
      {
        $donneeATester=$this->input->post('mail');// dans la variable donneeATester on met le mail rentré par l'utilisateur
        $test = $this->ModelSInscrire->Test_Inscrit($donneeATester);// on appelle la fonction Test de ce modele et on passe la variable a tester en paramètre
  
        if($test['count(*)']!=0) // si la fonction nous retourne un résultat différent de 0 ( si ce mail existe déjà dans la bdd ...)
        {
          $Options= $this->ObtenirQuestions_Secretes();
          $DonneesInjectees=array
          (
            'nom'=>'',
            'prenom'=>'',
            'mail'=>'',
            'tel' =>'',
            'message' => 'Vous êtes déjà inscrit avec cette adresse mail',
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

          $donneeAinserer=array(
          'noprofil'=>'1',
          'nomacteur'=>$this->input->post('nom'),
          'prenomacteur'=>$this->input->post('prenom'),
          'motdepasse'=>$this->input->post('mdp'),
          'mail' => $this->input->post('mail'),
          'notel' => $this->input->post('tel'),
          'photoprofil'=>'4pPaR31L_1Ph20T.png',
          'noquestion'=>$this->input->post('question'),
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
      }// if mdp== confmdp
      else //sinon ...
      {
        $Options= $this->ObtenirQuestions_Secretes();

        $DonneesInjectees=array(
          'nom'=>$this->input->post('nom'),
          'prenom'=>$this->input->post('prenom'),
          'mail' => $this->input->post('mail'),
          'tel' => $this->input->post('tel'),
          'mailvisible'=>false,
          'telvisible'=>false,
          'reponse'=>$this->input->post('rep'),
          'Questions'=>$Options,
          'message' => 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit'
        );

        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
        $this->load->view('templates/PiedDePage');
        //echo 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit';
      }
    }// if bouton valider
    else //sinon ...
    {
      $Options= $this->ObtenirQuestions_Secretes();
      
      $DonneesInjectees=array
      (
        'nom'=>"",
        'prenom'=>"",
        'mail' =>"",
        'tel' => "",
        'message'=>'',
        'reponse'=>'',
        'Questions'=>$Options,
        'mailvisible'=>false,
        'telvisible'=>false,
      );
      
      // var_dump($DonneesInjectees);
      $this->load->view('templates/Entete',$DonnéesTitre);
      $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
  } // fin SInscrire

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
    $DonneesInjectees['Titre de la page']='Connexion';
    if ( $this->input->post('submit'))
    {
      $donneesATester=array
      (
        'mail'=>$this->input->post('mail'),
        'motdepasse'=>$this->input->post('mdp'),
        'Finaliser'=>true,
      );
      
      $test = $this->ModelSeConnecter->Test_Inscrit($donneesATester);
      // echo'deja inscrit ?';
      // var_dump($test);
      if($test['count(*)']==0)
      {
        
        if ($this->session->statut==0) // 0 : statut visiteur
        {
          $message=array(
            'message'=>'Vous n\'êtes pas encore inscrit',
          );
          // var_dump($message);
          $this->load->view('templates/Entete',$DonnéesTitre);
          $this->load->view('Visiteur/SeConnecter',$message);
          $this->load->view('templates/PiedDePage');
        
        }
      }
      else
      {
        $noprofil = $this->ModelSeConnecter->GetNoProfil($donneesATester);
        $this->session->statut=$noprofil[0]['NoProfil'];
        $noActeur = $this->ModelSeConnecter->GetNoActeur($donneesATester);
        $this->session->noActeur=$noActeur[0]['NoActeur'];

        if ($this->session->statut==1)
        {
          //var_dump($noActeur);
          redirect('Acteur/AccueilActeur');
        }
        if ($this->session->statut==4)
        {
          echo'admin valider';
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
        //redirect(site_url('Visiteur/loadAccueil'));
        //redirect('Visiteur/loadAccueil');
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
    
    $DonneesTitre = array('TitreDeLaPage'=>'Cart\'Opus');

    $RechercheMotCle = $this->input->post('MotCle');
    $RechercheLieu = $this->input->post('Lieu');

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

    }

    if(!empty($RechercheLieu))
    {
      $config["total_rows"] = $this->ModelRecherche->nombreLieu($RechercheLieu);
      
      $lesLieux = $this->ModelRecherche->lieuRecherche($RechercheLieu, $config['per_page'], $noPage);
    }

    //tests des doublons et création des 3 Tableaux finaux ET vérification de l'existence de résultats
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
      $recherche = true;
    }

    if(!empty($lesMotsCles))
    {
      var_dump($lesMotsCles);
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

  //Penser à refaire "Afficher Acteur" 

}//Fin Visiteur

?>