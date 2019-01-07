<?php 
    class ModelThematique extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        // public function getThematiques()
            // {
            //     $NotIn = $this->ModelThematique->getAllFromSousThematique();
            //     var_dump($NotIn);

            //     foreach($NotIn as $uneSousThematique)
            //     {
            //         echo 'Southématique';
            //         var_dump($uneSousThematique);
                    
            //         if(empty($Donnees))
            //         {
            //             $Donnees = array($uneSousThematique['nosousthematique']);
            //             echo 'miniDonnées 1 : ';
            //             var_dump($Donnees);
            //         }
            //         else
            //         {
            //             $temp = array($uneSousThematique['nosousthematique']);
            //             echo 'Temp : ';
            //             var_dump($temp);
            //             $Donnees = $Donnees + $temp;
            //             echo 'miniDonnées : ';
            //             var_dump($Donnees);
            //         }
            //     }



            //     echo 'Données :';
            //     var_dump($Donnees);

            //     $this->db->select('*');
            //     $this->db->from('thematique');
            //     $this->db->where_not_in('nothematique',$Données);
            //     $requete = $this->db->get();
            //     return $requete->result_array();
        // }

        public function getSurThematiques()
        {
<<<<<<< HEAD
            $requete = $this->db->query('
                SELECT * 
                FROM thematique 
                WHERE nothematique NOT IN ( 
                    SELECT NoSousThematique FROM SousThematique 
                    );
            '); 
           return $requete->result_array();
=======
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
>>>>>>> 53000f7dd0c9bd8003252428d99bff76a805e21e
        }

        public function getThematiquesExiste($NomThematique)
        {
            $this->db->select('NomThematique');
            $this->db->from('Thematique');
            $this->db->where($NomThematique);
            $requete = $this->db->get();
            return $requete->result_array();
        }
        
        public function InsererThematique($Donnees)
        {
            $this->db->insert('Thematique',$Donnees);
            return $this->db->insert_id();
        }
    
        public function InsererSousThematique($Donnees)
        {
            $this->db->insert('SousThematique',$Donnees);
        }
    }   

?>