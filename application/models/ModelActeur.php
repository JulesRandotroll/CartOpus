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

        public function getMail($Mail)
        {
            $this->db->select('*');
            $this->db->from('Acteur');
            $this->db->where('mail',$Mail);
            $requete = $this->db->get();
            return $requete->row_array();
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
                        'a.noaction'=>$uneAction['noAction'],
                        'p.datedebut'=>$uneAction['datedebut'],
                    );
                    //echo 'Action :';
                    //var_dump($uneAction);
                   // echo 'Conditions : ';
                    //var_dump($Conditions);
                    $this->db->select('*');
                    $this->db->from('EtrePartenaire p');
                    $this->db->join('Action a','a.noaction=p.noaction');
                    $this->db->join('Role r','p.noRole=r.noRole');
                    $this->db->join('AvoirLieu l','l.noAction=a.noAction');
                    $this->db->where($Conditions);
                    $requete = $this->db->get();
                    $temporaire = $requete->result_array();
                    //echo 'Temporaire : ';
                   // var_dump($temporaire);
                    
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
                //echo 'Resultat :';
                //var_dump($Resultats);
                return $Resultats;

            }
        }

        public function UpdateActeur($Donnees,$noActeur)
        {
           // var_dump($Donnees['nom']);
            $Donnees = array('nomacteur' => $Donnees['nom'],'prenomacteur'=>$Donnees['prenom'],'mail'=>$Donnees['mail'],'notel'=>$Donnees['notel'],'noQuestion'=>$Donnees['noquestion'],'Reponse'=>$Donnees['reponse']);
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

        public function UpdateMDP($Donnees,$noActeur)
        {
            var_dump($Donnees);
            $Donnees2 = array('motdepasse' => $Donnees);
            $this->db->where('noActeur',$noActeur);
            $this->db->update('acteur',$Donnees2);
        }

        public function GetPhoto($noActeur)
        {
            $this->db->select('photoprofil');
            $this->db->from('Acteur');
            $this->db->where('noActeur',$noActeur);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function GetProfil($noProfil)
        {
            $this->db->select('*');
            $this->db->from('Acteur');
            $this->db->where('noProfil',$noProfil);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getProfils()
        {
            $this->db->select('*');
            $this->db->from('profil');
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function setProfil($noActeur,$noProfil)
        {   
            $données = array(
                'noProfil'=>$noProfil,
            );

            $this->db->where('noActeur',$noActeur);
            $this->db->update('Acteur',$données);
        }

        public function GetRole()
        {
            $this->db->select('*');
            $this->db->from('Role');
            $requete = $this->db->get();
            return $requete->result_array();
        }
    }


?>