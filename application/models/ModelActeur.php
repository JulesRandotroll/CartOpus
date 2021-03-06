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

        public function getNoActeur($mail)
        {
            $this->db->select('NOACTEUR');
            $this->db->from('Acteur');
            $this->db->where('MAIL',$mail);
            $requete = $this->db->get();
            return $requete->result_array();
        }
        public function getMail($DonneesTest)
        {
            $Wheres=array('MAIL'=>$DonneesTest['Mail']);
            $this->db->select('*');
            $this->db->from('Acteur');
            $this->db->where($Wheres);
            $requete = $this->db->get();
            return $requete->row_array();
        }
        
        public function TestDoublon($DonneesTest)
        {
            $Wheres=array('MAIL'=>$DonneesTest['Mail'],'NOMACTEUR'=>$DonneesTest['NomActeur']);
            $this->db->select('*');
            $this->db->from('Acteur');
            $this->db->where($Wheres);
            $requete = $this->db->get();
            return $requete->row_array();
        }
        public function getOrganisation($noActeur)
        {
            $this->db->distinct();
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

        // public function getActions($noActeur)
            // {
            //     $this->db->select('noAction, datedebut');
            //     $this->db->from('EtrePartenaire p');
            //     $this->db->join('Role r','p.noRole=r.noRole');
            //     $this->db->where('noActeur',$noActeur);
            //     $requete = $this->db->get();
            //     $noActions = $requete->result_array();
            //     //var_dump($noActions);
            //     if(empty($noActions))
            //     {
            //         return NULL;
            //     }
            //     else
            //     {
            //         $i = 0;
            //         foreach($noActions as $uneAction)
            //         {
            //             $Conditions = array(
            //                 'p.noaction'=>$uneAction['noAction'],
            //                 'p.datedebut'=>$uneAction['datedebut'],
            //             );
            //             //var_dump($uneAction);
            //             $this->db->select('*');
            //             $this->db->from('EtrePartenaire p');
            //             $this->db->join('Action a','a.noaction=p.noaction');
            //             $this->db->join('Role r','p.noRole=r.noRole');
            //             $this->db->join('AvoirLieu l','l.noAction=a.noAction');
            //             $this->db->where($Conditions);
            //             $requete = $this->db->get();
            //             $temporaire = $requete->result_array();
            //             //var_dump($temporaire);
                        
            //             $Temp = $temporaire[0];
            //             if(empty($Resultats))
            //             {
            //                 $Resultats = array($i=>$Temp);
            //             }
            //             else
            //             {
            //                 $Resultats = $Resultats + array($i=>$Temp);
            //             }
            //             $i +=1;
            //         }
            //         //var_dump($Resultats);
            //         return $Resultats;

        //}
        //}

        public function getActions($noActeur)
        {
            // echo $noActeur;
            $this->db->select('p.noAction, p.datedebut');
            $this->db->from('EtrePartenaire p');
            $this->db->join('Role r','p.noRole=r.noRole');
            $this->db->join('profilpouraction ppa','ppa.noActeur=p.noActeur');
            $this->db->where('p.noActeur',$noActeur);
            $this->db->where('ppa.noProfil',3);
            $this->db->group_by('p.noAction');
            $this->db->order_by("datedebut", "desc");
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
                    $requete = $this->db->query("
                    SELECT * 
                    FROM etrepartenaire p, action a, Role r, AvoirLieu l 
                    WHERE a.noaction=p.noaction 
                    AND p.noRole=r.noRole 
                    AND l.noAction=a.noAction
                    AND l.DATEDEBUT = p.DATEDEBUT
                    AND l.DATEDEBUT = '".$uneAction['datedebut']."' 
                    AND l.NOACTION in ( 
                        SELECT a.noAction 
                        FROM etrepartenaire p, action a, Role r, AvoirLieu l 
                        WHERE a.noaction=p.noaction 
                        AND p.noRole=r.noRole 
                        AND l.noAction=a.noAction
                        AND l.DATEDEBUT = p.DATEDEBUT 
                        AND l.NOACTION=".$uneAction['noAction']." )
                    
                    ");

                    // le in est a enlever ?
                    $temporaire = $requete->result_array();
                    //var_dump($temporaire);    
                    
                    if(!empty($temporaire))
                    {    
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

                }
                //echo 'Resultat :';
                //var_dump($Resultats);
                return $Resultats;

            }
        }

        public function UpdateActeur($Donnees,$noActeur)
        {
            //var_dump($Donnees);
            $Donnees = array('nomacteur' => $Donnees['nom'],'prenomacteur'=>$Donnees['prenom'],'mail'=>$Donnees['mail'],'notel'=>$Donnees['notel'],'noQuestion'=>$Donnees['noquestion'],'Reponse'=>$Donnees['reponse'],'MailVisible'=>$Donnees['mailvisible'],'NoTelVisible'=>$Donnees['notelvisible']);
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
            //var_dump($Donnees);
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

        public function getUnProfil($noActeur,$noAction)
        {
            $Wheres=array('NOACTEUR'=>$noActeur,
                'NOACTION'=>$noAction);

            $this->db->select('noprofil');
            $this->db->from('profilpouraction');
            $this->db->where($Wheres);
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

        public function GetRoles()
        {
            $this->db->select('*');
            $this->db->from('Role');
            $this->db->not_like('NOROLE', '0');
            $requete = $this->db->get();
            return $requete->result_array();
        }

    }

?>