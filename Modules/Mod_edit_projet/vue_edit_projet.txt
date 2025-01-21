<?php

require_once 'header.php';
require_once 'footer.php';

class VueEditProjet {

    public function __construct() {}

    public function afficherFormulaireEdition($projet, $ressources, $rendus, $soutenances,$groupes) {
afficherHeader("Liste des projets");

        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modifier le projet</title>
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
            </style>
        </head>
        <body>

        <div class="container">
            <h1 class="title">Modifier le projet : <?php echo htmlspecialchars($projet['nom']); ?></h1>

            <!-- Formulaire de modification du projet -->
            <div class="card">
                <div class="card-content">
                    <form action="" method="post">
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
                                <button class="button is-primary" type="submit">Enregistrer les modifications</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Gestion des ressources -->
            <div class="card">
                <div class="card-content">
                    <h2 class="subtitle">Ressources</h2>
                    <?php if (empty($ressources)): ?>
                        <p>Aucune ressource disponible pour ce projet.</p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($ressources as $ressource): ?>
                                <li>
                                    <?php echo htmlspecialchars($ressource['titre']); ?>
                                    (<a href="<?php echo htmlspecialchars($ressource['lien']); ?>" target="_blank">Lien</a>)
                                    - Type: <?php echo htmlspecialchars($ressource['type']); ?>
                                    - Ajouté le: <?php echo htmlspecialchars($ressource['date_creation']); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <!-- Formulaire d'ajout de ressource -->
                    <h3 class="subtitle">Ajouter une ressource</h3>
                    <form action="" method="post">
                        <input type="hidden" name="action" value="add_ressource">
                        <div class="field">
                            <label class="label">Titre</label>
                            <div class="control">
                                <input class="input" type="text" name="titre" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Type</label>
                            <div class="control">
                                <input class="input" type="text" name="type" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Lien</label>
                            <div class="control">
                                <input class="input" type="url" name="lien" required>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button class="button is-primary" type="submit">Ajouter une ressource</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Gestion des rendus -->
            <div class="card">
              <div class="card-content">
                <h2 class="subtitle">Rendus</h2>
                <?php if (empty($rendus)): ?>
                  <p>Aucun rendu pour ce projet.</p>
                <?php else: ?>
                  <ul>
                    <?php foreach ($rendus as $rendu): ?>
                      <li>
                        <strong><?php echo htmlspecialchars($rendu['nom']); ?></strong><br>
                        Description: <?php echo htmlspecialchars($rendu['description']); ?><br>
                        Date limite: <?php echo htmlspecialchars($rendu['date_limite']); ?>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>

                <!-- Formulaire d'ajout de rendu -->
                <h3 class="subtitle">Ajouter un rendu</h3>
                <form action="" method="post">
                  <input type="hidden" name="action" value="add_rendu">
                  <div class="field">
                    <label class="label">Nom du rendu</label>
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
                    <label class="label">Date limite</label>
                    <div class="control">
                      <input class="input" type="date" name="date_limite" required>
                    </div>
                  </div>
                  <div class="field">
                    <div class="control">
                      <button class="button is-primary" type="submit">Ajouter un rendu</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- Gestion des soutenances -->
            <div class="card">
              <div class="card-content">
                <h2 class="subtitle">Soutenances</h2>
                <?php if (empty($soutenances)): ?>
                  <p>Aucune soutenance prévue pour ce projet.</p>
                <?php else: ?>
                  <ul>
                    <?php foreach ($soutenances as $soutenance): ?>
                      <li>
                        <strong><?php echo htmlspecialchars($soutenance['titre']); ?></strong><br>
                        Date: <?php echo htmlspecialchars($soutenance['date_soutenance']); ?><br>
                        Groupe: <?php 
                                  $groupe = array_filter($groupes, function($g) use ($soutenance) {
                                      return $g['id_groupe'] == $soutenance['id_groupe'];
                                  });
                                  if (!empty($groupe)) {
                                      echo htmlspecialchars(reset($groupe)['nom']);
                                  } else {
                                      echo "Groupe non trouvé";
                                  }
                              ?><br>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>

                <!-- Formulaire d'ajout de soutenance -->
                <h3 class="subtitle">Ajouter une soutenance</h3>
                <form action="" method="post">
                  <input type="hidden" name="action" value="add_soutenance">
                  <div class="field">
                    <label class="label">Titre</label>
                    <div class="control">
                      <input class="input" type="text" name="titre" required>
                    </div>
                  </div>
                  <div class="field">
                    <label class="label">Date de soutenance</label>
                    <div class="control">
                      <input class="input" type="date" name="date_soutenance" required>
                    </div>
                  </div>
                  <div class="field">
                    <label class="label">Groupe</label>
                    <div class="control">
                      <div class="select">
                        <select name="id_groupe">
                          <?php foreach ($groupes as $groupe): ?>
                            <option value="<?php echo $groupe['id_groupe']; ?>"><?php echo htmlspecialchars($groupe['nom']); ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="field">
                    <div class="control">
                      <button class="button is-primary" type="submit">Ajouter une soutenance</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
        </body>
        </html>

        <?php
        afficherFooter();
    }

    public function afficherErreur($message) {
        ?>
        <div class="container">
            <div class="notification is-danger">
                <?php echo $message; ?>
            </div>
        </div>
        <?php
    }
}