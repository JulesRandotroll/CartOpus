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
        $DpdThematiques = $this->ModelThematique->getTheme_SousTheme();
        $SsThematique = $this->ModelThematique->getSousThemes();

            //var_dump($thematiques);
            $DonnéesTitre = array('TitreDeLaPage'=>'Ajout thématique');

            $Données=array(
                'Thematique'=>$thematiques,
                'Theme_SsTheme'=>$DpdThematiques,
                'SsThemes'=>$SsThematique,
            );

            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('SuperAdmin/AjouterThematique',$Données);
            $this->load->view('templates/PiedDePage');
        
    }

    public function AjouterThematique()
    {
        $ThematiqueAInserer = $this->input->post('nouvellethematique');
        $Donnees=array('NOMTHEMATIQUE'=>$ThematiqueAInserer);
        var_dump($Donnees);
        $Thematiques = $this->ModelThematique->getThematiquesExiste($Donnees);
        if(empty($Thematiques))
        {
            $this->ModelThematique->InsererThematique($Donnees);
            redirect('SuperAdmin/AfficherThematique');
        }
        else
        {
            echo '<script>alert("Cette Thematique existe déjà")</script>';
            $this->AfficherThematique();
        }
        
    }

    public function MigrationSousThematique($noSousThematique)
    {
        if($noSousThematique != '0')
        {
            $Donnees = array("noSousThematique"=>$noSousThematique);
            //var_dump($Donnees);
            $this->ModelThematique->updateSsThematique_To_Thematique($Donnees); 
            redirect('SuperAdmin/AfficherThematique');   
        }
        else
        {
            echo '<script>alert("Veuillez selectionner une sous thematique, merci")</script>';
            $this->AfficherThematique();
        }
    }

    public function CreerSsThematique($noThematique)
    {
        var_dump($noThematique);
        if($noThematique != '0')
        {
            $SousThematque = $this->input->post('nouvellesousthematique');
            
        
            $Donnees = array('NOMTHEMATIQUE'=>$SousThematque);
            $Thematiques = $this->ModelThematique->getThematiquesExiste($Donnees);

            var_dump($Donnees);

            if(empty($Thematiques))
            {
                $noSousThematique =$this->ModelThematique->InsererThematique($Donnees);
                $Donnees = array(
                    'NOTHEMATIQUE'=>$noThematique,
                    'NOSOUSTHEMATIQUE'=>$noSousThematique,
                );
                $this->ModelThematique->InsererSousThematique($Donnees);
                redirect('SuperAdmin/AfficherThematique');
            }                                              
            else
            {
                echo '<script>alert("Cette Sous-Thematique existe déjà")</script>';
                $this->AfficherThematique();
            }
        }
        else
        {
            echo '<script>alert("Veuillez selectionner une thematique, merci")</script>';
            $this->AfficherThematique();
        }        
    }

    public function lierThematiques($noSousThematique, $noThematique)
    {
        if($noThematique != '0' && $noSousThematique != '0')
        {
            $Donnees = array(
                'NOTHEMATIQUE'=>$noThematique,
                'NOSOUSTHEMATIQUE'=>$noSousThematique,
            );
            $this->ModelThematique->InsererSousThematique($Donnees);    
            redirect('SuperAdmin/AfficherThematique');
        }
        else
        {
            echo '<script>alert("Veuillez selectionner une thematique et / ou une sous thematique, merci"</script>';
            $this->AfficherThematique();
        }
        
        
    }

    public function SupprimerThematique($noThematique)
    {
        if($noThematique != '0')
        {
            $Where = array('NoThematique'=>$noThematique);
            $this->ModelThematique->DeleteThematique($Where);
            
            redirect('SuperAdmin/AfficherThematique');
        }
        else
        {
            echo '<script>alert("Veuillez selectionner une thematique, merci"</script>';
            $this->AfficherThematique();
        }
    }

    public function SupprimerSousThematique($noSousThematique)
    {
        if($noThematique != '0')
        {
            $Where = array('NoSousThematique'=>$noSousThematique);
            $this->ModelThematique->DeleteThematique($Where);

            $Where = array('NoThematique'=>$noSousThematique);
            $this->ModelThematique->DeleteThematique($Where);

            redirect('SuperAdmin/AfficherThematique');
        }
        else
        {
            echo '<script>alert("Veuillez selectionner une sous-thematique, merci"</script>';
            $this->AfficherThematique();
        }
    }

}