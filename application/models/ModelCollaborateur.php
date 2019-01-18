<?php
    class ModelCollaborateur extends CI_Model {

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

    }
?>