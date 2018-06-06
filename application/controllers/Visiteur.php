<?php 

class Visiteur extends CI_Controller 
{

    public function __construct()
    {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper('assets'); // helper 'assets' ajouté a Application
       $this->load->library("pagination");
       //$this->load->model('ModeleArticle'); // chargement modèle, obligatoire
       //$this->load->model('ModeleUtilisateur');
    } // __construct

    public function loadAccueil()
    {
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/Accueil');
        $this->load->view('templates/PiedDePage');
    }


}//Fin Visiteur

?>