<?php
require_once 'header.php';
require_once 'footer.php';

class VueCreationProjet
{

    public function afficherFormulaireCreation()
    {
        afficherHeader("Liste des projets");
        ?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Créer un nouveau projet</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma/css/bulma.min.css">
        </head>

        <body>
            <section class="section">
                <div class="container">
                    <h1 class="title">Créer un nouveau projet</h1>
                    <form method="post" action="">
                        <div class="field">
                            <label class="label">Nom du projet</label>
                            <div class="control">
                                <input class="input" type="text" name="nom" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Description</label>
                            <div class="control">
                                <textarea class="textarea" name="description" required></textarea>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Semestre</label>
                            <div class="control">
                                <div class="select">
                                <select name="id_semestre" >
                                    <option value="">Selectionnez un semestre</option>
                                    <option value="1">Semestre 1</option>
                                    <option value="2">Semestre 2</option>
                                    <option value="2">Semestre 3</option>
                                    <option value="2">Semestre 4</option>
                                    <option value="2">Semestre 5</option>
                                    <option value="2">Semestre 6</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Année</label>
                            <div class="control">
                                <div class="select">
                                <select name="id_annee" required>
                                    <option value="">Selectionnez une année</option>
                                    <option value="2023">2022</option>
                                    <option value="2024">2023</option>
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button class="button is-primary" type="submit" name="creer_projet">Créer le projet</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </body>

        </html>
<?php
        afficherFooter();
    }

    public function afficherErreur($message)
    {
        echo "<div class='notification is-danger'>$message</div>";
    }
}

?>