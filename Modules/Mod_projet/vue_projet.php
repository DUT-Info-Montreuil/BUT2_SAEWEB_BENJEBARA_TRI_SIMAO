<?php

require_once 'header.php';
require_once 'footer.php';

class VueProjet {

    public function __construct() {}

    public function afficherProjet($projet, $ressources, $rendus, $soutenances, $groupes, $etudiants, $notes, $etudiantConnecte) {
        afficherHeader("Projet");
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Projet : <?php echo htmlspecialchars($projet['nom']); ?></title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
            <style>
                body {
                    font-family: 'Inter', sans-serif;
                    background-color: #f5f5f5;
                }
                .container {
                    margin-top: 20px;
                }
                .card {
                    margin-bottom: 20px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    border-radius: 6px;
                }
                .navbar {
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                .navbar-item.is-active {
                    background-color: #e0e0e0;
                    color: #3273dc;
                }
                .section-title {
                    font-size: 1.5rem;
                    font-weight: 600;
                }
                .subtitle {
                    font-size: 1.25rem;
                    font-weight: 600;
                    margin-top: 1.5rem;
                    margin-bottom: 1rem;
                }
                .is-hidden {
                    display: none !important;
                }
                .toggle-section {
                    cursor: pointer;
                }
                .toggle-section .icon {
                    transition: transform 0.3s ease;
                }
                .toggle-section.is-active .icon {
                    transform: rotate(90deg);
                }
            </style>
        </head>
        <body>

        <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
            <div class="navbar-brand" style="display: flex; align-items: center; justify-content: center;">
                <a class="navbar-item" href="index.php?module=projets">
                    <span class="icon"><i class="fas fa-tasks"></i></span>
                    <span style="font-weight: bold; color: black;">Projet</span>
                </a>
                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarMenu" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item is-active" data-section="projet">
                        <span class="icon"><i class="fas fa-project-diagram"></i></span>
                        <span>Projet</span>
                    </a>
                    <a class="navbar-item" data-section="ressources">
                        <span class="icon"><i class="fas fa-folder-open"></i></span>
                        <span>Ressources</span>
                    </a>
                    <a class="navbar-item" data-section="rendus">
                        <span class="icon"><i class="fas fa-file-alt"></i></span>
                        <span>Rendus</span>
                    </a>
                    <a class="navbar-item" data-section="soutenances">
                        <span class="icon"><i class="fas fa-chalkboard-teacher"></i></span>
                        <span>Soutenances</span>
                    </a>
                    <a class="navbar-item" data-section="groupes">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <span>Groupe</span>
                    </a>
                    <a class="navbar-item" data-section="notes">
                        <span class="icon"><i class="fas fa-graduation-cap"></i></span>
                        <span>Notes</span>
                    </a>
                </div>
            </div>
        </nav>

        <section class="section">
            <div class="container">
                <h1 class="title">Projet : <?php echo htmlspecialchars($projet['nom']); ?></h1>

                <div class="card" data-section-content="projet">
                    <div class="card-content">
                        <h2 class="section-title toggle-section is-active">
                            <span class="icon"><i class="fas fa-chevron-right"></i></span>
                            <span>Informations du projet</span>
                        </h2>
                        <div class="content section-content">
                            <p><strong>Nom du projet :</strong> <?php echo htmlspecialchars($projet['nom']); ?></p>
                            <p><strong>Description :</strong> <?php echo htmlspecialchars($projet['description']); ?></p>
                        </div>
                    </div>
                </div>

                <div class="card" data-section-content="ressources">
                    <div class="card-content">
                        <h2 class="section-title toggle-section">
                            <span class="icon"><i class="fas fa-chevron-right"></i></span>
                            <span>Ressources</span>
                        </h2>
                        <div class="section-content is-hidden">
                            <?php if (empty($ressources)): ?>
                                <p>Aucune ressource disponible pour ce projet.</p>
                            <?php else: ?>
                                <table class="table is-striped is-hoverable is-fullwidth">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Type</th>
                                        <th>Lien</th>
                                        <th>Fichier</th>
                                        <th>Date d'ajout</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ressources as $ressource): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($ressource['titre']); ?></td>
                                            <td><?php echo htmlspecialchars($ressource['type']); ?></td>
                                            <td><a href="<?php echo htmlspecialchars($ressource['lien']); ?>" target="_blank"><?php echo htmlspecialchars($ressource['lien']); ?></a></td>
                                            <td>
                                                <?php if ($ressource['fichier']): ?>
                                                    <a href="<?php echo htmlspecialchars($ressource['fichier']); ?>" target="_blank"><?php echo htmlspecialchars(basename($ressource['fichier'])); ?></a>
                                                <?php else: ?>
                                                    Aucun fichier
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($ressource['date_creation']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card" data-section-content="rendus">
                    <div class="card-content">
                        <h2 class="section-title toggle-section">
                            <span class="icon"><i class="fas fa-chevron-right"></i></span>
                            <span>Rendus</span>
                        </h2>
                        <div class="section-content is-hidden">
                            <?php if (empty($rendus)): ?>
                                <p>Aucun rendu pour ce projet.</p>
                            <?php else: ?>
                                <table class="table is-striped is-hoverable is-fullwidth">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Date limite</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($rendus as $rendu): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($rendu['nom']); ?></td>
                                            <td><?php echo htmlspecialchars($rendu['description']); ?></td>
                                            <td><?php echo htmlspecialchars($rendu['date_limite']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card" data-section-content="soutenances">
                    <div class="card-content">
                        <h2 class="section-title toggle-section">
                            <span class="icon"><i class="fas fa-chevron-right"></i></span>
                            <span>Soutenances</span>
                        </h2>
                        <div class="section-content is-hidden">
                            <?php if (empty($soutenances)): ?>
                                <p>Aucune soutenance prévue pour ce projet.</p>
                            <?php else: ?>
                                <table class="table is-striped is-hoverable is-fullwidth">
                                    <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Date</th>
                                        <th>Groupe</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($soutenances as $soutenance): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($soutenance['titre']); ?></td>
                                            <td><?php echo htmlspecialchars($soutenance['date_soutenance']); ?></td>
                                            <td>
                                                <?php
                                                $groupe = array_filter($groupes, function($g) use ($soutenance) {
                                                    return $g['id_groupe'] == $soutenance['id_groupe'];
                                                });
                                                if (!empty($groupe)) {
                                                    echo htmlspecialchars(reset($groupe)['nom']);
                                                } else {
                                                    echo "Groupe non trouvé";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card" data-section-content="groupes">
                    <div class="card-content">
                        <h2 class="section-title toggle-section">
                            <span class="icon"><i class="fas fa-chevron-right"></i></span>
                            <span>Groupe</span>
                        </h2>
                        <div class="section-content is-hidden">
                            <?php
                            $groupeEtudiant = null;
                            foreach ($groupes as $groupe) {
                                $etudiantsGroupe = array_filter($etudiants, function($e) use ($groupe) {
                                    return $e['id_groupe'] == $groupe['id_groupe'];
                                });
                                $etudiantDansGroupe = array_filter($etudiantsGroupe, function($e) use ($etudiantConnecte) {
                                    return $e['id_etudiant'] == $etudiantConnecte['id_etudiant'];
                                });
                                if (!empty($etudiantDansGroupe)) {
                                    $groupeEtudiant = $groupe;
                                    break;
                                }
                            }

                            if ($groupeEtudiant): ?>
                                <div class="card">
                                    <div class="card-content">
                                        <h3 class="subtitle">Groupe : <?php echo htmlspecialchars($groupeEtudiant['nom']); ?></h3>
                                        <table class="table is-striped is-hoverable is-fullwidth">
                                            <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $etudiantsGroupe = array_filter($etudiants, function($e) use ($groupeEtudiant) {
                                                return $e['id_groupe'] == $groupeEtudiant['id_groupe'];
                                            });
                                            foreach ($etudiantsGroupe as $etudiant): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($etudiant['nom_etudiant']); ?></td>
                                                    <td><?php echo htmlspecialchars($etudiant['prenom_etudiant']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php else: ?>
                                <p>Vous n'êtes pas encore assigné à un groupe pour ce projet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card" data-section-content="notes">
                    <div class="card-content">
                        <h2 class="section-title toggle-section">
                            <span class="icon"><i class="fas fa-chevron-right"></i></span>
                            <span>Notes</span>
                        </h2>
                        <div class="section-content is-hidden">
                            <table class="table is-striped is-hoverable is-fullwidth">
                                <thead>
                                <tr>
                                    <th>Note</th>
                                    <th>Type</th>
                                    <th>Coef</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $notesEtudiant = array_filter($notes, function($n) use ($etudiantConnecte) {
                                    return $n['id_etudiant'] == $etudiantConnecte['id_etudiant'];
                                });
                                if (!empty($notesEtudiant)):
                                    foreach ($notesEtudiant as $note): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($note['note']); ?></td>
                                            <td><?php echo htmlspecialchars($note['type']); ?></td>
                                            <td><?php echo htmlspecialchars($note['coef']); ?></td>
                                        </tr>
                                    <?php endforeach;
                                else: ?>
                                    <tr>
                                        <td colspan="3">Aucune note disponible.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
                if ($navbarBurgers.length > 0) {
                    $navbarBurgers.forEach(el => {
                        el.addEventListener('click', () => {
                            const target = el.dataset.target;
                            const $target = document.getElementById(target);
                            el.classList.toggle('is-active');
                            $target.classList.toggle('is-active');
                        });
                    });
                }

                const navbarItems = Array.prototype.slice.call(document.querySelectorAll('.navbar-item'), 0);
                const sectionContents = Array.prototype.slice.call(document.querySelectorAll('[data-section-content]'), 0);

                navbarItems.forEach(item => {
                    item.addEventListener('click', () => {
                        navbarItems.forEach(i => i.classList.remove('is-active'));
                        sectionContents.forEach(s => s.classList.add('is-hidden'));

                        const section = item.dataset.section;
                        const sectionContent = document.querySelector(`[data-section-content="${section}"]`);

                        item.classList.add('is-active');
                        if (sectionContent) {
                            sectionContent.classList.remove('is-hidden');
                        }
                    });
                });

                const toggleSections = Array.prototype.slice.call(document.querySelectorAll('.toggle-section'), 0);
                toggleSections.forEach(section => {
                    section.addEventListener('click', () => {
                        section.classList.toggle('is-active');
                        const content = section.nextElementSibling;
                        content.classList.toggle('is-hidden');
                    });
                });

                const projetSectionContent = document.querySelector('[data-section-content="projet"]');
                if (projetSectionContent) {
                    projetSectionContent.classList.remove('is-hidden');
                }
            });
        </script>

        </body>
        </html>

        <?php
        afficherFooter();
    }

    public function afficherErreur($message) {
        ?>
        <div class="container">
            <div class="notification is-danger">
                <button class="delete"></button>
                <?php echo $message; ?>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                    const $notification = $delete.parentNode;

                    $delete.addEventListener('click', () => {
                        $notification.parentNode.removeChild($notification);
                    });
                });
            });
        </script>
        <?php
    }
}