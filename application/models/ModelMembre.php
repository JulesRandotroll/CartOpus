<?php
    class ModelMembre extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function insertEtrePartenaire($DonneesPartenaire)//,$InsertLieu,$InsertAvoirLieu,$InsertEtrePartenaire)
        {

            $this->db->insert('etrepartenaire',$DonneesPartenaire);
            return $this->db->insert_id();
        }
        public function insertProfilPourAction($DonneesProfil)//,$InsertLieu,$InsertAvoirLieu,$InsertEtrePartenaire)
        {
            
            $this->db->insert('profilpouraction',$DonneesProfil);
            return $this->db->insert_id();
        }
        public function UpdateRoleMembre($DonnéesDeTest,$DonnéesAUpdate)
        { 
            var_dump($DonnéesDeTest);
            var_dump($DonnéesAUpdate);
            $this->db->where($DonnéesDeTest);
            $this->db->update('etrepartenaire',$DonnéesAUpdate);

        }
        public function GetMembre($noAction)
        {

           $this->db->select('*');  
           $this->db->from('etrepartenaire');
           $this->db->join('acteur','etrepartenaire.noActeur=acteur.noActeur');
           $this->db->join('profilpouraction','etrepartenaire.noActeur=profilpouraction.noActeur');
           $this->db->join('role','etrepartenaire.norole=role.norole');
           $this->db->where('etrepartenaire.noAction=profilpouraction.noAction');
           $this->db->where('profilpouraction.NOACTION',$noAction);
           $this->db->group_by('etrepartenaire.noacteur'); 
           $requete = $this->db->get();
            return $requete->result_array();
        }

        public function Suppr_Membre($DonneesASupprimer)
        {
            //var_dump($DonneesASupprimer);
            $DonneesASupprimer=array(
                'NOACTEUR'=>$DonneesASupprimer['NOACTEUR'],
                'NOACTION'=>$DonneesASupprimer['NOACTION'],
                'DATEDEBUT'=>$DonneesASupprimer['DATEDEBUT']['DATEDEBUT'],
            );
            //var_dump($DonneesASupprimer);
            $tables=array('profilpouraction','etrepartenaire');
            $this->db->where($DonneesASupprimer);
            $this->db->delete($tables);
        }

        
        public function GetRoles($noActeur,$noAction,$DateD)
        {
            $Wheres=array('NOACTEUR'=>$noActeur,
            'NOACTION'=>$noAction,
            'DATEDEBUT'=>$DateD['DATEDEBUT']);
            var_dump($Wheres);
            $this->db->select('norole');
            $this->db->from('etrepartenaire');
            $this->db->where($Wheres);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function TestExiste($noActeur,$noAction)
        {
            //var_dump($noAction);
            $this->db->select('*');
            $this->db->from('etrepartenaire');
            $this->db->where('NOACTEUR=',$noActeur[0]['NOACTEUR']);
            $this->db->where('NOACTION=',$noAction);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function UpdateProfil($DonnéesDeTest,$DonnéesAUpdate)
        {
            //var_dump($DonnéesDeTest);
            //var_dump($DonnéesAUpdate);
            $this->db->where($DonnéesDeTest);
            $this->db->update('profilpouraction',$DonnéesAUpdate);
        }
    }
?>