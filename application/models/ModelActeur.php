<?php 
    class ModelActeur extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }


        public function getOrganisation($noActeur)
        {

        }

        public function getActions($noActeur)
        {
            
        }
    }

?>