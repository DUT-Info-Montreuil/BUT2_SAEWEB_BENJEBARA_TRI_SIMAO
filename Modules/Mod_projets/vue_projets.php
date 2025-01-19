<?php

require_once 'header.php';
require_once 'footer.php';

class VueProjets {

    public function __construct() {}

    public function afficherListeProjets($projets, $isEnseignant) {      
          afficherHeader("Liste des projets");

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
                :root {
    --primary-gradient: linear-gradient(135deg, #6e8efb, #4a6cf7);
  --card-gradient: linear-gradient(to right bottom, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.95));
  --shadow-color: rgba(0, 0, 0, 0.1);
  --accent-color: #4a6cf7;
            }           

            /* Styles généraux */
                body {
              background: #f0f2f5;
              font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
              position: relative;
              overflow-x: hidden;
            }           

            /* Animation de fond géométrique */
            body::before {
              content: '';
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              background: 
                radial-gradient(circle at 0% 0%, rgba(110, 142, 251, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 100% 0%, rgba(74, 108, 247, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 100%, rgba(74, 108, 247, 0.1) 0%, transparent 50%);
              z-index: -1;
            }           

            /* Hero Section */
            .hero {
              background: var(--primary-gradient);
              position: relative;
              overflow: hidden;
            }           

            .hero::after {
              content: '';
              position: absolute;
              bottom: -50px;
              left: 0;
              right: 0;
              height: 100px;
              background: #f0f2f5;
              transform: skewY(-3deg);
            }           

            .hero-body {
              padding: 6rem 1.5rem !important;
            }           

            .hero .title {
              color: white;
              font-size: 3rem;
              font-weight: 700;
              text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
              margin-bottom: 1.5rem;
            }           

            .hero .subtitle {
              color: rgba(255, 255, 255, 0.9);
              font-size: 1.5rem;
              margin-bottom: 2rem;
            }           

            /* Cards */
            .card {
              background: var(--card-gradient);
              border-radius: 15px;
              box-shadow: 0 10px 20px var(--shadow-color);
              backdrop-filter: blur(10px);
              border: 1px solid rgba(255, 255, 255, 0.2);
              transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
              overflow: hidden;
            }           

            .card:hover {
              transform: translateY(-10px) scale(1.02);
              box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            }           

            .card-header {
              background: transparent;
              border-bottom: 1px solid rgba(74, 108, 247, 0.1);
            }           

            .card-header-title {
              color: var(--accent-color);
              font-size: 1.25rem;
              font-weight: 600;
            }           

            .card-content {
              padding: 1.5rem;
            }           

            .card-content .content strong {
              color: #363636;
            }           

            /* Card Footer */
            .card-footer {
              border-top: 1px solid rgba(74, 108, 247, 0.1);
              background: rgba(255, 255, 255, 0.5);
            }           

            .card-footer-item {
              transition: all 0.2s ease;
              font-weight: 500;
            }           

            .card-footer-item:hover {
              background: rgba(74, 108, 247, 0.1);
              color: var(--accent-color) !important;
            }           

            .button.is-primary {
              background: white !important;
              color: var(--accent-color) !important;
              border: none;
              padding: 1.5rem 2rem;
              height: auto;
              box-shadow: 0 4px 15px rgba(74, 108, 247, 0.2);
              transition: all 0.3s ease;
            }           

            .button.is-primary:hover {
              transform: translateY(-2px);
              box-shadow: 0 6px 20px rgba(74, 108, 247, 0.3);
            }           

            .notification.is-warning {
              background: linear-gradient(135deg, #ffd86f, #ffc107);
              color: #856404;
              border-radius: 10px;
              padding: 2rem;
              box-shadow: 0 4px 15px rgba(255, 193, 7, 0.2);
            }           

            @media screen and (max-width: 768px) {
              .hero .title {
                font-size: 2rem;
              }

              .hero .subtitle {
                font-size: 1.25rem;
              }

              .card {
                margin: 1rem;
              }
            }           

            @keyframes fadeInUp {
              from {
                opacity: 0;
                transform: translateY(20px);
              }
              to {
                opacity: 1;
                transform: translateY(0);
              }
            }           

            .column {
              animation: fadeInUp 0.6s ease backwards;
            }           

            .column:nth-child(2) {
              animation-delay: 0.2s;
            }           

            .column:nth-child(3) {
              animation-delay: 0.4s;
            }
            .card{
                margin: 1rem;
            }
            </style>
        </head>
        <body>



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
                                          <!--  <p><strong>Année :</strong> <?php echo htmlspecialchars($projet['annee']); ?></p> -->
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
                                        <a href="index.php?module=edit_projet&id=<?php echo $projet['id_projet']; ?>" class="card-footer-item has-text-warning">
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
        afficherFooter();

    }
}
?>
