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
       $this->load->library('session');

       $this->load->model('ModelRecherche');
       $this->load->library("pagination");
    } // __construct

    public function loadAccueil()
    {
      if ($this->session->statut==null)
      {
        $this->session->statut = 0;
      }
      //var_dump($this->session->statut);
      if ($this->input->post('submit'))
      {
        $Recherche =$this->input->post('MotCle');
        //$Recherche =$this->input->post('Lieu');
        redirect('Visiteur/BarreRecherche/'.$Recherche);
      }
      else if($this->input->post('submit_lieu'))
      {
        $Recherche =$this->input->post('Lieu');

        redirect('Visiteur/BarreRechercheLieu/'.$Recherche);
      }
      else
      {
        $DonneesTitre = array('TitreDeLaPage'=>'Cart\'Opus');
        
        $this->load->view('templates/Entete',$DonneesTitre);
        $this->load->view('Visiteur/Accueil',$this->session->statut);
        $this->load->view('templates/PiedDePage');
      }
    } //fin loadAccueil

    public function SInscrire()
    {

        $DonnéesTitre = array('TitreDeLaPage'=>'Inscription');
        $DonneesInjectees['Titre de la page']='Inscription';


       

        if ( $this->input->post('valider'))//si le bouton "Valider l'inscription" a été cliqué ...
        {
          if (($this->input->post('mdp'))==($this->input->post('confmdp')))// si ce que l'utilisateur a rentré dans la case mdp est égale a ce qu'il a rentré dans la case confmdp ...
          {
            $donneeATester=$this->input->post('mail');// dans la variable donneeATester on met le mail rentré par l'utilisateur
            $this->load->model('ModelSInscrire'); // on charge le modele correspondant
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
                'reponse'=>'',
              );
              
               $this->load->view('templates/Entete',$DonnéesTitre);
               $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
               $this->load->view('templates/PiedDePage');
            }
            else // sinon on insert les bonnes valeurs dans la base de donnée
            {
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
              );
              //var_dump($donneeAinserer);

              $this->load->model('ModelSInscrire');
              $test = $this->ModelSInscrire->Insert_Acteur($donneeAinserer);
              $this->load->view('templates/Entete',$DonnéesTitre);
              $this->load->view('Visiteur/Accueil',$this->session->statut);
              $this->load->view('templates/PiedDePage');
            }
          }// if mdp== confmdp
          else //sinon ...
          {
            $DonneesInjectees=array(
             'nom'=>$this->input->post('nom'),
             'prenom'=>$this->input->post('prenom'),
             'mail' => $this->input->post('mail'),
             'tel' => $this->input->post('tel'),
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
            );
          
         // var_dump($DonneesInjectees);
          $this->load->view('templates/Entete',$DonnéesTitre);
          $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
          $this->load->view('templates/PiedDePage');
        }
    } // fin SInscrire
    
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
          //var_dump($question);
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
          //adresse mail saisie par l'utilisateur.
          'mdp'=>$this->input->post('mdp'),
        );
        $test = $this->ModelSeConnecter->Test_Inscrit($donneesATester);
       // echo'deja inscrit ?';
       // var_dump($test);
        if($test['count(*)']==0){
          
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
                $this->load->view('Visiteur/Accueil'); // accueil Acteur
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
        //$config["total_rows"] = $this->ModelRecherche->nombreLieu($Recherche);
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
        $DonneesInjectees['lesThematiques'] = $this->ModelRecherche->thematiqueRecherche($Recherche, $config['per_page'], $noPage);
        $DonneesInjectees['lesMotsCles'] = $this->ModelRecherche->motCleRecherche($Recherche, $config['per_page'], $noPage);
        $DonneesInjectees['lienPagination'] = $this->pagination->create_links();
        

        //traitement des doublons !!!
        // var_dump($DonneesInjectees['lesActions']);
        // echo('lesThematiques');
        // var_dump($DonneesInjectees['lesThematiques']);

        if(!empty($DonneesInjectees['lesThematiques']))
        {
          foreach($DonneesInjectees['lesThematiques'] as $uneThematique):
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


        if(!empty($DonneesInjectees['lesMotsCles']))
        {
          foreach($DonneesInjectees['lesMotsCles'] as $unMotCle):
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

        //echo('final');
        //var_dump($DonneesInjectees['lesActions']);

        $this->load->view('templates/Entete',$DonneesTitre);
        $this->load->view('Visiteur/Accueil', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      
      }
      else 
      {
        $this->load->view('templates/Entete',$DonneesTitre);
        $this->load->view('Visiteur/Accueil');
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

        $DonneesInjectees['lesLieux'] = $this->ModelRecherche->lieuRecherche($Recherche, $config['per_page'], $noPage);
        
        $DonneesInjectees['lienPagination'] = $this->pagination->create_links();

        //gestion des doublons dans les lieux (bon courage  :) )

        if(!empty($DonneesInjectees['lesLieux']['actions']))
        {
          foreach($DonneesInjectees['lesLieux']['actions'] as $Action):
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

        if(!empty($DonneesInjectees['lesLieux']['organisations']))
        {
          foreach($DonneesInjectees['lesLieux']['actions'] as $Organisation):
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
        $this->load->view('Visiteur/Accueil', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      
      }
      else 
      {
        $this->load->view('templates/Entete',$DonneesTitre);
        $this->load->view('Visiteur/Accueil');
        $this->load->view('templates/PiedDePage');
      }
    }
}//Fin Visiteur

?>