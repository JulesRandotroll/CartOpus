<?php 
    class ModelActeur extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function getActeur($noActeur) 
        {
            $this->db->select('*');
            $this->db->from('Acteur');
            $this->db->where('noActeur',$noActeur);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getOrganisation($noActeur)
        {
            $this->db->select('No_Organisation');
            $this->db->from('TravaillerDans');
            $this->db->where('noActeur',$noActeur);
            $requete = $this->db->get();
            $no_Organisation =  $requete->result_array();
            //var_dump($no_Organisation);
            
            if(empty($no_Organisation))
            {
                return NULL;
            }
            else
            {   
                $i = 0;
                foreach($no_Organisation as $uneOrga)
                {
                    //var_dump($uneOrga);
                    $this->db->select('*');
                    $this->db->from('Organisation o');
                    $this->db->join('Lieu l','o.nolieu=l.nolieu');
                    $this->db->where('No_Organisation',$uneOrga['No_Organisation']);
                    $requete = $this->db->get();
                    $temporaire = $requete->result_array();
                    //var_dump($temporaire);
                    $Temp = $temporaire[0];
                    if(empty($Resultats))
                    {
                        $Resultats = array($i=>$Temp);
                        
                    }
                    else
                    {
                        $Resultats = $Resultats + array($i=>$Temp);
                    }
                    $i +=1;
                }
                return $Resultats;
            }
        }
        public function getActions($noActeur)
        {
            $this->db->select('noAction, datedebut');
            $this->db->from('EtrePartenaire p');
            $this->db->join('Role r','p.noRole=r.noRole');
            $this->db->where('noActeur',$noActeur);
            $requete = $this->db->get();
            $noActions = $requete->result_array();
            //var_dump($noActions);
            if(empty($noActions))
            {
                return NULL;
            }
            else
            {
                $i = 0;
                foreach($noActions as $uneAction)
                {
                    $Conditions = array(
                        'p.noaction'=>$uneAction['noAction'],
                        'p.datedebut'=>$uneAction['datedebut'],
                    );
                    //var_dump($uneAction);
                    $this->db->select('*');
                    $this->db->from('EtrePartenaire p');
                    $this->db->join('Action a','a.noaction=p.noaction');
                    $this->db->join('Role r','p.noRole=r.noRole');
                    $this->db->join('AvoirLieu l','l.noAction=a.noAction');
                    $this->db->where($Conditions);
                    $requete = $this->db->get();
                    $temporaire = $requete->result_array();
                    //var_dump($temporaire);
                    
                    $Temp = $temporaire[0];
                    if(empty($Resultats))
                    {
                        $Resultats = array($i=>$Temp);
                    }
                    else
                    {
                        $Resultats = $Resultats + array($i=>$Temp);
                    }
                    $i +=1;
                }
                //var_dump($Resultats);
                return $Resultats;

            }
        }

        public function UpdateActeur($Donnees,$noActeur)
        {
         
            $Donnees = array('nomacteur' => $NomActeur,'prenomacteur'=>$PrenomActeur,'motdepasse'=>$mdp,'mail'=>$mail,'notel'=>$tel,'noQuestion'=>$Questions,'Reponse'=>$Reponse);
            $this->db->where('noActeur',$noActeur);
            $this->db->update('acteur',$Donnees);
        }

        public function UpdatePhoto($AnciennePhoto,$NewPhoto,$noActeur)
        {
            //var_dump($noActeur);
           //var_dump($AnciennePhoto);
           // var_dump($NewPhoto);
            $Donnees = array('PhotoProfil' => $NewPhoto);
            $this->db->where('noActeur',$noActeur);
            $this->db->where('PhotoProfil',$AnciennePhoto);
            $this->db->update('acteur',$Donnees);
        }

        public function GetPhoto($noActeur)
        {
            $this->db->select('photoprofil');
            $this->db->from('Acteur');
            $this->db->where('noActeur',$noActeur);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function UploadPhoto($photo)
        {
            $config['upload_path'] = '../assets/images/'; 
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
            $config['max_size'] = '2048'; 
            $config['max_width']  = '1024';
            $config['max_height']  = '768'; 
            $config['overwrite'] = TRUE;
    
            $this->load->library("upload", $config);
            return $this->upload->$photo;
        }
    }


/*
SELECT * 
FROM action a, etrepartenaire p, role r
WHERE a.noaction=p.noaction AND r.norole=p.norole
AND a.noaction = 1 AND datedebut = 2018-06-19 16:00:00
*/


?>