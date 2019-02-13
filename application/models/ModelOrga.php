<?php
    class ModelOrga extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function insertOrga($DonnéesOrga)
        {
            //var_dump($DonnéesOrga);
            $this->db->insert('organisation',$DonnéesOrga);
            return $this->db->insert_id(); 
        }
        public function getOrgaSimple($noOrganisation)
        {
            //var_dump($noOrganisation);
            $DonnéesDeTest=array("o.NO_ORGANISATION"=>$noOrganisation);

            $this->db->select('*');
            $this->db->from('organisation o');
            $this->db->join('lieu l','l.NOLIEU=o.NOLIEU');
            $this->db->where($DonnéesDeTest);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getSecteur($noOrganisation)
        {
            $DonnéesDeTest=array("o.NO_ORGANISATION"=>$noOrganisation);

            //reutiliser pour les favoris
            $this->db->select('*');
            $this->db->from('Secteur s');
            $this->db->join('travaillerdans td','td.nosecteur=s.nosecteur');
            $this->db->join('Acteur a','a.noActeur=td.noacteur');
            $this->db->join('Organisation o','o.no_Organisation=td.no_Organisation');
            $this->db->where($DonnéesDeTest);
            $requete = $this->db->get();
            return $requete->result_array();
        }
        public function TestDoublon($DonnéesDeTest)
        {
            $this->db->select('count(*)');
            $this->db->from('Organisation');
            $this->db->where($DonnéesDeTest);
            $requete = $this->db->get();
            return $requete->result_array();
        }
        public function GetOrgas()
        {
            $this->db->select('*');
            $this->db->from('Organisation');
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function UpdateOrga($DonnéesOrga,$noOrga)
        {
            $this->db->where('NO_ORGANISATION',$noOrga);
            $this->db->update('Organisation',$DonnéesOrga);
        }

        public function InsertTravaillerDans($noActeur,$noOrga,$noSecteur)
        {
            $DonnéesAInserer=array(
                "NOACTEUR"=>$noActeur,
                "NO_ORGANISATION"=>$noOrga,
                "NOSECTEUR"=>$noSecteur);

            $this->db->insert('travaillerdans',$DonnéesAInserer);
            return $this->db->insert_id(); 
        }

        public function DoublonTravaillerDans($noActeur,$noOrga,$noSecteur)
        {
            $DonnéesDeTest=array(
                "NOACTEUR"=>$noActeur,
                "NO_ORGANISATION"=>$noOrga,
                "NOSECTEUR"=>$noSecteur);

            //var_dump($DonnéesDeTest);
            $this->db->select('count(*)');
            $this->db->from('travaillerdans');
            $this->db->where($DonnéesDeTest);
            $requete = $this->db->get();
            return $requete->result_array();
        }
    }
?>