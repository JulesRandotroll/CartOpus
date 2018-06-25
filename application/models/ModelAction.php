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
            //var_dump($DonnéesDeTest);
            $this->db->select('*');
            $this->db->from('Action a');
            $this->db->join('AvoirLieu al','al.noAction=a.noAction');
            $this->db->join('Lieu l','l.nolieu=al.nolieu');
            $this->db->where($DonnéesDeTest);
            $requete = $this->db->get();
            return $requete->result_array();
        }
        
        public function getFichersPourAction($DonnéesDeTest,$DateFin)
        {   
            
            if($DateFin != null)
            {
                $requete = $this->db->query("
                    SELECT * 
                    FROM stocker 
                    WHERE NOACTION =". $DonnéesDeTest['a.noaction'] ." 
                    HAVING DATEHEURE BETWEEN '". $DonnéesDeTest['DATEHEURE'] .
                    "' AND '".$DateFin."'"
                );
            }
            else 
            {
                $DateMax = $this->ModelAction->getDerniereAction($DonnéesDeTest['NOACTION']);
                //var_dump($DateMax);
                if($DateMax[0]['dateheure'] != $DonnéesDeTest['DATEHEURE'])
                {
                    $requete = $this->db->query("
                        SELECT * 
                        FROM stocker 
                        WHERE NOACTION = ". $DonnéesDeTest['NOACTION'] ." 
                        HAVING DATEHEURE BETWEEN '". $DonnéesDeTest['DATEHEURE'] .
                        "' AND '".$DateMax[0]['dateheure']."'"
                    );
                }
                else
                {
                    $requete = $this->db->query("
                        SELECT * 
                        FROM stocker 
                        WHERE NOACTION = ". $DonnéesDeTest['NOACTION'] ." 
                        HAVING DATEHEURE > '". $DonnéesDeTest['DATEHEURE']
                    );
                }
            }
            
            return $requete->result_array();

        }

        public function getDerniereAction($noAction)
        {
            $this->db->select_max('datedebut');
            $this->db->from('AvoirLieu');
            $this->db->where('noaction',$noAction);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getSousAction($noAction,$DateDebut,$DateFin)
        {
           //echo $noAction;
            if($DateFin != 0)
            {
                $requete = $this->db->query("
                    SELECT * 
                    FROM Action a, AvoirLieu al, Lieu l
                    WHERE al.noAction=a.noAction 
                    AND l.nolieu=al.nolieu
                    AND a.noaction = ".$noAction.
                    " HAVING `DATEDEBUT` BETWEEN '".$DateDebut."' 
                    AND '".$DateFin."'"
                );
            }
            else 
            {
                $DateMax = $this->ModelAction->getDerniereAction($noAction);
                //var_dump($DateMax);
                if($DateMax[0]['datedebut'] != $DateDebut)
                {
                    $requete = $this->db->query("
                        SELECT * 
                        FROM Action a, AvoirLieu al, Lieu l
                        WHERE al.noAction=a.noAction 
                        AND l.nolieu=al.nolieu
                        AND a.noaction = ".$noAction.
                        " HAVING `DATEDEBUT` BETWEEN '".$DateDebut."' 
                         AND '".$DateMax[0]['datedebut']."'"
                    );
                }
                else
                {
                    $requete = $this->db->query("
                        SELECT * 
                        FROM Action a, AvoirLieu al, Lieu l
                        WHERE al.noAction=a.noAction 
                        AND l.nolieu=al.nolieu
                        AND a.noaction = ".$noAction.
                        " HAVING DATEDEBUT >= '". $DateDebut."'"
                    );
                }
            }
            return $requete->result_array();
            /* 
                SELECT * 
                FROM Action a, AvoirLieu al, Lieu l
                WHERE al.noAction=a.noAction 
                AND l.nolieu=al.nolieu
                AND a.noaction = 4
                HAVING `DateAction` BETWEEN '2018-03-07 13:00:01' 
                AND '2018-06-11 00:00:00' 
            */
        }
        
        public function insertAction($InsertAction)//,$InsertLieu,$InsertAvoirLieu,$InsertEtrePartenaire)
        {
            $this->db->insert('Action',$InsertAction);
            $noAction = $this->db->insert_id();
            
            $this->db->insert('Lieu',$InsertLieu);
            
            $this->db->insert('AvoirLieu',$InsertAvoirLieu);
            
            $this->db->insert('EtrePartenaire',$InsertEtrePartenaire);
        }
    
    }
?>