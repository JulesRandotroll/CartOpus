<?php 
    class ModelActeur extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function getActeur($noActeur) 
        {
            $this->db->select('*');
            $this->db->from('Acteur');
            $this->db->where('noActeur',$noActeur);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getOrganisation($noActeur)
        {
            $this->db->select('No_Organisation');
            $this->db->from('TravaillerDans');
            $this->db->where('noActeur',$noActeur);
            $requete = $this->db->get();
            $no_Organisation =  $requete->result_array();
            //var_dump($no_Organisation);
            
            if(empty($no_Organisation))
            {
                return NULL;
            }
            else
            {   
                $i = 0;
                foreach($no_Organisation as $uneOrga)
                {
                    //var_dump($uneOrga);
                    $this->db->select('*');
                    $this->db->from('Organisation');
                    $this->db->where('No_Organisation',$uneOrga['No_Organisation']);
                    $requete = $this->db->get();
                    $temporaire = $requete->result_array();
                    //var_dump($temporaire);
                    
                    if(empty($Resultats))
                    {
                        $Resultats = array($i=>$temporaire);
                        
                    }
                    else
                    {
                        $Resultats = $Resultats + array($i=>$temporaire);
                    }
                    $i +=1;
                }
                return $Resultats;
            }
        }

        public function getActions($noActeur)
        {
            $this->db->select('noAction, datedebut, noRole');
            $this->db->from('EtrePartenaire');
            $this->db->where('noActeur',$noActeur);
            $requete = $this->db->get();
            $noActions = $requete->result_array();

            if(empty($noActions))
            {
                return NULL;
            }
            else
            {
                $i = 0;
                foreach($noActions as $uneAction)
                {
                    //var_dump($uneAction);
                    $this->db->select('*');
                    $this->db->from('Action');
                    $this->db->where('noAction',$uneAction['noAction']);
                    $requete = $this->db->get();
                    $temporaire = $requete->result_array();
                    //var_dump($temporaire);
                    
                    if(empty($Resultats))
                    {
                        $Resultats = array($i=>$temporaire);
                    }
                    else
                    {
                        $Resultats = $Resultats + array($i=>$temporaire);
                    }
                    $i +=1;
                }
                return $Resultats;
            }
        }
    }

?>