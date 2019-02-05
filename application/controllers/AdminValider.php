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
        $this->load->model('ModelRole');
        $this->load->model('ModelThematique');
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
        $motsCles = $this->ModelThematique->getMotCle();
        
        $DonneesInjectees = array('motsCles'=>$motsCles);

        $DonneesTitre = array('TitreDeLaPage'=>'Gérer mots cles');
        $this->load->view('templates/Entete',$DonneesTitre);
        $this->load->view('AdminValider/GererMotCles',$DonneesInjectees);
        $this->load->view('templates/PiedDePage');
    }

    public function SupprimerMotCle($motCle)
    {
        if($motCle != '0')
        {
            $Tagg = '#'.$motCle;

            $Where = array('Motcle'=>$Tagg);
            $this->ModelThematique->DeleteMotcle($Where);
            
            redirect('AdminValider/GererMotCles');

        }
        else
        {
            redirect('AdminValider/GererMotCles');
        }
    }

    public function GererRole()
    {

        

        $Roles = $this->ModelRole->getRoles();

        foreach($Roles as $unRole)
        {
            $Where = array('noRole'=>$unRole['NOROLE']);
            //var_dump($Where);
            $Attribue = $this->ModelRole->getIfRoleAttribue($Where);

            if(empty($Array))
            {
                $Array = array(0=>array(
                    'noRole'=>$unRole['NOROLE'],
                    'nomRole'=>$unRole['NOMROLE'],
                    'Attribue'=>$Attribue,
                ));
            }
            else
            {
                $temp = array(
                    'noRole'=>$unRole['NOROLE'],
                    'nomRole'=>$unRole['NOMROLE'],
                    'Attribue'=>$Attribue,
                );
                array_push($Array,$temp);
            }
        }
        
        
        if($this->input->post('AjoutRole'))
        {
            $Where = array('nomRole'=>$this->input->post('nouvRole'));
            $Array;
            $test = $this->ModelRole->getRoleExist($Where);

            if($test)
            {
                $this->ModelRole->insertRole($Where);

                $DonneesInjectees = array(
                    'Roles'=>$Array,
                    'Message'=>'Insertion effectuee',
                );
            }
            else
            {
                $DonneesInjectees = array(
                    'Roles'=>$Array,
                    'Attention'=>'Ce role existe déjà'
                );
            }

        }
        else
        {
            $DonneesInjectees = array(
                'Roles'=>$Array,
            );
        }

        
        //var_dump($DonneesInjectees);

        $DonneesTitre = array('TitreDeLaPage'=>'Gérer rôles');
        $this->load->view('templates/Entete',$DonneesTitre);
        $this->load->view('AdminValider/GererRole',$DonneesInjectees);
        $this->load->view('templates/PiedDePage');
    }
    
    public function SupprimerRole($Attribue,$norole)
    {
        if($norole != 0)
        {
            if($Attribue==1)
            {
                echo 'attribué';  
            }
        }
        

        //redirect('AdminValider/GererRole');
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