<?php

require_once 'header.php';
require_once 'footer.php';

class VueEditProjet {

    public function __construct() {}

    public function afficherFormulaireEdition($projet, $ressources, $rendus, $soutenances, $groupes, $etudiants, $notes) {
        afficherHeader("Liste des projets");
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modifier le projet</title>
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
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ombre légère */
                    border-radius: 6px; /* Bords arrondis */
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
                .input, .textarea, .select {
                    border-radius: 4px;
                }
                .button.is-primary {
                    background-color: #3273dc;
                    border-color: transparent;
                }
                .button.is-primary:hover {
                    background-color: #276cda;
                    border-color: transparent;
                }
                .button.is-danger {
                    background-color: #f14668;
                    border-color: transparent;
                }
                .button.is-danger:hover {
                    background-color: #dc2f59;
                    border-color: transparent;
                }
                .notification {
                    border-radius: 4px;
                }
                .modal-card-head, .modal-card-foot {
                    background-color: #f5f5f5;
                    border-radius: 6px 6px 0 0;
                }
                .modal-card-body {
                    border-radius: 0 0 6px 6px;
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
            <div class="navbar-brand">
                <a class="navbar-item" href="#">
                    <span class="icon"><i class="fas fa-tasks"></i></span>
                    <span>Gestion de Projets</span>
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
                        <span>Groupes</span>
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
                <h1 class="title">Modifier le projet : <?php echo htmlspecialchars($projet['nom']); ?></h1>

                <div class="card" data-section-content="projet">
                    <div class="card-content">
                        <h2 class="section-title toggle-section is-active">
                            <span class="icon"><i class="fas fa-chevron-right"></i></span>
                            <span>Informations du projet</span>
                        </h2>
                        <form action="" method="post" class="section-content">
                            <input type="hidden" name="action" value="update_projet">
                            <div class="field">
                                <label class="label">Nom du projet</label>
                                <div class="control">
                                    <input class="input" type="text" name="nom" value="<?php echo htmlspecialchars($projet['nom']); ?>" required>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Description</label>
                                <div class="control">
                                    <textarea class="textarea" name="description" required><?php echo htmlspecialchars($projet['description']); ?></textarea>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button class="button is-primary" type="submit">
                                        <span class="icon"><i class="fas fa-save"></i></span>
                                        <span>Enregistrer les modifications</span>
                                    </button>
                                </div>
                            </div>
                        </form>
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
                                            <th>Date d'ajout</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ressources as $ressource): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($ressource['titre']); ?></td>
                                                <td><?php echo htmlspecialchars($ressource['type']); ?></td>
                                                <td><a href="<?php echo htmlspecialchars($ressource['lien']); ?>" target="_blank"><?php echo htmlspecialchars($ressource['lien']); ?></a></td>
                                                <td><?php echo htmlspecialchars($ressource['date_creation']); ?></td>
                                                <td>
                                                    <button class="button is-small is-danger" onclick="openDeleteModal('ressource', <?php echo $ressource['id_ressource']; ?>)">
                                                        <span class="icon"><i class="fas fa-trash"></i></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>

                            <h3 class="subtitle">Ajouter une ressource</h3>
                            <form action="" method="post">
                                <input type="hidden" name="action" value="add_ressource">
                                <div class="field">
                                    <label class="label">Titre</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" name="titre" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-heading"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Type</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" name="type" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Lien</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="url" name="lien" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-link"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-primary" type="submit">
                                            <span class="icon"><i class="fas fa-plus"></i></span>
                                            <span>Ajouter une ressource</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rendus as $rendu): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($rendu['nom']); ?></td>
                                                <td><?php echo htmlspecialchars($rendu['description']); ?></td>
                                                <td><?php echo htmlspecialchars($rendu['date_limite']); ?></td>
                                                <td>
                                                    <button class="button is-small is-danger" onclick="openDeleteModal('rendu', <?php echo $rendu['id_rendu']; ?>)">
                                                        <span class="icon"><i class="fas fa-trash"></i></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>

                            <h3 class="subtitle">Ajouter un rendu</h3>
                            <form action="" method="post">
                                <input type="hidden" name="action" value="add_rendu">
                                <div class="field">
                                    <label class="label">Nom du rendu</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" name="nom" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-file-signature"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Description</label>
                                    <div class="control">
                                        <textarea class="textarea" name="description" required></textarea>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Date limite</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="date" name="date_limite" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-primary" type="submit">
                                            <span class="icon"><i class="fas fa-plus"></i></span>
                                            <span>Ajouter un rendu</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
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
                                            <th>Actions</th>
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
                                                <td>
                                                    <button class="button is-small is-danger" onclick="openDeleteModal('soutenance', <?php echo $soutenance['id_soutenance']; ?>)">
                                                        <span class="icon"><i class="fas fa-trash"></i></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>

                            <h3 class="subtitle">Ajouter une soutenance</h3>
                            <form action="" method="post">
                                <input type="hidden" name="action" value="add_soutenance">
                                <div class="field">
                                    <label class="label">Titre</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" name="titre" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-microphone-alt"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Date de soutenance</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="date" name="date_soutenance" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-calendar-day"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Groupe</label>
                                    <div class="control has-icons-left">
                                        <div class="select">
                                            <select name="id_groupe">
                                                <?php foreach ($groupes as $groupe): ?>
                                                    <option value="<?php echo $groupe['id_groupe']; ?>"><?php echo htmlspecialchars($groupe['nom']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-user-friends"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-primary" type="submit">
                                            <span class="icon"><i class="fas fa-plus"></i></span>
                                            <span>Ajouter une soutenance</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card" data-section-content="groupes">
                    <div class="card-content">
                        <h2 class="section-title toggle-section">
                            <span class="icon"><i class="fas fa-chevron-right"></i></span>
                            <span>Gestion des Groupes et Étudiants</span>
                        </h2>
                        <div class="section-content is-hidden">
                            <?php foreach ($groupes as $groupe): ?>
                                <div class="card">
                                    <div class="card-content">
                                        <h3 class="subtitle">Groupe : <?php echo htmlspecialchars($groupe['nom']); ?></h3>
                                        <table class="table is-striped is-hoverable is-fullwidth">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Prénom</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $etudiants_du_groupe = array_filter($etudiants, function($e) use ($groupe) {
                                                    return $e['id_groupe'] == $groupe['id_groupe'];
                                                });
                                                foreach ($etudiants_du_groupe as $etudiant): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($etudiant['nom_etudiant']); ?></td>
                                                        <td><?php echo htmlspecialchars($etudiant['prenom_etudiant']); ?></td>
                                                        <td>
                                                            <form action="" method="post" style="display: inline;">
                                                                <input type="hidden" name="action" value="remove_student_from_group">
                                                                <input type="hidden" name="id_etudiant" value="<?php echo $etudiant['id_etudiant']; ?>">
                                                                <input type="hidden" name="id_groupe" value="<?php echo $groupe['id_groupe']; ?>">
                                                                <button class="button is-small is-danger" type="submit">
                                                                    <span class="icon"><i class="fas fa-user-times"></i></span>
                                                                    <span>Retirer</span>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                        <h4 class="subtitle">Ajouter un étudiant au groupe</h4>
                                        <form action="" method="post">
                                            <input type="hidden" name="action" value="add_student_to_group">
                                            <input type="hidden" name="id_groupe" value="<?php echo $groupe['id_groupe']; ?>">
                                            <div class="field">
                                                <label class="label">Étudiant</label>
                                                <div class="control has-icons-left">
                                                    <div class="select">
                                                        <select name="id_etudiant">
                                                            <?php foreach ($etudiants as $etudiant):
                                                                if (empty($etudiant['id_groupe'])): ?>
                                                                    <option value="<?php echo $etudiant['id_etudiant']; ?>"><?php echo htmlspecialchars($etudiant['nom_etudiant'] . ' ' . $etudiant['prenom_etudiant']); ?></option>
                                                                <?php endif;
                                                            endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <span class="icon is-small is-left">
                                                        <i class="fas fa-user-plus"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="control">
                                                    <button class="button is-primary" type="submit">
                                                        <span class="icon"><i class="fas fa-user-check"></i></span>
                                                        <span>Ajouter</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="card">
                                <div class="card-content">
                                    <h3 class="subtitle">Créer un nouveau groupe</h3>
                                    <form action="" method="post">
                                        <input type="hidden" name="action" value="create_group">
                                        <input type="hidden" name="id_projet" value="<?php echo $projet['id_projet']; ?>">
                                        <div class="field">
                                            <label class="label">Nom du groupe</label>
                                            <div class="control has-icons-left">
                                                <input class="input" type="text" name="nom_groupe" required>
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-users"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="control">
                                                <button class="button is-primary" type="submit">
                                                    <span class="icon"><i class="fas fa-plus"></i></span>
                                                    <span>Créer</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" data-section-content="notes">
                    <div class="card-content">
                        <h2 class="section-title toggle-section">
                            <span class="icon"><i class="fas fa-chevron-right"></i></span>
                            <span>Gestion des Notes</span>
                        </h2>
                        <div class="section-content is-hidden">
                            <?php foreach ($etudiants as $etudiant): ?>
                                <div class="card">
                                    <div class="card-content">
                                        <h3 class="subtitle">Étudiant : <?php echo htmlspecialchars($etudiant['nom_etudiant'] . ' ' . $etudiant['prenom_etudiant']); ?></h3>
                                        <table class="table is-striped is-hoverable is-fullwidth">
                                            <thead>
                                                <tr>
                                                    <th>Note</th>
                                                    <th>Type</th>
                                                    <th>Coef</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $notes_etudiant = array_filter($notes, function($n) use ($etudiant) {
                                                    return isset($n['id_etudiant']) && $n['id_etudiant'] == $etudiant['id_etudiant'];
                                                });
                                                if (!empty($notes_etudiant)) {
                                                    foreach ($notes_etudiant as $note): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($note['note']); ?></td>
                                                            <td><?php echo htmlspecialchars($note['type']); ?></td>
                                                            <td><?php echo htmlspecialchars($note['coef']); ?></td>
                                                            <td>
                                                                <form action="" method="post" style="display: inline;">
                                                                    <input type="hidden" name="action" value="edit_grade">
                                                                    <input type="hidden" name="id_note" value="<?php echo htmlspecialchars($note['id_note']); ?>">
                                                                    <input class="input is-small" type="number" name="new_grade" value="<?php echo htmlspecialchars($note['note']); ?>" required>
                                                                    <button class="button is-small is-warning" type="submit">
                                                                        <span class="icon"><i class="fas fa-edit"></i></span>
                                                                    </button>
                                                                </form>
                                                                <form action="" method="post" style="display: inline;">
                                                                    <input type="hidden" name="action" value="delete_grade">
                                                                    <input type="hidden" name="id_note" value="<?php echo htmlspecialchars($note['id_note']); ?>">
                                                                    <button class="button is-small is-danger" type="submit">
                                                                        <span class="icon"><i class="fas fa-trash"></i></span>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;
                                                } else {
                                                    echo "<tr><td colspan='4'>Aucune note pour cet étudiant.</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <form action="" method="post">
                                            <input type="hidden" name="action" value="add_grade">
                                            <input type="hidden" name="id_etudiant" value="<?php echo $etudiant['id_etudiant']; ?>">
                                            <input type="hidden" name="id_groupe" value="<?php echo $etudiant['id_groupe']; ?>">
                                            <div class="field">
                                                <label class="label">Note</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="number" step="0.01" name="note" required>
                                                    <span class="icon is-small is-left">
                                                        <i class="fas fa-clipboard-list"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Type d'évaluation</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name="type_evaluation" required>
                                                    <span class="icon is-small is-left">
                                                        <i class="fas fa-clipboard-check"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Coefficient</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="number" step="0.01" name="coef" required>
                                                    <span class="icon is-small is-left">
                                                        <i class="fas fa-weight"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="control">
                                                    <button class="button is-primary" type="submit">
                                                        <span class="icon"><i class="fas fa-plus"></i></span>
                                                        <span>Ajouter Note</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal" id="deleteModal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Confirmation de suppression</p>
                    <button class="delete" aria-label="close" onclick="closeDeleteModal()"></button>
                </header>
                <section class="modal-card-body">
                    Êtes-vous sûr de vouloir supprimer <span id="deleteItemType"></span> <span id="deleteItemId"></span> ?
                </section>
                <footer class="modal-card-foot">
                    <form action="" method="post" id="deleteForm">
                        <input type="hidden" name="action" id="deleteAction" value="">
                        <input type="hidden" name="id" id="deleteId" value="">
                        <button class="button is-danger" type="submit">
                            <span class="icon"><i class="fas fa-trash"></i></span>
                            <span>Supprimer</span>
                        </button>
                        <button class="button" type="button" onclick="closeDeleteModal()">Annuler</button>
                    </form>
                </footer>
            </div>
        </div>

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

            function openDeleteModal(type, id) {
                document.getElementById('deleteItemType').textContent = type;
                document.getElementById('deleteItemId').textContent = id;
                document.getElementById('deleteAction').value = `delete_${type}`;
                document.getElementById('deleteId').value = id;
                document.getElementById('deleteModal').classList.add('is-active');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.remove('is-active');
            }

            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
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