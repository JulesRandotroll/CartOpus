<?php 
    class ModelSInscrire extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function Insert_Acteur($donneeAinserer)
        {
            $this->db->insert('acteur', $donneeAinserer);
            return $this->db->insert_id();
        }

        public function Test_Inscrit($donneeATester)
        {
          
           $this->db->select('count(*)');
           $this->db->from('acteur');
           $this->db->where('mail',$donneeATester);
           $requete = $this->db->get();
           return $requete->row_array();
           // Select
        }
    }
?>