<?php 
    class ModelAction extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function getAction($DonnéesDeTest)
        {
            var_dump($DonnéesDeTest);
            $this->db->select('*');
            $this->db->from('Action a');
            $this->db->join('AvoirLieu al','al.noAction=a.noAction');
            $this->db->join('Lieu l','l.nolieu=al.nolieu');
            $this->db->where($DonnéesDeTest);
            $requete = $this->db->get();
            return $requete->result_array();
            

        }
    
    
    }
?>