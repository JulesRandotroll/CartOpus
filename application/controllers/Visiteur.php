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
       //$this->load->model('ModeleArticle'); // chargement modèle, obligatoire
       //$this->load->model('ModeleUtilisateur');
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
        if ( $this->input->post('valider'))
        {
          if (($this->input->post('mdp'))==($this->input->post('confmdp')))
          {
            $donneeATester=$this->input->post('mail');
            $this->load->model('ModelSInscrire');
            $test = $this->ModelSInscrire->Test_Inscrit($donneeATester);
            if($test['count(*)']!=0)
            {
              $DonneesInjectees=array
              (
                'nom'=>$this->input->post('nom'),
                'prenom'=>$this->input->post('prenom'),
                'datenaiss'=>$this->input->post('datenaiss'),// la traduire à l'envers pour la bdd
                'sexe'=>$this->input->post('sexe'),
                'nomequipe'=>$this->input->post('nomequipe'),
                'mail' =>"" ,
                'tel' => $this->input->post('tel'),
                'message' => 'Vous êtes déjà inscrit avec cette adresse mail'
              );
    
               $this->load->view('templates/Entete');
               //var_dump($DonneesInjectees);
               $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
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
              );
              $this->load->model('ModelSInscrire');
              $test = $this->ModelSInscrire->Insert_Acteur($donneeAinserer);
            }
          }// if mdp== confmdp
          else
          {
            $DonneesInjectees=array(
             'nom'=>$this->input->post('nom'),
             'prenom'=>$this->input->post('prenom'),
             'mail' => $this->input->post('mail'),
             'tel' => $this->input->post('tel'),
             'message' => 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit'
            );
           $this->load->view('templates/Entete');
           //var_dump($DonneesInjectees);
           $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
           $this->load->view('templates/PiedDePage');
           //echo 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit';
          }
        }// if bouton valider
        else
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
      $DonneesInjectees['Titre de la page']='Inscription';
      if ( $this->input->post('submit'))
      {

      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/SeConnecter');
        $this->load->view('templates/PiedDePage');
      }
    }


    public function GetActionRecherchee()
    {
        //if(isset())
    }


}//Fin Visiteur

?>