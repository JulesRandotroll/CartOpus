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

            //Envoie des données et du message s'il existe
            if($this->session->flashdata('Message')!=null)
            {
                $Message=$this->session->flashdata('Message');
                $Données=array(
                    'Thematique'=>$thematiques,
                    'Theme_SsTheme'=>$DpdThematiques,
                    'SsThemes'=>$SsThematique,
                    'Message'=>$Message,
                );
            }
            elseif($this->session->flashdata('Danger')!=null)
            {
                $Danger = $this->session->flashdata('Danger');
                $Données=array(
                    'Thematique'=>$thematiques,
                    'Theme_SsTheme'=>$DpdThematiques,
                    'SsThemes'=>$SsThematique,
                    'Danger'=>$Danger
                );
            }
            elseif($this->session->flashdata('Attention')!=null)
            {
                $Données=array(
                    'Thematique'=>$thematiques,
                    'Theme_SsTheme'=>$DpdThematiques,
                    'SsThemes'=>$SsThematique,
                    'Danger'=>$Danger
                );
            }
            else
            {
                $Données=array(
                    'Thematique'=>$thematiques,
                    'Theme_SsTheme'=>$DpdThematiques,
                    'SsThemes'=>$SsThematique,
                );
            }
            
            
            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('SuperAdmin/AjouterThematique',$Données);
            $this->load->view('templates/PiedDePage');
        
    }

    public function AjouterThematique()
    {
        $ThematiqueAInserer = $this->input->post('nouvellethematique');
        $Donnees=array("NOMTHEMATIQUE"=>$ThematiqueAInserer);
        //var_dump($Donnees);
        $Thematiques = $this->ModelThematique->getThematiquesExiste($Donnees);
        if(empty($Thematiques))
        {
            $this->ModelThematique->InsererThematique($Donnees);
           
            $Message = 'Ajout de la thématique effectuée';
            $this->session->set_flashdata('Message',$Message);
            redirect('SuperAdmin/AfficherThematique');
        }
        else
        {
            $Message = 'Cette thématique éxiste déja';
            $this->session->set_flashdata('Attention',$Message);
            redirect('SuperAdmin/AfficherThematique');
        }
        
    }

    public function MigrationSousThematique($noSousThematique)
    {
        if($noSousThematique != '0')
        {
            $Donnees = array("noSousThematique"=>$noSousThematique);
            //var_dump($Donnees);
            $this->ModelThematique->updateSsThematique_To_Thematique($Donnees); 
            
            $Message = 'Migration de la sous-thématique en thématique effectuée';
            $this->session->set_flashdata('Message',$Message);
            redirect('SuperAdmin/AfficherThematique'); 
        }
        else
        {
            $Message = 'Veuillez sélectionner une sous-thématique à migrer, merci';
            $this->session->set_flashdata('Danger',$Message);
            redirect('SuperAdmin/AfficherThematique'); 
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

                $Message = 'Création et insertion de la sous-thématique effectuée';
                $this->session->set_flashdata('Message',$Message);
                redirect('SuperAdmin/AfficherThematique');
            }                                              
            else
            {
                $Message = 'Cette Sous-Thematique existe déjà';
                $this->session->set_flashdata('Attention',$Message);
                redirect('SuperAdmin/AfficherThematique');
            }
        }
        else
        {
            $Message = 'Veuillez selectionner une thematique, merci';
            $this->session->set_flashdata('Danger',$Message);
            redirect('SuperAdmin/AfficherThematique');
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
            //Teste sur l'existance préalable de ce couple ou non
            $Existe = $this->ModelThematique->getSousThematiqueExiste($Donnees);

            if(empty($Existe))
            {
                $this->ModelThematique->InsererSousThematique($Donnees);    
                
                $Message = 'Liaison de la thématique et de la sous-thématique effectuée';
                $this->session->set_flashdata('Message',$Message);
                redirect('SuperAdmin/AfficherThematique');
            }
            else
            {
                $Message = 'Ce couple thématique / sous-thématique existe déjà';
                $this->session->set_flashdata('Attention',$Message);
                redirect('SuperAdmin/AfficherThematique');
            }
            
        }
        else
        {
            $Message = 'Veuillez selectionner une thematique et / ou une sous thematique, merci';
            $this->session->set_flashdata('Danger',$Message);
            redirect('SuperAdmin/AfficherThematique');
        }
        
        
    }

    public function SupprimerThematique($noThematique)
    {
        if($noThematique != '0')
        {
            $Where = array('NoThematique'=>$noThematique);
            $this->ModelThematique->DeleteThematique($Where);
            
            $Message = 'Suppression de la thématique effectuée';
            $this->session->set_flashdata('Message',$Message);
            redirect('SuperAdmin/AfficherThematique');
        }
        else
        {
            $Message = 'Veuillez sélectionner une thématique à supprimer, merci';
            $this->session->set_flashdata('Danger',$Message);
            redirect('SuperAdmin/AfficherThematique');
        }
    }

    public function SupprimerSousThematique($noSousThematique)
    {
        if($noSousThematique != '0')
        {
            $Where = array('NoSousThematique'=>$noSousThematique);
            
            $this->ModelThematique->updateSsThematique_To_Thematique($Where);

            $Where = array('NoThematique'=>$noSousThematique);
            //Supression de la dernière occuenre ce la sous thématique
            $this->ModelThematique->DeleteThematique($Where);

            $Message = 'Supression de la sous thématique effectuée';
            $this->session->set_flashdata('Message',$Message);
            redirect('SuperAdmin/AfficherThematique');
        }
        else
        {
            $Message = 'Veuillez sélectionner une thématique à suprimer, merci';
            $this->session->set_flashdata('Danger',$Message);
            redirect('SuperAdmin/AfficherThematique');
        }
    }

}