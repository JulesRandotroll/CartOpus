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
                "SELECT visiteur.noVisiteur as 'no', pseudo as 'nom','' as 'prenom',commentaire , dateheure,'4pPaR31L_1Ph20T' as 'PhotoProfil',0 as 'profil' 
                FROM Visiteur, commentervisiteur, action 
                WHERE visiteur.novisiteur = commentervisiteur.novisiteur 
                AND commentervisiteur.noaction = action.noaction 
                AND action.noAction = $noAction
                UNION 
                SELECT acteur.noacteur, nomacteur,prenomacteur as 'prenom',commentaire ,dateheure, PhotoProfil as 'PhotoProfil', 2 as 'profil' 
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
                SELECT acteur.noacteur, nomacteur as 'nom',prenomacteur as 'prenom',commentaire, dateheure, PhotoProfil as 'PhotoProfil',1 as 'profil' 
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
    }
?>