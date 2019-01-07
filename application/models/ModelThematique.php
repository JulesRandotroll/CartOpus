<?php 
    class ModelThematique extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function getThematiques()
        {
            $NotIn = $this->ModelThematique->getAllFromSousThematique();
            //var_dump($NotIn);

            foreach($NotIn as $uneSousThematique)
            {
                echo 'Southématique';
                //var_dump($uneSousThematique);
                
                if(empty($Données))
                {
                    $Données = array('nosousthematique'=>$uneSousThematique['nosousthematique']);
                    echo 'miniDonnées 1 : ';
                    //var_dump($Données);
                }
                else
                {
                    $temp = array('nosousthematique'=>$uneSousThematique['nosousthematique']);
                    echo 'Temp : ';
                    //var_dump($temp);
                    $Données = $Données + $temp;
                    echo 'miniDonnées : ';
                    //var_dump($Données);
                }
            }



            echo 'Données :';
            //var_dump($Données);

            $this->db->select('*');
            $this->db->from('thematique');
            $this->db->where_not_in('nothematique',$Données);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getAllFromSousThematique()
        {
            $this->db->select('nosousthematique');
            $this->db->from('sousthematique');
            $requete = $this->db->get();
            return $requete->result_array();
        }
    }
?>