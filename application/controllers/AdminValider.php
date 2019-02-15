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

        $this->load->model('ModelAction');
        $this->load->model('ModelRole');
        $this->load->model('ModelThematique');
        $this->load->model('ModelActeur');
        
        $this->load->library('session');
        $this->load->library("pagination");

        if($this->session->statut != 4 && $this->session->statut != 5)
        {
            redirect('Visiteur/loadAccueil');
        }

    } // __construct

    public function AccueilAdminValider()
    {

        
        $Actions = $this->ModelAction->getActionsSignalees();

        $DonneesInjectees = array(
            'Actions'=>$Actions,
        );

        $DonneesTitre = array('TitreDeLaPage'=>'Accueil');
        $this->load->view('templates/Entete',$DonneesTitre);
        $this->load->view('AdminValider/AccueilAdminValider',$DonneesInjectees);
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
        
        
        if($this->session->flashdata('Message')!= null)
        {
            $DonneesInjectees = array(
                'Message'=>$this->session->flashdata('Message'),
                'Roles'=>$Array,
            );
        }
        elseif($this->session->flashdata('Attention')!= null)
        {
            $DonneesInjectees = array(
                'Roles'=>$Array,
                'Attention'=>$this->session->flashdata('Attention'),
            );
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
    
    public function AjouterRole()
    {
        $Where = array('nomRole'=>$this->input->post('nouvRole'));
        $test = $this->ModelRole->getRoleExist($Where);
        //Test = true si l'action n'a pas déjà été créée
        if($test)
        {
            $this->ModelRole->insertRole($Where);

            $this->session->set_flashdata('Message','Insertion effectuee');
        }
        else
        {
            $this->session->set_flashdata('Attention','Ce rôle existe déjà');
        }
        
        redirect('AdminValider/GererRole');
        
    }

    public function SupprimerRole($Attribue,$norole)
    {
        if($norole != 0)
        {
            $Where = array('noRole'=>$norole);
            if($Attribue==1)
            {
                $this->ModelRole->updateRole($Where);
            }
            $this->ModelRole->supprRole_tabRole($Where);
            $this->session->set_flashdata('Message','Suppression effectuée');
        }
        
        redirect('AdminValider/GererRole');

        //
    }

    public function InvaliderActionDepuisAction($noAction)
    {
        // echo($noAction.'<BR>');
        $noAdmin = $this->session->noActeur;
        $Admin=$this->ModelActeur->getActeur($noAdmin);

        //var_dump($Admin);

        $toDay = date('Y-m-d H:i:s');
        $ajd = date('d/m/Y à H:i:s');

        $donneeAinserer = array
        (
            'noAction' => $noAction,
            'noSignalement' => '1',
            'commentaire' => 'Action signalée par l\'administrateur de validation '.$Admin[0]['NOMACTEUR'].' '.$Admin[0]['PRENOMACTEUR'].' le : '.$ajd,
            'DateSignalement' => $toDay,
        );
      
        //var_dump($donneeAinserer);
        $DonneesInjectees = $this->ModelAction->insererSignalement($donneeAinserer);
        redirect('AdminValider/InvaliderAction/'.$noAction);
        // echo $noAdmin;
    }

    public function InvaliderAction($noAction)
    {
        $Annonceur = $this->ModelAction->getAnnonceur($noAction);

        if($this->input->post('Envoyer'))
        {
            $mail=$Annonceur[0]['MAIL'];
            $objet = $this->input->post('objet');
            $message = $this->input->post('message');


            $this->email->from('cartopus22@gmail.com');
            $this->email->to($mail); 
            $this->email->subject($objet);
            $this->email->message($message."\r\n\r\n".'Ce message a été envoyé par : CartOpus. Contact: cartopus22@gmail.com');
            if (!$this->email->send())
            {
                $this->email->print_debugger();
            }

            $Where= array('noAction'=>$noAction);
            $Valid=array(
                'VALIDEE'=>false,
                'Favoris'=>false,
            );
            //Passage a valider false
            $this->ModelAction->updateValider($Where,$Valid);



            redirect('AdminValider/AccueilAdminValider');
        }
        else
        {
            
            
            $DateDebutAction = $Annonceur[0]['DATEDEBUT'];
            
            // %d %B %Y %Hh%M

            setlocale (LC_TIME, 'fr_FR.UTF-8','fra');
            $jour = strftime("%A %d",strtotime($DateDebutAction));
            $mois = strftime("%B",strtotime($DateDebutAction));
            $Annee = strftime("%Y",strtotime($DateDebutAction));
            $Heure = strftime("%Hh%M",strtotime($DateDebutAction)); 
            

            if(substr($mois,0,1) == 'f')
            {
                $mois = 'février';
            }
            elseif(substr($mois,0,1) == 'd')
            {
                $mois = 'décembre';
            }
            elseif(substr($mois,0,1) == 'a')
            {
                $mois = 'août';
            }
            
            $DateDebutAction = $jour.' '.$mois.' '.$Annee.' à '.$Heure;

            $DonneesInjectees = array(
                'noAction'=>$noAction,
                'mail'=>$Annonceur[0]['MAIL'],
                'nom'=>$Annonceur[0]['NOMACTEUR'],
                'prenom'=>$Annonceur[0]['PRENOMACTEUR'],
                'noActeur'=>$Annonceur[0]['NOACTEUR'],
                'nomAction'=>$Annonceur[0]['NOMACTION'],
                'dateDebutAction'=>$DateDebutAction,
                'objet'=>'Mise en quarantaine de l\'action : "'.$Annonceur[0]['NOMACTION'].'", ayant lieu le '.$DateDebutAction,
                'path'=> 'AdminValider/InvaliderAction/',
            );

            $DonneesTitre = array('TitreDeLaPage'=>'Invalider '.$Annonceur[0]['NOMACTION']);
            $this->load->view('templates/Entete',$DonneesTitre);
            $this->load->view('AdminValider/MailingInvalidation',$DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        }
    }

    public function gererValidationAction()
    {
        $Actions = $this->ModelAction->getActionInvalidees();
        
        $DonneesInjectees = array(
            'Actions'=>$Actions,
        );

        $DonneesTitre = array('TitreDeLaPage'=>'Gestion Validation');
        $this->load->view('templates/Entete',$DonneesTitre);
        $this->load->view('AdminValider/ValiderAction',$DonneesInjectees);
        $this->load->view('templates/PiedDePage');
    
    }
    public function ValiderAction($noAction)
    {
        $Annonceur = $this->ModelAction->getAnnonceur($noAction);

        if($this->input->post('Envoyer'))
        {
            $mail=$Annonceur[0]['MAIL'];
            $objet = $this->input->post('objet');
            $message = $this->input->post('message');


            $this->email->from('cartopus22@gmail.com');
            $this->email->to($mail); 
            $this->email->subject($objet);
            $this->email->message($message."\r\n\r\n".'Ce message a été envoyé par : CartOpus. Contact: cartopus22@gmail.com');
            if (!$this->email->send())
            {
                $this->email->print_debugger();
            }

            $Where= array('noAction'=>$noAction);
            $Valid=array(
                'VALIDEE'=>true,
            );
            //Passage a valider true, plus suppression des signalements
            $this->ModelAction->updateValider($Where,$Valid);
            $this->ModelAction->deleteSignalements($Where);


            redirect('AdminValider/gererValidationAction');
        }
        else
        {
            
            
            $DateDebutAction = $Annonceur[0]['DATEDEBUT'];
            
            // %d %B %Y %Hh%M

            setlocale (LC_TIME, 'fr_FR.UTF-8','fra');
            $jour = strftime("%A %d",strtotime($DateDebutAction));
            $mois = strftime("%B",strtotime($DateDebutAction));
            $Annee = strftime("%Y",strtotime($DateDebutAction));
            $Heure = strftime("%Hh%M",strtotime($DateDebutAction)); 
            

            if(substr($mois,0,1) == 'f')
            {
                $mois = 'février';
            }
            elseif(substr($mois,0,1) == 'd')
            {
                $mois = 'décembre';
            }
            elseif(substr($mois,0,1) == 'a')
            {
                $mois = 'août';
            }
            
            $DateDebutAction = $jour.' '.$mois.' '.$Annee.' à '.$Heure;

            $DonneesInjectees = array(
                'noAction'=>$noAction,
                'mail'=>$Annonceur[0]['MAIL'],
                'nom'=>$Annonceur[0]['NOMACTEUR'],
                'prenom'=>$Annonceur[0]['PRENOMACTEUR'],
                'noActeur'=>$Annonceur[0]['NOACTEUR'],
                'nomAction'=>$Annonceur[0]['NOMACTION'],
                'dateDebutAction'=>$DateDebutAction,
                'objet'=>'Revalidation de l\'action : "'.$Annonceur[0]['NOMACTION'].'", ayant lieu le '.$DateDebutAction,
                'path'=> 'AdminValider/ValiderAction/',
            );

            $DonneesTitre = array('TitreDeLaPage'=>'Invalider '.$Annonceur[0]['NOMACTION']);
            $this->load->view('templates/Entete',$DonneesTitre);
            $this->load->view('AdminValider/MailingInvalidation',$DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        }
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