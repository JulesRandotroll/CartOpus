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
       if ($this->session->statut!=5)
        {
            redirect('Visiteur/loadAccueil');
        };
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
        $noProfil=1;
        $result1=$this->ModelActeur->GetProfil($noProfil);
        $noProfil=0;
        $result0=$this->ModelActeur->GetProfil($noProfil);
        //var_dump($result);
        $DonnéesAInjectées=array
        (
            'SuperAdmin'=>$result5,
            'AdminValider'=>$result4,
            'Acteur'=>$result1,
            'Visiteur'=>$result0,
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

    public Function AfficherThematique()
    {
        $thematiques = $this->ModelThematique->getSurThematiques();
            //var_dump($thematiques);
            $DonnéesTitre = array('TitreDeLaPage'=>'Ajout thématique');

            $Données=array('Thematique'=>$thematiques);

            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('SuperAdmin/AjouterThematique',$Données);
            $this->load->view('templates/PiedDePage');
        
    }

    public function AjouterThematique()
    {
        if($this->input->post('AjoutThematique'))
        {
            $ThematiqueAInserer = $this->input->post('nouvellethematique');
            $Donnees=array('NOMTHEMATIQUE'=>$ThematiqueAInserer);
            $Thematiques = $this->ModelThematique->getThematiquesExiste($Donnees);
            if(empty($Thematiques))
            {
                $this->ModelThematique->InsererThematique($Donnees);
            }
            else
            {
                echo '<script>alert("Cette Thematique existe déjà")</script>';
            }
            $this->AfficherThematique();
        }
        elseif($this->input->post('AjoutSSThematique'))
        {
            $NoThematique = $this->input->post('thematique');
            $SousThematque = $this->input->post('nouveausousthematique');
            
            $Donnees = array('NOMTHEMATIQUE'=>$SousThematque);
            $Thematiques = $this->ModelThematique->getThematiquesExiste($Donnees);

            if(empty($Thematiques))
            {
                $noSousThematique =$this->ModelThematique->InsererThematique($Donnees);
                $Donnees = array(
                    'NOTHEMATIQUE'=>$NoThematique,
                    'NOSOUSTHEMATIQUE'=>$noSousThematique,
                );
                $this->ModelThematique->InsererSousThematique($Donnees);
            }
            else
            {
                echo '<script>alert("Cette Sous-Thematique existe déjà")</script>';
            }
            $this->AfficherThematique();
        
        }
        elseif($this->input->post('AjoutMotCle'))
        {
            $Thematique = $this->input->post('Thema');
            $MotClé = $this->input->post('nouveauMotCle');
        }
        else
        {
            $this->AfficherThematique();
        }
        
    }

}