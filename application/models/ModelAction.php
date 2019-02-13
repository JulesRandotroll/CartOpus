<?php 
    class ModelAction extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function getActions()
        {
            $this->db->select('*');
            $this->db->from('action a');
            $this->db->join('AvoirLieu al','al.noAction=a.noAction');
            $this->db->where('nomaction=titreaction');
            $this->db->where('VALIDEE = TRUE');
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getActionsValidees()
        {
            $this->db->select('*');
            $this->db->from('action a');
            $this->db->join('AvoirLieu al','al.noAction=a.noAction');
            $this->db->where('nomaction=titreaction');
            $this->db->where('Validee = true');
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getActionsActeur($noActeur)
        {
            $this->db->select('*');
            $this->db->from('action a');
            $this->db->join('etrepartenaire ep','ep.noAction=a.noAction');
            $this->db->where('NOACTEUR',$noActeur);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getActionSimple($noAction)
        {
            $DonnéesDeTest=array("a.NOACTION"=>$noAction);

            $this->db->select('*');
            $this->db->from('action a');
            $this->db->join('AvoirLieu al','al.noAction=a.noAction');
            $this->db->where($DonnéesDeTest);
            $this->db->where('VALIDEE = TRUE');
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getAction($DonnéesDeTest)
        {
            $this->db->select('*');
            $this->db->from('Action a');
            $this->db->join('AvoirLieu al','al.noAction=a.noAction');
            $this->db->join('Lieu l','l.nolieu=al.nolieu');
            $this->db->where($DonnéesDeTest);
            $this->db->where('VALIDEE = TRUE');
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getActionsSignalees()
        {
            /*
            SELECT NOMACTION, PublicCible, e.DateDebut, NomActeur,PrenomActeur,libelleSignalement, compteur
            FROM action a, etrePartenaire e, acteur ac, etresignalee es, signalement s
            WHERE e.noAction=a.noAction
            AND ac.noActeur=e.noActeur
            AND es.noAction = a.noAction
            AND s.noSignalement = es.noSignalement
            AND noRole = 0
            */
            $this->db->select('*');
            $this->db->from('Action a');
            $this->db->join('etrePartenaire e','e.noAction=a.noAction');
            $this->db->join('Acteur ac','ac.noActeur=e.noActeur');
            $this->db->join('etresignalee es', 'es.noAction = a.noAction');
            $this->db->join('signalement s', 's.noSignalement = es.noSignalement');
            $this->db->where('Norole=0');
            $this->db->order_by('NOMACTION ASC, s.noSignalement ASC');
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getAnnonceur($noAction)
        {
            $this->db->select('*');
            $this->db->from('Action a');
            $this->db->join('etrePartenaire e','e.noAction=a.noAction');
            $this->db->join('Acteur ac','ac.noActeur=e.noActeur');
            $this->db->join('etresignalee es', 'es.noAction = a.noAction');
            $this->db->where('a.noaction',$noAction);
            $this->db->where('NOROLE=0');
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getUneSousAction($DonnéesDeTest)
        {
            //var_dump($DonnéesDeTest);
            //var_dump($DateD);
            $this->db->select('*');
            $this->db->from('Avoirlieu');
            $this->db->where($DonnéesDeTest);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function Test($DonnéesDeTest,$DateD)
        {
            //var_dump($DateD);
            //var_dump($DonnéesDeTest);
            $this->db->select('count(*)');
            $this->db->from('Avoirlieu');
            $this->db->where($DonnéesDeTest);
            $this->db->like('DATEDEBUT',$DateD);
            $requete = $this->db->get();
            return $requete->result_array();
        }
        public function GetMaxDate($noAction)
        {
            $this->db->select_max('DATEDEBUT');
            $this->db->from('Avoirlieu');
            $this->db->where('NOACTION',$noAction);
            $requete = $this->db->get();
            return $requete->result_array(); 
        }
        public function getActionFavorite($DonnéesDeTest)
        {
            $this->db->select('*');
            $this->db->from('Action a');
            $this->db->join('AvoirLieu al','al.noAction=a.noAction');
            $this->db->where('TitreAction = nomAction');
            $this->db->where($DonnéesDeTest);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function UpdateProfilAction($DonnéesDeTest,$DonneesAModifier)
        {
            //var_dump($DonnéesDeTest);
            $Where=array('NOACTION'=>$DonnéesDeTest['NoAction'],'NOACTEUR'=>$DonnéesDeTest['NoActeur']);
            $Donnees=array('DATEDEBUT'=>$DonneesAModifier['DateDebut'],'DATEFIN'=>$DonneesAModifier['DateFin']);
            //var_dump($Donnees);
            $this->db->where($Where);
            $this->db->update('profilpouraction',$Donnees);
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

        public function getSousAction($noAction)
        {
           //echo $noAction;
            if($DateFin != 0)
            {
                $requete = $this->db->query("
                    SELECT * 
                    FROM Action a, AvoirLieu al, Lieu l
                    WHERE al.noAction=a.noAction 
                    AND l.nolieu=al.nolieu
                    AND a.noaction = ".$noAction
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

        public function getLieu($DonnéesLieu)
        {    
            //var_dump($DonnéesLieu);
            $this->db->select('nolieu');
            $this->db->from('lieu');
            $this->db->where($DonnéesLieu);
            $requete = $this->db->get();
            return $requete->result_array();
        }
    
        public function getUnLieu($nolieu)
        {
            //var_dump($nolieu);
            $this->db->select('*');
            $this->db->from('lieu');
            $this->db->where('NOLIEU',$nolieu);
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
        
        public function UpdateAvoirLieu($DonnéesDeTest,$DonneesAModifier)
        { 
            
            $Donnees = array('DATEDEBUT'=>$DonneesAModifier['DateDebut'],'DATEFIN'=>$DonneesAModifier['DateFin'],'TitreAction'=>$DonneesAModifier['TitreAction'],'Description'=>$DonneesAModifier['Description'],'NOLIEU'=>$DonneesAModifier['NOLIEU']);
            $this->db->where($DonnéesDeTest);
            $this->db->update('avoirlieu',$Donnees);
        }
        
        public function updateValider($Where,$Valid)
        {
            $this->db->where($Where);
            $this->db->update('Action',$Valid);
        }

        public function UpdateEtrePartenaire($DonnéesDeTest,$DonneesAModifier)
        {
            //var_dump($DonnéesDeTest);
            $Where=array('NOACTION'=>$DonnéesDeTest['NoAction'],'NOACTEUR'=>$DonnéesDeTest['NoActeur']);
            $Donnees=array('DATEDEBUT'=>$DonneesAModifier['DateDebut'],'DATEFIN'=>$DonneesAModifier['DateFin']);
            //var_dump($Donnees);
            $this->db->where($Where);
            $this->db->update('etrepartenaire',$Donnees);
        }

        public function setFavoris($Where,$Set)
        {
            $this->db->Where($Where);
            $this->db->update('action',$Set);
        }

        public function insertAction($InsertAction)//,$InsertLieu,$InsertAvoirLieu,$InsertEtrePartenaire)
        {
            $this->db->insert('Action',$InsertAction);
            return $this->db->insert_id();
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

        public function Suppr_Action($DonneesASupprimer)
        {
           // var_dump($DonneesASupprimer);
            $this->db->where('noAction', $DonneesASupprimer);
            $this->db->delete('action');
        }

        public function Suppr_AvoirLieu($DonneesASupprimer)
        {
           // var_dump($DonneesASupprimer);
            $this->db->where('noAction', $DonneesASupprimer);
            $this->db->delete('avoirlieu');
        }

        public function Suppr_EtrePartenaire($DonneesASupprimer)
        {
           // var_dump($DonneesASupprimer);
            $this->db->where('noAction', $DonneesASupprimer);
            $this->db->delete('etrepartenaire');
        }

        public function Suppr_ProfilPourAction($DonneesASupprimer)
        {
           // var_dump($DonneesASupprimer);
            $this->db->where('noAction', $DonneesASupprimer);
            $this->db->delete('profilpouraction');
        }

        public function SousActionSuppr_AvoirLieu($DonneesASupprimer)
        {
           // var_dump($DonneesASupprimer);
            $this->db->where($DonneesASupprimer);
            $this->db->delete('avoirlieu');
        }

        public function getDate($noAction)
        {    
           // var_dump($noAction);
            $this->db->select('DATEDEBUT');
            $this->db->from('avoirlieu');
            $this->db->where('NOACTION',$noAction);
            $requete = $this->db->get();
            return $requete->result_array();
        }
    
        public function getMotClePourAction($noAction)
        {
            $this->db->select('*');
            $this->db->from('etretagge e');
            $this->db->join('action a', 'a.noAction = e.noAction');
            $this->db->where('a.noaction',$noAction);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getPartenaire($noAction)
        {
            $this->db->select('*');
            $this->db->from('action a');
            $this->db->join('etrepartenaire e', 'a.noAction = e.noAction');
            $this->db->join('acteur ac', 'e.noActeur = ac.noActeur');
            $this->db->where('a.noaction',$noAction);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getSignalements() 
        {
            $this->db->select('*');
            $this->db->from('Signalement');
            $this->db->order_by('noSignalement', 'DESC');
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function insererSignalement($donneeAinserer)
        {
            $this->db->insert('etresignalee', $donneeAinserer);
            return $this->db->insert_id();
        }
    }
?>