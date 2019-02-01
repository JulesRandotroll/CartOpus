
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
            $noProfil = $this->input->post('Profil');
            $noActeur = $this->input->post('noActeur');
            if($noProfil == 0)
            {
                
                redirect('SuperAdmin/MailDebouter/'.$noActeur,'refresh');
                
            }
            else
            {
                $this->ModelActeur->setProfil($noActeur,$noProfil);
            }
            
        }
        
        $this->AffecterProfil(0);  
    }

    public function MailDebouter($noActeur)
    {
        $Acteur = $this->ModelActeur->getActeur($noActeur);
        if($this->input->post('Envoyer'))
        {
            $mail = $Acteur[0]['MAIL'];
            $objet = $this->input->post('objet');
            $message = $this->input->post('Message');

            $this->email->from('cartopus22@gmail.com');
            $this->email->to($mail); 
            $this->email->subject($objet);
            $this->email->message($message."\r\n\r\n".'Ce message a été envoyé par : CartOpus. Contact: cartopus22@gmail.com');
            if (!$this->email->send())
            {
                $this->email->print_debugger();
            }

            $this->ModelActeur->setProfil($noActeur,'0');
            redirect('SuperAdmin/AffecterProfil/0');
        }
        else
        {
            
            $proposition = 
                "Ceci est un message de l'administration de Cart'Opus \n"
                ."Nous vous envoyons ce message car vous n'avez pas respecté les codes de Cart'Opus"
            ;
            $Donnees = array(
                "Mail"=>$Acteur[0]['MAIL'],
                "No"=>$noActeur,
                'proposition'=>$proposition,
            );

            $DonnéesTitre=array('TitreDeLaPage'=>'Explication destitution');

            $this->load->view('templates/Entete',$DonnéesTitre);
            $this->load->view('SuperAdmin/MailingDestitue',$Donnees);
            $this->load->view('templates/PiedDePage');


        }
        


    }

    public Function GererThematique()
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
                $Attention = $this->session->flashdata('Attention');
                $Données=array(
                    'Thematique'=>$thematiques,
                    'Theme_SsTheme'=>$DpdThematiques,
                    'SsThemes'=>$SsThematique,
                    'Attention'=>$Attention
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
            $this->load->view('SuperAdmin/GererThematique',$Données);
            $this->load->view('templates/PiedDePage');
        
    }

    public function AjouterThematique()
    {
        $ThematiqueAInserer = $this->input->post('nouvellethematique');
        $Donnees=array('NOMTHEMATIQUE'=>$ThematiqueAInserer);
        
        $Thematiques = $this->ModelThematique->getThematiquesExiste($Donnees);
        if(empty($Thematiques))
        {
            $this->ModelThematique->InsererThematique($Donnees);
           
            $Message = 'Ajout de la thématique effectuée';
            $this->session->set_flashdata('Message',$Message);
            redirect('SuperAdmin/GererThematique');
        }
        else
        {
            $Message = 'Cette thématique éxiste déja';
            $this->session->set_flashdata('Attention',$Message);
            redirect('SuperAdmin/GererThematique');
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
            redirect('SuperAdmin/GererThematique'); 
        }
        else
        {
            $Message = 'Veuillez sélectionner une sous-thématique à migrer, merci';
            $this->session->set_flashdata('Danger',$Message);
            redirect('SuperAdmin/GererThematique'); 
        }
    }

    public function CreerSsThematique($noThematique)
    {
        //var_dump($noThematique);
        if($noThematique != '0')
        {
            $SousThematque = $this->input->post('nouvellesousthematique');
            
        
            $Donnees = array('NOMTHEMATIQUE'=>$SousThematque);
            $Thematiques = $this->ModelThematique->getThematiquesExiste($Donnees);

            //var_dump($Donnees);

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
                redirect('SuperAdmin/GererThematique');
            }                                              
            else
            {
                $Message = 'Cette Sous-Thematique existe déjà';
                $this->session->set_flashdata('Attention',$Message);
                redirect('SuperAdmin/GererThematique');
            }
        }
        else
        {
            $Message = 'Veuillez selectionner une thematique, merci';
            $this->session->set_flashdata('Danger',$Message);
            redirect('SuperAdmin/GererThematique');
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
                redirect('SuperAdmin/GererThematique');
            }
            else
            {
                $Message = 'Ce couple thématique / sous-thématique existe déjà';
                $this->session->set_flashdata('Attention',$Message);
                redirect('SuperAdmin/GererThematique');
            }
            
        }
        else
        {
            $Message = 'Veuillez selectionner une thematique et / ou une sous thematique, merci';
            $this->session->set_flashdata('Danger',$Message);
            redirect('SuperAdmin/GererThematique');
        }
        
        
    }

    public function SupprimerThematique($noThematique)
    {
        if($noThematique != '0')
        {
            $Where = array('NoThematique'=>$noThematique);

            $Existe = $this->ModelThematique->getThematique_SousThematiqueExiste($Where);
            var_dump($Existe);
            if(empty($Existe))
            {
                $this->ModelThematique->DeleteThematique($Where);
                
                $Message = 'Suppression de la thématique effectuée';
                $this->session->set_flashdata('Message',$Message);
                redirect('SuperAdmin/GererThematique');
            }
            else
            {
                $Message = 'Cette thématique est liée à une ou plusieur sous thématique, veuillez supprimer ces liens avant svp';
                $this->session->set_flashdata('Attention',$Message);
                //redirect('SuperAdmin/GererThematique');
            }
            
        }
        else
        {
            $Message = 'Veuillez sélectionner une thématique à supprimer, merci';
            $this->session->set_flashdata('Danger',$Message);
            redirect('SuperAdmin/GererThematique');
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
            redirect('SuperAdmin/GererThematique');
        }
        else
        {
            $Message = 'Veuillez sélectionner une thématique à suprimer, merci';
            $this->session->set_flashdata('Danger',$Message);
            redirect('SuperAdmin/GererThematique');
        }
    }

    public function DelierSousThematiques($noThematique)
    {
        if($noThematique != '0')
        {
            //créer une fonction spéciale... 
            $Where = array('noThematique'=>$noThematique);
        
            $this->ModelThematique->delierSousthematique($Where);

            $Message = 'Toutes les sous thématiques ont été délié de la thématique choisie';
            $this->session->set_flashdata('Message',$Message);
            redirect('SuperAdmin/GererThematique');
        }
        else
        {
            $Message = 'Veuillez sélectionner une thématique à laquelle délier toutes les sous thématiques, merci';
            $this->session->set_flashdata('Danger',$Message);
            //redirect('SuperAdmin/GererThematique');
        }
        
    }

    public function DelierUneSousThematiques($noThematique, $noSousThematique)
    {
        if($noThematique != '0' && $noSousThematique != '0')
        {
            $Where = array(
                'noThematique'=>$noThematique,
                'noSousThematique'=>$noSousThematique
            );

            $this->ModelThematique->updateSsThematique_To_Thematique($Where);

            $Message = 'La sous thématique a été déliée de la thématique choisie';
            $this->session->set_flashdata('Message',$Message);
            
            
            redirect('SuperAdmin/GererThematique');
        }
        else
        {
            $Message = 'Veuillez selectionner une thematique et / ou une sous thematique, merci';
            $this->session->set_flashdata('Danger',$Message);
            redirect('SuperAdmin/GererThematique');
        }
    }

}