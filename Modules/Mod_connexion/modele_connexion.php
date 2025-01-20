<?php
require_once 'connexion.php';

class ModeleConnexion extends Connexion {
    public function __construct() {
        self::initConnexion();
    }

    public function verifierConnexion($email, $password) {
        try {
            $query = "SELECT id_utilisateur, mot_de_pass FROM utilisateur WHERE email = :email";
            $stmt = self::$bdd->prepare($query);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['mot_de_pass'])) {
                return $user['id_utilisateur'];
            }
            return false;
        } catch (Exception $e) {
            die("Erreur lors de la connexion : " . $e->getMessage());
        }
    }
    public function hashAllPasswords() {
        try {
            $query = "SELECT id_utilisateur, mot_de_pass FROM utilisateur";
            $stmt = self::$bdd->query($query);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($users as $user) {
                if (password_get_info($user['mot_de_pass'])['algo'] == 0) {
                    $hashedPassword = password_hash($user['mot_de_pass'], PASSWORD_DEFAULT);
                $updateQuery = "UPDATE utilisateur SET mot_de_pass = :password WHERE id_utilisateur = :id";
                $updateStmt = self::$bdd->prepare($updateQuery);
                $updateStmt->execute([
                    ':password' => $hashedPassword,
                    ':id' => $user['id_utilisateur']
                ]);
                }
                
                
            }
            echo "Tous les mots de passe ont été hashés avec succès.";
        } catch (Exception $e) {
            die("Erreur lors du hashage des mots de passe : " . $e->getMessage());
        }
    }
}
?>