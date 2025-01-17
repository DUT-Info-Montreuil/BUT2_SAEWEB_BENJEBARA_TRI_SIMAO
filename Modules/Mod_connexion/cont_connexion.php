<?php
require_once 'modele_connexion.php';
require_once 'vue_connexion.php';

class ContConnexion {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleConnexion();
        $this->vue = new VueConnexion();
        session_start();
    }

    public function form() {
        if (isset($_SESSION['id_utilisateur'])) {
            header("Location: index.php?module=projets");
            exit();
        }
        $this->vue->form_inscription();
    }

    public function ajout_data() {
        if (isset($_POST['email'], $_POST['passwd'])) {
            $email = htmlspecialchars($_POST['email']);
            $passwd = $_POST['passwd'];
            
            $user_id = $this->modele->verifierConnexion($email, $passwd);
            
            #$this->modele->hashAllPasswords();
            if ($user_id) {
                $_SESSION['id_utilisateur'] = $user_id;
                $_SESSION['email'] = $email;
                header("Location: index.php?module=projets");
                exit();
            } else {
                $this->vue->afficherErreur("Email ou mot de passe incorrect");
            }
        }
    }
}
?>