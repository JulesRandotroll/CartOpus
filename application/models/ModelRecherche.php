<?php 
    class ModelRecherche extends CI_Model
    {

        public function __construct()
        {
            $this->load->database();
            /*chargement database.php (dans config), obligatoirement dans le constructeur*/
        }

        public function nombreRecherche($Recherche = FALSE)
        {
            if($Recherche===false)
            {
                return $this->db->count_all('action');
            }
            $this->db->from('action');
            $this->db->like('NOMACTION', $Recherche);
            $requete = $this->db->count_all_results();
            return $requete;
        }

        public function actionRecherche($nomAction, $nbLignesRetournees, $PremiereLigneRetournee)
        {
            $this->db->limit($nbLignesRetournees, $PremiereLigneRetournee);
            $this->db->select('*');
            $this->db->from('action');
            $this->db->like('NOMACTION', $nomAction);
            //$query = $this->db->get();
            // if($query->num_rows()>0)
            // {
            //     foreach ($query->result_array() as $ligne) 
            //     {
            //         $jeuEnr[] = $ligne;
            //     }
            //     var_dump($jeuEnr);
            //     return $jeuEnr;
            // }
            // return FALSE;
            $requete = $this->db->get();
            return $requete->result_array();
            
        }
    }
?>