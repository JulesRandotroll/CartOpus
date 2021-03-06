<?php 
    class ModelRecherche extends CI_Model
    {

        public function __construct()
        {
            $this->load->database();
            /*chargement database.php (dans config), obligatoirement dans le constructeur*/
        }

        public function nombreRecherche($Recherche = FALSE)
        {
            if($Recherche===false)
            {
                return $this->db->count_all('action');
            }
            $this->db->from('action', 'avoirlieu', 'lieu');
            $this->db->like('NOMACTION', $Recherche);
            $this->db->where('VALIDEE = TRUE');
            $requete = $this->db->count_all_results();
            return $requete;
        }

        public function actionRecherche($nomAction, $nbLignesRetournees, $PremiereLigneRetournee)
        {
            $this->db->limit($nbLignesRetournees, $PremiereLigneRetournee);
            $this->db->select('*');
            $this->db->from('action a');
            $this->db->join('avoirlieu al', 'al.noaction=a.noaction');
            $this->db->join('lieu l', 'al.nolieu=l.nolieu');
            $this->db->like('NOMACTION', $nomAction);
            $this->db->where('VALIDEE = TRUE');
            $query = $this->db->get();
            if($query->num_rows()>0)
            {
                foreach ($query->result_array() as $ligne) 
                {
                    $jeuEnr[] = $ligne;
                }
                return $jeuEnr;
            }
            return FALSE;
            //$requete = $this->db->get();
            //return $requete->result_array();
            
        }

        public function nombreActeur($Recherche = FALSE)
        {
            if($Recherche===false)
            {
                return $this->db->count_all('acteur');
            }
            $this->db->from('acteur');
            $this->db->like('NOMACTEUR', $Recherche);
            $requete = $this->db->count_all_results();
            return $requete;
        }

        public function acteurRecherche($nomActeur, $nbLignesRetournees, $PremiereLigneRetournee)
        {
            $this->db->limit($nbLignesRetournees, $PremiereLigneRetournee);
            $this->db->select('*');
            $this->db->from('acteur');
            $this->db->like('NOMACTEUR', $nomActeur);
            $this->db->or_like('PRENOMACTEUR', $nomActeur);
            $query = $this->db->get();
            if($query->num_rows()>0)
            {
                foreach ($query->result_array() as $ligne) 
                {
                    $jeuEnr[] = $ligne;
                }
                return $jeuEnr;
            }
            return FALSE;
        }

        public function nombreOrganisation($Recherche = FALSE)
        {
            if($Recherche===false)
            {
                return $this->db->count_all('organisation');
            }
            $this->db->from('organisation');
            $this->db->like('NOMORGANISATION', $Recherche);
            $requete = $this->db->count_all_results();
            return $requete;
        }
        public function organisationRecherche($nomOrganisation, $nbLignesRetournees, $PremiereLigneRetournee)
        {
            $this->db->limit($nbLignesRetournees, $PremiereLigneRetournee);
            $this->db->select('*');
            $this->db->from('organisation');
            
            $this->db->like('NOMORGANISATION', $nomOrganisation);

            $query = $this->db->get();
            if($query->num_rows()>0)
            {
                foreach ($query->result_array() as $ligne) 
                {
                    $jeuEnr[] = $ligne;
                }
                return $jeuEnr;
            }
            return FALSE;
        }

        public function nombreThematique($Recherche = FALSE)
        {
            if($Recherche===false)
            {
                return $this->db->count_all('thematique');
            }
            $this->db->from('thematique');
            $this->db->like('NOMTHEMATIQUE', $Recherche);
            $requete = $this->db->count_all_results();
            return $requete;
        }
        public function thematiqueRecherche($nomThematique, $nbLignesRetournees, $PremiereLigneRetournee)
        {
            $this->db->limit($nbLignesRetournees, $PremiereLigneRetournee);
            $this->db->select('*');
            $this->db->from('thematique t');
            $this->db->join('fairereference f', 't.nothematique = f.nothematique');
            $this->db->join('action a', 'f.noaction = a.noaction');
            $this->db->join('avoirlieu al', 'al.noaction=a.noaction');
            $this->db->join('lieu l', 'al.nolieu=l.nolieu');
            $this->db->like('NOMTHEMATIQUE', $nomThematique);
            $this->db->where('VALIDEE = TRUE');
            $query = $this->db->get();
            if($query->num_rows()>0)
            {
                foreach ($query->result_array() as $ligne) 
                {
                    $jeuEnr[] = $ligne;
                }
                return $jeuEnr;
            }
            return FALSE;
        }

        public function nombreLieu($Recherche = FALSE)
        {
            if($Recherche===false)
            {
                return $this->db->count_all('lieu');
            }
            $this->db->from('lieu');
            $this->db->like('Ville', $Recherche);
            $this->db->or_like('CodePostal', $Recherche);
            $this->db->or_like('Adresse', $Recherche);
            $this->db->or_like('Ville', $Recherche);
            $requete = $this->db->count_all_results();
            return $requete;
        }

        public function lieuRecherche($Recherche, $nbLignesRetournees, $PremiereLigneRetournee)
        {
            $this->db->select('noLieu');
            $this->db->from('lieu');
            $this->db->like('Ville', $Recherche);
            $this->db->or_like('Adresse', $Recherche);
            $this->db->or_like('CodePostal', $Recherche);
            $this->db->or_like('nomLieu', $Recherche);
            $query = $this->db->get();
            $test = $query->result_array();
            //var_dump($test);
            
            if(!empty($test))
            {
                $this->db->limit($nbLignesRetournees, $PremiereLigneRetournee);
                $this->db->select('*');
                $this->db->from('organisation');
                $this->db->where_in($test);
                $query = $this->db->get();
                $Orga = $query->result_array();
                //var_dump($Orga);
    
                $this->db->limit($nbLignesRetournees, $PremiereLigneRetournee);
                $this->db->select('*');
                $this->db->from('avoirLieu aL');
                $this->db->join('action a', 'aL.noAction=a.noAction');
                $this->db->join('lieu l', 'al.nolieu=l.nolieu');
                $this->db->where_in($test);
                $this->db->where('VALIDEE = TRUE');
                $query = $this->db->get();
                $Action = $query->result_array();
                //var_dump($Action);
    
                $resultats = array(
                    "actions"=>$Action,
                    "organisations"=>$Orga
    
                );
    
                return $resultats;            
            }
            else 
            {
                return null;
            }
        }

        public function nombreMotCle($Recherche = FALSE)
        {
            if($Recherche===false)
            {
                return $this->db->count_all('etretagge');
            }
            $this->db->from('etretagge');
            $this->db->like('MOTCLE', $Recherche);
            $requete = $this->db->count_all_results();
            return $requete;
        }

        public function motCleRecherche($nomMotCle, $nbLignesRetournees, $PremiereLigneRetournee)
        {
            $this->db->limit($nbLignesRetournees, $PremiereLigneRetournee);
            $this->db->select('*');
            $this->db->from('etretagge e');
            $this->db->join('action a', 'e.noaction=a.noaction');
            $this->db->join('avoirlieu al', 'al.noaction=a.noaction');
            $this->db->join('lieu l', 'al.nolieu=l.nolieu');
            $this->db->where('VALIDEE = TRUE');
            $this->db->like('MOTCLE', $nomMotCle);
            $query = $this->db->get();
            if($query->num_rows()>0)
            {
                foreach ($query->result_array() as $ligne) 
                {
                    $jeuEnr[] = $ligne;
                }
                return $jeuEnr;
            }
            return FALSE;
        }

        public function nombreDateDebut($Recherche = FALSE)
        {
            echo 'date recherche';
            var_dump($Recherche);
            if($Recherche===false)
            {
                return $this->db->count_all('avoirlieu');
            }
            $this->db->from('avoirlieu');
            $this->db->like('DateDebut', $Recherche);
            $requete = $this->db->count_all_results();
            return $requete;
        }

        public function dateDebutRecherche($date, $nbLignesRetournees, $PremiereLigneRetournee)
        {
            $this->db->limit($nbLignesRetournees, $PremiereLigneRetournee);
            $this->db->select('*');
            $this->db->from('avoirlieu al');
            $this->db->join('action a', 'al.noaction=a.noaction');
            $this->db->join('lieu l', 'al.nolieu=l.nolieu');
            $this->db->like('DATEDEBUT', $date);
            //$this->db->like($date);
            $query = $this->db->get();
            if($query->num_rows()>0)
            {
                foreach ($query->result_array() as $ligne) 
                {
                    $jeuEnr[] = $ligne;
                }
                return $jeuEnr;
            }
            
            return FALSE;
            
        }

        public function nombreDateFin($Recherche = FALSE)
        {
            echo 'date recherche';
            var_dump($Recherche);
            if($Recherche===false)
            {
                return $this->db->count_all('avoirlieu');
            }
            $this->db->from('avoirlieu');
            $this->db->like('DateFin', $Recherche);
            $requete = $this->db->count_all_results();
            return $requete;
        }

        public function dateFinRecherche($date, $nbLignesRetournees, $PremiereLigneRetournee)
        {
            $this->db->limit($nbLignesRetournees, $PremiereLigneRetournee);
            $this->db->select('*');
            $this->db->from('avoirlieu al');
            $this->db->join('action a', 'al.noaction=a.noaction');
            $this->db->join('lieu l', 'al.nolieu=l.nolieu');
            $this->db->like('DATEFIN', $date);
            //$this->db->like($date);
            $query = $this->db->get();
            if($query->num_rows()>0)
            {
                foreach ($query->result_array() as $ligne) 
                {
                    $jeuEnr[] = $ligne;
                }
                return $jeuEnr;
            }
            return FALSE;
        }

        public function nombrePeriode($Recherche = FALSE)
        {
            if($Recherche===false)
            {
                return $this->db->count_all('avoirlieu');
            }
            $this->db->from('avoirlieu');
            $this->db->like('DateDebut', 'DateFin', $Recherche);
            $requete = $this->db->count_all_results();
            return $requete;
        }

        public function periodeRecherche($DateDebut, $DateFin, $nbLignesRetournees, $PremiereLigneRetournee)
        {
            $this->db->limit($nbLignesRetournees, $PremiereLigneRetournee);
            $requete = $this->db->query("SELECT * FROM action, avoirlieu, lieu WHERE action.noaction = avoirlieu.noaction AND lieu.nolieu=avoirlieu.nolieu AND DATEDEBUT BETWEEN '".$DateDebut."' AND '".$DateFin."'");
            return $requete->result_array();
        }

    }
?>