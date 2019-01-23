<?php 
    class ModelSInscrire extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function Insert_Acteur($donneeAinserer)
        {
            $this->db->insert('acteur', $donneeAinserer);
            return $this->db->insert_id();
        }

        public function Insert_EnCours($donneeAinserer)
        {
            $this->db->insert('encoursinscription', $donneeAinserer);
            return $this->db->insert_id();
        }
        public function Test_Inscrit($donneeATester)
        {
          
           $this->db->select('count(*)');
           $this->db->from('acteur');
           $this->db->where($donneeATester);
           $requete = $this->db->get();
           return $requete->row_array();
           // Select
        }
        public function getActeur($mail)
        {
            $this->db->select('*');
            $this->db->from('Acteur');
            $this->db->where('mail',$mail);
            $requete = $this->db->get();
            return $requete->result_array();
        }
        public function Test_Existe($donneeATester)
        {
           // var_dump($donneeATester);
          //$donneeATester=array('code'=>$code);
           $this->db->select('mail');
           $this->db->from('encoursinscription');
           $this->db->where('code',$donneeATester['code']);
           $requete = $this->db->get();
           return $requete->row_array();
           // Select
        }

        public function QuestionSecrete()
        {
            $this->db->select('*'); 
            $this->db->from('QuestionSecrete');
            $requete = $this->db->get();
            return $requete->result_array();
       
        } 

        public function deleteTempo($mail)
        {
            $donnéesATester=array('mail'=>$mail);
            $tables = array('acteur', 'encoursinscription');
            $this->db->where('mail',$mail);
            $this->db->delete($tables);
        }

        public function Finaliser($DonnéesAUpdate)
        {
            
            //$DonnéesAUpdate=array('finalise'=>$finalise);
            //var_dump($DonnéesAUpdate['finaliser']);
            $this->db->where('NOACTEUR',$DonnéesAUpdate["noActeur"]);
            $this->db->update('acteur',$DonnéesAUpdate);
        }
    }
?>