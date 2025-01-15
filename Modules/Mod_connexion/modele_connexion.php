<?php
require_once 'connexion.php';

class ModeleConnexion extends Connexion {

    public function __construct() {
        self::initConnexion();
    }

    public function connecter_util($id, $passwd) {
        $sth = self::$bdd->prepare("SELECT mot_de_pass FROM utilisateur WHERE login = :login");
        $sth->execute([':login' => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);
        //$sth->execute([':id_utilisateur' => $id,':mot_de_pass' => password_hash($passwd, PASSWORD_DEFAULT)]);
        $passwd_hash = $sth->execute([':login' => $id]);
        /*
        if ($passwd_hash) {
            if (password_verify($passwd, $passwd_hash)) {
                echo 'Le mot de passe est valide !'; 
            } else {
                echo 'Le mot de passe est invalide !';
            }
        }
        */
        if (!$result) {
            echo "Cette personne n'existe pas";
            return false; 
        }  
        
        $passwd_hash = $result['mot_de_pass'];

        if (password_verify($passwd, $passwd_hash)) {
            echo "Connexion réussie ! Le mot de passe est valide !";
            return true;
        } else {
            echo "Mot de passe incorrect";
            return false;
        }
    }
    
}
?>