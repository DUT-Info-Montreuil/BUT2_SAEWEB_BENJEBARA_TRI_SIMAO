<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'sae';
$username = 'root';
$password = 'chocolat';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupération des projets
try {
    $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, YEAR(a.debut_annee) AS annee 
FROM projet p
LEFT JOIN semestre s ON p.id_semestre = s.id_semestre
LEFT JOIN annee a ON p.id_annee = a.id_annee;";

    $stmt = $pdo->query($query);
    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erreur lors de la récupération des projets : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des projets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma/css/bulma.min.css">
</head>
<body>
<section class="section">
    <div class="container">
        <h1 class="title has-text-centered">Liste des projets</h1>

        <div class="level">
            <div class="level-left">
                <div class="level-item">
                    <a href="createNew.php" class="button is-primary">Nouveau Projet</a>
                </div>
            </div>
        </div>

        <?php if (empty($projets)): ?>
            <div class="notification is-warning">
                Aucun projet disponible.
            </div>
        <?php else: ?>
            <div class="table-container">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Semestre</th>
                            <th>Année</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projets as $projet): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($projet['id_projet']); ?></td>
                                <td><?php echo htmlspecialchars($projet['nom']); ?></td>
                                <td><?php echo htmlspecialchars($projet['description']); ?></td>
                                <td><?php echo htmlspecialchars($projet['semestre']); ?></td>
                                <td><?php echo htmlspecialchars($projet['annee']); ?></td>
                                <td>
                                    <div class="buttons are-small">
                                        <a href="view.php?id=<?php echo $projet['id_projet']; ?>" class="button is-info">Voir</a>
                                        <a href="edit.php?id=<?php echo $projet['id_projet']; ?>" class="button is-warning">Modifier</a>
                                        <a href="delete.php?id=<?php echo $projet['id_projet']; ?>" class="button is-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce projet ?');">Supprimer</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>
</body>
</html>
