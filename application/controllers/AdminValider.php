<?php 

class AdminValider extends CI_Controller
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
        $this->load->library("pagination");

        if($this->session->statut < 4)
        {
            redirect('Visiteur/loadAccueil');
        }

    } // __construct

    public function AccueilAdminValider()
    {
        $DonneesTitre = array('TitreDeLaPage'=>'Accueil');
        $this->load->view('templates/Entete',$DonneesTitre);
        $this->load->view('AdminValider/AccueilAdminValider');
        $this->load->view('templates/PiedDePage');
    }

    public function GererFilActu()
    {

        $Where = array(
            'a.Favoris'=>true,
        );

        $DonneesInjectees = array(
            'lesActions'=> $this->ModelAction->getActions(),
            'lesFavoris'=> $this->ModelAction->getActionFavorite($Where)
        );

        $DonneesTitre = array('TitreDeLaPage'=>'Gérer Fil Actu');
        $this->load->view('templates/Entete',$DonneesTitre);
        $this->load->view('AdminValider/GererFilActu',$DonneesInjectees);
        //$this->load->view('Visiteur/FilActualite', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
    }

    public function ChangerFavoris($noAction,$Favoris)
    {
        //echo $noAction.' '.$Favoris ;
        $Where = array('noAction'=>$noAction);
        if($Favoris == 'true')
        {
            $Set = array('Favoris'=>true);
        }
        else
        {
            $Set = array('Favoris'=>false);
        }
        
        $this->ModelAction->setFavoris($Where,$Set);

        redirect('AdminValider/GererFilActu');
    }

    public function GererMotCles()
    {
        $DonneesTitre = array('TitreDeLaPage'=>'Gérer mots cles');
        $this->load->view('templates/Entete',$DonneesTitre);
        $this->load->view('AdminValider/GererMotCles');
        //$this->load->view('Visiteur/FilActualite', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
    }

}





/*
    Comme le disait la maraine de la soeur du beau frère de ma mère : 
    "Entre la culture des perles fine et ce qui perle l'inculture, 
    un point commun domine : 
    C'est le QI de l'huitre"

    Heu... tu t'es sentie visée ? 
    Oui
    Hé bien c'est fait exprès !! 

*/
?>