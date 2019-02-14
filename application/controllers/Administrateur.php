<?php
class Administrateur extends CI_Controller {

    public function __construct()
    {
       parent::__construct();
       //$this->load->model('ModeleArticle');
  
       /* les méthodes du contrôleur Administrateur doivent n'être
       accessibles qu'à l'administrateur (Nota Bene : a chaque appel
       d'une méthode d'Administrateur on a appel d'abord du constructeur */
    //    $this->load->library('session');
    //    if ($this->session->statut==0) // 0 : statut visiteur
    //    {
    //      $this->load->helper('url'); // pour utiliser redirect
    //      redirect('/visiteur/seConnecter'); // pas les droits : redirection vers connexion
    //    }
    } // __construc

}
?>