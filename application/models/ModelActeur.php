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
            $no_Organisation =  $requete->row_array();
            var_dump($no_Organisation);
            
            if($no_Organisation['No_Organisation'] == NULL)
            {
                return NULL;
            }
            else
            {
                $this->db->select('*');
                $this->db->from('Organisation');
                $this->db->where('No_Organisation',$no_Organisation['No_Organisation']);
                $requete = $this->db->get();
                return $requete->result_array(); 
            }
        }

        public function getActions($noActeur)
        {
            $this->db->select('No_Organisation');
            $this->db->from('TravaillerDans');
            $this->db->where('noActeur',$noActeur);
        }
    }

?>