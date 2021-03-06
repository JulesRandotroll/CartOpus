<?php 
    class ModelCommentaire extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /*chargement database.php (dans config), obligatoirement dans le constructeur*/
        }

        public function getCommentaireVisiteur()
        {
            $this->db->select('*');
            $this->db->from('visiteur v');
            $this->db->join('commentervisiteur cv', 'cv.novisiteur = v.novisiteur');
            $this->db->join('action a','cv.noAction=a.noAction');
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getCommUnVisiteur($noVisiteur)
        {
            $this->db->select('*');
            $this->db->from('commentervisiteur');
            $this->db->where('NOVISITEUR',$noVisiteur);
            $requete = $this->db->get();
            return $requete->result_array();
        }
        public function insererCommentaireVisiteur($donneeAinserer)
        {
            $this->db->insert('commentervisiteur', $donneeAinserer);
            return $this->db->insert_id();
        }

        public function insererCommentaireActeur($donneeAinserer)
        {
            $this->db->insert('commenteracteur', $donneeAinserer);
            return $this->db->insert_id();
        }

        public function getCommentaires($noAction)
        {
            $requete = $this->db->query
            (
                "SELECT visiteur.noVisiteur as 'no', pseudo as 'nom','' as 'prenom',commentaire , dateheure,'4pPaR31L_1Ph20T' as 'PhotoProfil',0 as 'profil', noCommentaireVisiteur as 'noCommentaire' 
                FROM Visiteur, commentervisiteur, action 
                WHERE visiteur.novisiteur = commentervisiteur.novisiteur 
                AND commentervisiteur.noaction = action.noaction 
                AND action.noAction = $noAction
                UNION 
                SELECT acteur.noacteur as 'no', nomacteur,prenomacteur as 'prenom',commentaire ,dateheure, PhotoProfil as 'PhotoProfil', 2 as 'profil' , noCommentaireActeur as 'noCommentaire'
                FROM acteur, commenteracteur, action 
                WHERE acteur.noacteur = commenteracteur.NOACTEUR 
                AND commenteracteur.noaction = action.noaction 
                AND action.noAction = $noAction 
                AND acteur.noacteur IN 
                ( 
                    SELECT noActeur 
                    FROM etrepartenaire 
                    WHERE noAction = $noAction 
                ) 
                UNION 
                SELECT acteur.noacteur as 'no', nomacteur as 'nom',prenomacteur as 'prenom',commentaire, dateheure, PhotoProfil as 'PhotoProfil', noprofil as 'profil' , noCommentaireActeur as 'noCommentaire'
                FROM acteur, commenteracteur, action 
                WHERE acteur.noacteur = commenteracteur.NOACTEUR 
                AND commenteracteur.noaction = action.noaction 
                AND action.noAction = $noAction 
                AND acteur.noacteur NOT IN 
                ( 
                    SELECT noacteur 
                    FROM etrepartenaire 
                    WHERE noaction = $noAction 
                )
                ORDER BY dateheure DESC;"
            );
            return $requete->result_array();
        }

        public function DeleteVisiteur($noVisiteur)
        {
            $tables=array('commenterVisiteur', 'Visiteur');
            $this->db->where('noVisiteur', $noVisiteur);
            $this->db->delete($tables);
        }
        public function insererSignalementComm($donneeAinserer)
        {
            $this->db->insert('signalementcommentaire', $donneeAinserer);
            return $this->db->insert_id();
        }

        public function getCommentairesSignales()
        {
            $this->db->select('*');
            $this->db->from('signalementcommentare sc');
            $this->db->join('signalement s','s.noSignalement=sc.noSignalement');
            $requete = $this->db->get();
            return $requete->result_array();
        }
    }
?>