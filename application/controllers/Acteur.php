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
        //A RETIRER UNE FOIS LA CONNEXION OK
           $this->session->noActeur = 1;
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
            'Acteur'=>$Acteur,
            'Organisation'=> $Organisation,
            'Action'=> $Action,
        );
        $this->load->view('templates/Entete');
        $this->load->view('Acteur/AccueilActeur',$Données);
        $this->load->view('templates/PiedDePage');
        
    }


}