<?php 
    class ModelCommentaire extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /*chargement database.php (dans config), obligatoirement dans le constructeur*/
        }

        public function getCommentaireVisiteur()
        {
            $this->db->select('*');
            $this->db->from('commentervisiteur cv');
            $this->db->join('action a','cv.noAction=a.noAction');
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function insererCommentaireVisiteur($donneeAinserer)
        {
            $this->db->insert('commentervisiteur', $donneeAinserer);
            return $this->db->insert_id();
        }
    }
?>