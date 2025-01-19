<?php
class VueProjet {

    public function __construct() {}

    public function afficherDetailsProjet($projet, $ressources, $rendus, $soutenances, $groupes, $isEnseignant) {
        afficherHeader("Liste des projets");
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Détails du Projet - <?php echo htmlspecialchars($projet['nom']); ?></title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma/css/bulma.min.css">
            <style>
                body {
                    background-color: #f5f5f5;
                }
                .container {
                    margin-top: 20px;
                }
                .card {
                    margin-bottom: 20px;
                }

                @media screen and (max-width: 768px) {
                    .card{
                margin: 1rem;
            }
                }
            </style>
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
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <h2 class="subtitle">Ressources</h2>
                            <?php if (empty($ressources)): ?>
                                <p>Aucune ressource disponible pour ce projet.</p>
                            <?php else: ?>
                                <ul>
                                    <?php foreach ($ressources as $ressource): ?>
                                        <li>
                                            <a href="<?php echo htmlspecialchars($ressource['lien']); ?>" target="_blank">
                                                <?php echo htmlspecialchars($ressource['titre']); ?>
                                            </a>
                                             (Type: <?php echo htmlspecialchars($ressource['type']); ?>)
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <h2 class="subtitle">Rendus</h2>
                            <?php if (empty($rendus)): ?>
                                <p>Aucun rendu demandé pour ce projet.</p>
                            <?php else: ?>
                                <ul>
                                    <?php foreach ($rendus as $rendu): ?>
                                        <li>
                                            <strong><?php echo htmlspecialchars($rendu['nom']); ?></strong>
                                            (Date limite : <?php echo htmlspecialchars($rendu['date_limite']); ?>)
                                            <p>Description : <?php echo nl2br(htmlspecialchars($rendu['description'])); ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <h2 class="subtitle">Soutenances</h2>
                            <?php if (empty($soutenances)): ?>
                                <p>Aucune soutenance prévue pour ce projet.</p>
                            <?php else: ?>
                                <ul>
                                    <?php foreach ($soutenances as $soutenance): ?>
                                        <li>
                                            <strong><?php echo htmlspecialchars($soutenance['titre']); ?></strong>
                                            (Date : <?php echo htmlspecialchars($soutenance['date_soutenance']); ?>)
                                            <?php foreach ($groupes as $groupe):
                                                if ($groupe['id_groupe'] == $soutenance['id_groupe']): ?>
                                                     - Groupe : <?php echo htmlspecialchars($groupe['nom']); ?>
                                                <?php endif;
                                             endforeach; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <h2 class="subtitle">Groupes affectés</h2>
                            <?php if (empty($groupes)): ?>
                                <p>Aucun groupe affecté à ce projet.</p>
                            <?php else: ?>
                                <ul>
                                    <?php foreach ($groupes as $groupe): ?>
                                        <li>
                                            <?php echo htmlspecialchars($groupe['nom']); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card">
                        <footer class="card-footer">
                            <a href="index.php" class="card-footer-item">Retour à la liste</a>
                            <?php if ($isEnseignant): ?>
                                <a href="index.php?module=edit_projet&id=<?php echo $projet['id_projet']; ?>" class="card-footer-item">Modifier le projet</a>
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