<?php 
    class ModelSeConnecter extends CI_Model 
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function Recup_mdp($mail)
        {
            $this->db->select('motdepasse');
            $this->db->from('acteur');
            $this->db->where('mail',$mail);;
            $requete = $this->db->get();
            return $requete->row_array();
        }

        public function Update_mdp($MotDePasse,$ancienMDP)
        {
            $Donnees = array('motdepasse' => $MotDePasse);
            $this->db->where('motdepasse',$ancienMDP['motdepasse']);
            $this->db->update('acteur',$Donnees);
        }
    }
?>