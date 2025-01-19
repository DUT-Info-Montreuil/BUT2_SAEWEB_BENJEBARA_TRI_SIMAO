<?php
class VueProjet {

    public function __construct() {}

    public function afficherDetailsProjet($projet, $isEnseignant) {
        afficherHeader("Liste des projets");
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Détails du Projet - <?php echo htmlspecialchars($projet['nom']); ?></title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma/css/bulma.min.css">
        </head>
        <body>
            <section class="section">
                <div class="container">
                    <h1 class="title">Détails du Projet : <?php echo htmlspecialchars($projet['nom']); ?></h1>

                    <div class="card">
                        <div class="card-content">
                            <p class="subtitle">ID : <?php echo htmlspecialchars($projet['id_projet']); ?></p>
                            <p><strong>Nom :</strong> <?php echo htmlspecialchars($projet['nom']); ?></p>
                            <p><strong>Description :</strong> <?php echo nl2br(htmlspecialchars($projet['description'])); ?></p>
                            <p><strong>Semestre :</strong> <?php echo htmlspecialchars($projet['semestre']); ?></p>
                            <p><strong>Année :</strong> <?php echo htmlspecialchars($projet['annee']); ?></p>
                        </div>

                        <footer class="card-footer">
                            <a href="index.php" class="card-footer-item">Retour à la liste</a>
                    <?php if ($isEnseignant): ?>

                            <a href="edit.php?id=<?php echo $projet['id_projet']; ?>" class="card-footer-item">Modifier le projet</a>
                        <?php endif; ?>
                        </footer>
                    </div>
                </div>
            </section>
        </body>
        </html>
        <?php
        afficherFooter();
    }

    public function afficherErreur($message) {
        ?>
        <div class="notification is-danger">
            <?php echo $message; ?>
        </div>
        <?php
    }
}
?>