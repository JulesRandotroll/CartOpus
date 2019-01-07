<?php
class SuperAdmin extends CI_Controller {

    public function __construct()
    {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper('assets'); // helper 'assets' ajouté a Application
       $this->load->library("pagination");
       $this->load->library('email');
       $this->load->library('table');
       $this->load->helper('form');
       $this->load->model('ModelActeur');
       $this->load->model('ModelThematique');
       $this->load->library('session');
    } // __construct

    public function AccueilSuperAdmin()
    {
        $DonnéesTitre = array('TitreDeLaPage'=>'Accueil');
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('SuperAdmin/AccueilSuperAdmin');
        $this->load->view('templates/PiedDePage');
     
    }

    public function AffecterProfil($noActeur)
    {
        
        $noProfil=5;
        $result5=$this->ModelActeur->GetProfil($noProfil);
        $noProfil=4;
        $result4=$this->ModelActeur->GetProfil($noProfil);
        $noProfil=1||2||3;
        $result=$this->ModelActeur->GetProfil($noProfil);
        //var_dump($result);
        $DonnéesAInjectées=array
        (
            'SuperAdmin'=>$result5,
            'AdminValider'=>$result4,
            'Acteur'=>$result,
        );

        //var_dump($DonnéesAInjectées);
        $DonnéesTitre = array('TitreDeLaPage'=>'Affecter Profil');
        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('SuperAdmin/AffecterProfil', $DonnéesAInjectées);
        if($noActeur != 0)
        {
            $Profils = $this->ModelActeur->getProfils();
            $Acteur = $this->ModelActeur->getActeur($noActeur);
            $DonnéesAModifier = array(
                'Acteur'=>$Acteur[0],
                'Profils'=>$Profils,
            );
           
            $this->load->view('SuperAdmin/ModifierProfil', $DonnéesAModifier);
        }
        $this->load->view('templates/PiedDePage');
    }

    public function ModifierProfil()
    {
        if($this->input->post('Modifier'))
        {
            $noProfil = $this->input->post('Profil').'<BR>';
            $noActeur = $this->input->post('noActeur');
            $this->ModelActeur->setProfil($noActeur,$noProfil);
        }
        
        $this->AffecterProfil(0);  
    }

    public function AjouterThematique()
    {
        $thematiques = $this->ModelThematique->getThematiques();
        //var_dump($thematiques);
        $DonnéesTitre = array('TitreDeLaPage'=>'Ajout thématique');

        $Données=array('Thematique'=>$thematiques);

        $this->load->view('templates/Entete',$DonnéesTitre);
        $this->load->view('SuperAdmin/AjouterThematique',$Données);
        $this->load->view('templates/PiedDePage');
     
    }

}