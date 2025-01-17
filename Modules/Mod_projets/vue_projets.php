<?php
class VueProjets {

    public function __construct() {}

    public function afficherListeProjets($projets, $isEnseignant) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liste des projets</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma/css/bulma.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <style>
                body {
                    background-color: #f5f5f5;
                }
                .navbar {
                    background-color: #3273dc;
                }
                .navbar-brand a {
                    color: white;
                    font-weight: bold;
                }
                .hero {
                    background-image: url('https://source.unsplash.com/1600x900/?technology,code');
                    background-size: cover;
                    background-position: center;
                    color: white;
                }
                .hero .title, .hero .subtitle {
                    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
                }
                .card {
                    transition: transform 0.2s ease, box-shadow 0.2s ease;
                }
                .card:hover {
                    transform: scale(1.05);
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
                }
                footer {
                    background-color: #3273dc;
                    color: white;
                    padding: 20px 0;
                }
            </style>
        </head>
        <body>

        <!-- Navigation -->
        <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.php?module=deconnexion" >Deconnexion</a>
                <a class="navbar-item" href="#">Projets</a>
                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero is-medium">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">Bienvenue dans la Liste des Projets</h1>
                    <h2 class="subtitle">Explorez les projets, gérez-les, ou créez-en de nouveaux.</h2>
                    <?php if ($isEnseignant): ?>
                        <a href="index.php?module=creation_projet" class="button is-primary is-large">
                            <span class="icon">
                                <i class="fas fa-plus-circle"></i>
                            </span>
                            <span>Créer un nouveau projet</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section class="section">
            <div class="container">
                <?php if (empty($projets)): ?>
                    <div class="notification is-warning has-text-centered">
                        <strong>Aucun projet disponible pour le moment.</strong>
                    </div>
                <?php else: ?>
                    <div class="columns is-multiline">
                        <?php foreach ($projets as $projet): ?>
                            <div class="column is-one-third">
                                <div class="card">
                                    <header class="card-header">
                                        <p class="card-header-title">
                                            <?php echo htmlspecialchars($projet['nom']); ?>
                                        </p>
                                    </header>
                                    <div class="card-content">
                                        <div class="content">
                                            <p><strong>Description :</strong> <?php echo htmlspecialchars($projet['description']); ?></p>
                                            <p><strong>Semestre :</strong> <?php echo htmlspecialchars($projet['semestre']); ?></p>
                                            <p><strong>Année :</strong> <?php echo htmlspecialchars($projet['annee']); ?></p>
                                        </div>
                                    </div>
                                    <footer class="card-footer">
                                        <a href="index.php?module=projet&action=view&id=<?php echo $projet['id_projet']; ?>" class="card-footer-item has-text-info">
                                            <span class="icon">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                            Voir
                                        </a>
                                        <?php if ($isEnseignant): ?>
                                        <a href="edit.php?id=<?php echo $projet['id_projet']; ?>" class="card-footer-item has-text-warning">
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                            Modifier
                                        </a>
                                        <a href="delete.php?id=<?php echo $projet['id_projet']; ?>" class="card-footer-item has-text-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce projet ?');">
                                            <span class="icon">
                                                <i class="fas fa-trash-alt"></i>
                                            </span>
                                            Supprimer
                                        </a>
                                    <?php endif; ?>

                                    </footer>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="content has-text-centered">
                <p>
                    <strong>Gestion des Projets</strong> par <a href="#">Votre Nom</a>. Propulsé par Bulma et Font Awesome.
                </p>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const burger = document.querySelector('.navbar-burger');
                const menu = document.querySelector('.navbar-menu');

                burger.addEventListener('click', () => {
                    burger.classList.toggle('is-active');
                    menu.classList.toggle('is-active');
                });
            });
        </script>

        </body>
        </html>
        <?php
    }
}
?>
