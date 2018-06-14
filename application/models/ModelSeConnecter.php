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

        public function Test_Inscrit($donneesATester)
        {
            var_dump($donneesATester);
            $array = array('mail' => $donneesATester['mail'], 'motdepasse' => $donneesATester['mdp']);
            $this->db->select('count(*)');
            $this->db->from('acteur ');
            $this->db->where($array);

            $requete = $this->db->get();
            return $requete->row_array();
        }

        public function GetNoProfil($donneesATester)
        {
            $array = array('mail' => $donneesATester['mail'], 'motdepasse' => $donneesATester['mdp']);
            $this->db->select('NoProfil');
            $this->db->from('acteur ');
            $this->db->where($array);

            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function GetNoActeur($donneesATester)
        {
            $array = array('mail' => $donneesATester['mail'], 'motdepasse' => $donneesATester['mdp']);
            $this->db->select('NoActeur');
            $this->db->from('acteur ');
            $this->db->where($array);

            $requete = $this->db->get();
            return $requete->result_array();
        }
    }
?>