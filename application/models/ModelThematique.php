<?php 
    class ModelThematique extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function getThematiquesExiste($NomThematique)
        {
            $this->db->select('NomThematique');
            $this->db->from('Thematique');
            $this->db->where($NomThematique);
            $requete = $this->db->get();
            return $requete->result_array();
        }
        

        public function getSousThematiqueExiste($Where)
        {
            $this->db->select('*');
            $this->db->from('SousThematique');
            $this->db->where($Where);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getMotCle()
        {
            $this->db->select("DISTINCT(MotCle)");
            $this->db->from("EtreTagge");
            $this->db->order_by('MotCle');
            $requete = $this->db->get();
            return $requete->result_array();
        }


        public function getThematique_SousThematiqueExiste($Where)
        {
            $this->db->select('*');
            $this->db->from('sousThematique');
            $this->db->where($Where);
            $requete = $this->db->get();
            return $requete->result_array();
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

        public function getTheme_SousTheme()
        {
            $Themes = $this->getSurThematiques();
            //var_dump($Themes);
            foreach($Themes as $unTheme)
            {
                //var_dump($unTheme);
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
                        $leTheme = array($unTheme["NOTHEMATIQUE"]=>$unTheme["NOMTHEMATIQUE"]);
                        $array =  $leTheme+ $array;
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
                        $leTheme = array($unTheme["NOTHEMATIQUE"]=>$unTheme["NOMTHEMATIQUE"]);
                        echo 'leTheme';
                        //var_dump($leTheme);
                        $array =  $leTheme+ $array;
                        echo 'array';
                        //var_dump($array);
                        $temp = array($unTheme["NOMTHEMATIQUE"]=>$array);
                         
                    }
                    $final = $final + $temp;   
                }

                $array = null;
            }
            //var_dump($final);

            return $final;
        }
        



        public function getTheme_SousThemeALier()
        {
            $Themes = $this->getSurThematiques();
            //var_dump($Themes);
            foreach($Themes as $unTheme)
            {
                //var_dump($unTheme);
                $Where = array("s.noThematique"=>$unTheme["NOTHEMATIQUE"]);
                $SsTheme = $this->getSousTheme($Where);
                //var_dump($SsTheme);
                foreach($SsTheme as $unSsTheme)
                {
                    if(empty($array) || $array == null)
                    {
                        $array = array($unSsTheme['NOMTHEMATIQUE']=>array($unSsTheme['NOSOUSTHEMATIQUE']=>$unSsTheme['NOMTHEMATIQUE']));
                    }
                    else
                    {
                        $temp = array($unSsTheme['NOMTHEMATIQUE']=>array($unSsTheme['NOSOUSTHEMATIQUE']=>$unSsTheme['NOMTHEMATIQUE']));
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
                        $leTheme = array($unTheme["NOTHEMATIQUE"]=>$unTheme["NOMTHEMATIQUE"]);
                        $array =  $leTheme+ $array;
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
                        $leTheme = array($unTheme["NOTHEMATIQUE"]=>$unTheme["NOMTHEMATIQUE"]);
                        echo 'leTheme';
                        //var_dump($leTheme);
                        $array =  $leTheme+ $array;
                        echo 'array';
                        //var_dump($array);
                        $temp = array($unTheme["NOMTHEMATIQUE"]=>$array);
                         
                    }
                    $final = $final + $temp;   
                }

                $array = null;
            }
            //var_dump($final);

            return $final;
        }


        //Sert aussi à supprimer une sousthematique 
        //Et delier les sous thématiques associées à une thématique 
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

        public function DeleteMotcle($Where)
        {
            $this->db->where($Where);
            $this->db->delete('EtreTagge'); 
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

        public function delierSousthematique($Where)
        {
            $this->db->select('noSousThematique');
            $this->db->from('sousThematique');
            $this->db->where($Where);
            $requete = $this->db->get();
            $SousThematiques = $requete->result_array();

            // var_dump($SousThematiques);

            $this->updateSsThematique_To_Thematique($Where);
            //$this->DeleteThematique($Where);

            foreach($SousThematiques as $uneSousThematique)
            {
                $this->db->from('sousThematique');
                $this->db->where($uneSousThematique);
                $nb = $this->db->count_all_results();

                // var_dump($uneSousThematique);
                // Var_dump($nb);

                if($nb==0)
                {
                    $uneThematique = array('noThematique'=>$uneSousThematique['noSousThematique']);
                    var_dump($uneThematique);
                    $this->DeleteThematique($uneThematique);
                }
            }
        }
    }   


?>