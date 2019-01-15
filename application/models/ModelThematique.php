<?php 
    class ModelThematique extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }


        public function getSurThematiques()
        {
            $requete = $this->db->query('
                SELECT * 
                FROM thematique 
                WHERE nothematique NOT IN ( 
                    SELECT NoSousThematique FROM SousThematique 
                    )
                ORDER BY NOMTHEMATIQUE ASC
            '); 
           return $requete->result_array();
        }

        public function getSousTheme($Where)
        {
            $this->db->select('s.NOSOUSTHEMATIQUE,t.NOMTHEMATIQUE');
            $this->db->from('sousthematique s');
            $this->db->join('thematique t','t.nothematique=s.nosousthematique');
            $this->db->where($Where);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getSousThemes()
        {
            $this->db->select('DISTINCT(NOMTHEMATIQUE), NOSOUSTHEMATIQUE');
            $this->db->from('sousthematique s');
            $this->db->join('thematique t','t.nothematique=s.nosousthematique');
            $this->db->order_by('t.NOMTHEMATIQUE','ASC');
            $requete = $this->db->get();
            return $requete->result_array();
            
        }

        public function getThematiquesExiste($NomThematique)
        {
            $this->db->select('NomThematique');
            $this->db->from('Thematique');
            $this->db->where($NomThematique);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getMotCleExiste($Donnees)
        {
            $this->db->select("MotCle");
            $this->db->from("FaireReference");
            $this->db->where($Donnees);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getTheme_SousTheme()
        {
            $Themes = $this->getSurThematiques();
            //var_dump($Themes);
            foreach($Themes as $unTheme)
            {
                $Where = array("s.noThematique"=>$unTheme["NOTHEMATIQUE"]);
                $SsTheme = $this->getSousTheme($Where);
                //var_dump($SsTheme);
                foreach($SsTheme as $unSsTheme)
                {
                    if(empty($array) || $array == null)
                    {
                        $array = array($unSsTheme['NOSOUSTHEMATIQUE']=>$unSsTheme['NOMTHEMATIQUE']);
                    }
                    else
                    {
                        $temp = array($unSsTheme['NOSOUSTHEMATIQUE']=>$unSsTheme['NOMTHEMATIQUE']);
                        $array = $array + $temp;
                    }
                }

                if(empty($final))
                {
                    if(empty($array) || $array == null)
                    {
                        $final = array($unTheme["NOMTHEMATIQUE"]=>array($unTheme["NOTHEMATIQUE"]=>$unTheme["NOMTHEMATIQUE"]));
                    }
                    else
                    {
                        $final = array($unTheme["NOMTHEMATIQUE"]=>$array);
                    }
                }
                else
                {
                    if(empty($array) || $array == null)
                    {
                        $temp = array($unTheme["NOMTHEMATIQUE"]=>array($unTheme["NOTHEMATIQUE"]=>$unTheme["NOMTHEMATIQUE"]));
                    }
                    else
                    {
                        $temp = array($unTheme["NOMTHEMATIQUE"]=>$array);
                         
                    }
                    $final = $final + $temp;   
                }

                $array = null;
            }
            return $final;
        }
        
        //Sert aussi à supprimer une sousthematique 
        public function updateSsThematique_To_Thematique($Where)
        {
            
            $this->db->where($Where);
            $this->db->delete('sousThematique');
        }

        public function DeleteThematique($Where)
        {
            $this->db->where($Where);
            $this->db->delete('Thematique');
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