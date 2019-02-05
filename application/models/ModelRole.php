<?php 
    class ModelRole extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }



        public function getRoles()
        {
            $this->db->select('*');
            $this->db->from('role');
            $requete = $this->db->get();
            return  $requete->result_array(); 
        }

        public function getRoleExist($Role)
        {
            $this->db->count_all();
            $this->db->from('role');
            $this->db->where($Role);
            $Existe =  $this->db->count_all_results();
            
            var_dump($Existe);
           if($Existe == 0)
           {
               return true;
           }
           else
           {
               return false;
           }
        }

        public function getIfRoleAttribue($Where)
        {
            $this->db->count_all();
            $this->db->from('EtrePartenaire');
            $this->db->where($Where);
            $nbActeurs =  $this->db->count_all_results();
            
           if($nbActeurs == 0)
           {
               return false;
           }
           else
           {
               return true;
           }
        }


        public function insertRole($newRole)
        {
            $this->db->insert('role',$newRole);
        }


        public function supprRole_tabRole($RoleASupr)
        {
            $this->db->where($RoleASupr);
            $this->db->delete('role');
        }

        public function supprRole_tabEtrePartenaire($RoleASupr)
        {
            $this->db->where($RoleASupr);
            $this->db->delete('etrePartenaire');
        }
    }
?>