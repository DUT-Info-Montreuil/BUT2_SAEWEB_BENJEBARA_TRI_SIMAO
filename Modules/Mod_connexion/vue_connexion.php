<?php
class VueConnexion {
    public function form_inscription() {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Connexion</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma/css/bulma.min.css">
        </head>
        <body>
        
            <section class="section">
                <div class="container">
                    <div class="columns is-centered">
                        <div class="column is-half">
                            <form action="index.php?module=connexion&action=ajout" method="post" class="box">
                                <div class="field">
                                    <label class="label">Email</label>
                                    <div class="control">
                                        <input class="input" type="text" name="email" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Mot de passe</label>
                                    <div class="control">
                                        <input class="input" type="password" name="passwd" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-primary" type="submit">Se connecter</button>
                                    </div>
                                </div>
                            </form>
                            <form action="index.php?module=connexion&action=hash_passwords" method="post" class="box">
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-warning" type="submit">Hash All Passwords</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </body>
        </html>
        <?php
    }

    public function afficherErreur($message) {
        echo '<div class="notification is-danger">' . htmlspecialchars($message) . '</div>';
    }
}
?>