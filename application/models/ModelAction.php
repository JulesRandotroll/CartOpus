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
        
        public function UpdateAction($NoAction,$DonneesAModifier)
        { 
            
            //var_dump($DonneesAModifier);
            $NoAction=array('NOACTION' =>$NoAction);
            //var_dump($NoAction);
            $Donnees = array('NomAction'=>$DonneesAModifier['NomAction'],'PublicCible'=>$DonneesAModifier['PublicCible'],'SiteURLAction'=>$DonneesAModifier['SiteURLAction']);
            $this->db->where('NOACTION',$NoAction['NOACTION']);
            $this->db->update('action',$Donnees);
        }

        public function UpdateLieu($NoLieu,$DonneesAModifier)
        { 
            //var_dump($DonneesAModifier);
            $NoLieu=array('NoLieu' =>$NoLieu);
            //var_dump($NoLieu);
            $Donnees = array('Adresse'=>$DonneesAModifier['Adresse'],'CodePostal'=>$DonneesAModifier['CodePostal'],'Ville'=>$DonneesAModifier['Ville']);
            $this->db->where('NOLIEU',$NoLieu['NoLieu'][0]['nolieu']);
            $this->db->update('lieu',$Donnees);
        }
        
        public function UpdateAvoirLieu($NoAction,$NoLieu,$DonneesAModifier)
        { 
            var_dump($NoLieu);
            $NoAction=array('NoAction' =>$NoAction);
            $NoLieu=array('NoLieu' =>$NoLieu);
            $Donnees = array('DateDebut'=>$DonneesAModifier['DateDebut'],'DateFin'=>$DonneesAModifier['DateFin'],'TitreAction'=>$DonneesAModifier['TitreAction'],'Description'=>$DonneesAModifier['Description']);
            $this->db->where('NOLIEU',$NoLieu['NoLieu'],'NOACTION',$NoAction['NoAction']);
            $this->db->update('avoirlieu',$Donnees);
        }
        
        public function getFichersPourAction($DonnéesDeTest)
        {   
            
            $this->db->select('FICHIER');
            $this->db->from('Stocker');
            $this->db->where($DonnéesDeTest);
            $requete = $this->db->get();
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
            return $this->db->insert_id();
        }

        public function getLieu($DonnéesLieu)
        {    
            $this->db->select('nolieu');
            $this->db->from('lieu');
            $this->db->where($DonnéesLieu);
            $requete = $this->db->get();
            return $requete->result_array();
        }
    
        public function insertLieu($DonnéesLieu)
        {
            $this->db->insert('Lieu',$DonnéesLieu);
            return $this->db->insert_id();
        }

        public function insertAvoirLieu($InsertAvoirLieu)
        {
            $this->db->insert('AvoirLieu',$InsertAvoirLieu);
        }   
            
        public function insertEtrePartenaire($InsertEtrePartenaire)
        {
            $this->db->insert('EtrePartenaire',$InsertEtrePartenaire);
        }

        public function insertProfilPourAction($InsertProfilPourAction)
        {
            $this->db->insert('ProfilPourAction',$InsertProfilPourAction);
            return $this->db->insert_id();
        }
    
    }
?>