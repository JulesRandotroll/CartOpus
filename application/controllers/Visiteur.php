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
    } // __construct

    public function loadAccueil()
    {
        if ($this->input->post('submit'))
        {
            //coucou
        }
        else
        {
            //$this->load->library('calendar');
            $this->load->view('templates/Entete');
            $this->load->view('Visiteur/Accueil');
            $this->load->view('templates/PiedDePage');
        }
    }
    public function SInscrire()
    {
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
              $DonneesInjectees=array
              (
                'nomacteur'=>$this->input->post('nom'),
                'prenomacteur'=>$this->input->post('prenom'),
                'notel' => $this->input->post('tel'),
                'message' => 'Vous êtes déjà inscrit avec cette adresse mail'
              );
    
               $this->load->view('templates/Entete');
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
              );
              $this->load->model('ModelSInscrire');
              $test = $this->ModelSInscrire->Insert_Acteur($donneeAinserer);
              $this->load->view('templates/Entete');
              $this->load->view('Visiteur/Accueil');
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
           $this->load->view('templates/Entete');
           $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
           $this->load->view('templates/PiedDePage');
           //echo 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit';
          }
        }// if bouton valider
        else //sinon ...
        {
         $DonneesInjectees=array
         (
           'nom'=>"",
           'prenom'=>"",
           'mail' =>"",
           'tel' => "",
           'message'=>'',
         );
          $this->load->view('templates/Entete');
          $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
          $this->load->view('templates/PiedDePage');
        }
    }// fin function
    
    public function SeConnecter()
    {
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
          'mdp'=>$this->input->post('mdp'),
        );
        $test = $this->ModelSeConnecter->Test_Inscrit($donneesATester);
        var_dump($test);
        if($test['count(*)']==0){
          
          if ($this->session->statut==0) // 0 : statut visiteur
          {
            $message=array(
              'message'=>'Vous n\'êtes pas encore inscrit',
            );
            var_dump($message);
            $this->load->view('templates/Entete');
            $this->load->view('Visiteur/SeConnecter',$message);
            $this->load->view('templates/PiedDePage');
         
          }
        }
        else
        {
          $noprofil = $this->ModelSeConnecter->GetNoProfil($donneesATester);
          var_dump($noprofil);  
          $this->session->statut=$noprofil;
          var_dump($this->session->statut);
          if ($this->session->statut==1)
          {
            redirect('Acteur/AccueilActeur');
          }
          if ($this->session->statut==4)
          {

          }
          if ($this->session->statut==5)
          {

          }
          //redirect(site_url('Visiteur/loadAccueil'));
          //redirect('Visiteur/loadAccueil');
        }
      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/SeConnecter',$message);
        $this->load->view('templates/PiedDePage');
      }
    }

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
    }
   
    public function RecupMDP()
    {
      $mail =  $this->input->post('mail');
      $ancienMDP = $this->ModelSeConnecter->Recup_mdp($mail);
      $MotDePasse =$this->GenererMotDePasse();
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
          $this->load->view('templates/Entete');
          $this->load->view('Visiteur/Accueil'); // accueil Acteur
          $this->load->view('templates/PiedDePage');
        }
      }
      else
      {
      $this->load->view('templates/Entete');
      $this->load->view('Visiteur/RecupMDP');
      $this->load->view('templates/PiedDePage');
      }
    }



}//Fin Visiteur

?>