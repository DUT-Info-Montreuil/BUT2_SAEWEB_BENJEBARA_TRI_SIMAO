<?php
// Database connection details
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

// Get project ID from the query string
$id_projet = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch project details
try {
    $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, CONCAT(YEAR(a.debut_annee), '-', YEAR(a.debut_annee) + 1) AS annee
              FROM projet p
              LEFT JOIN semestre s ON p.id_semestre = s.id_semestre
              LEFT JOIN annee a ON p.id_annee = a.id_annee
              WHERE p.id_projet = :id_projet";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
    $stmt->execute();
    $projet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$projet) {
        die("Projet non trouvé.");
    }
} catch (Exception $e) {
    die("Erreur lors de la récupération du projet : " . $e->getMessage());
}
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
                    <a href="projets.php" class="card-footer-item">Retour à la liste</a>
                    <a href="edit.php?id=<?php echo $projet['id_projet']; ?>" class="card-footer-item">Modifier le projet</a>
                </footer>
            </div>
        </div>
    </section>
</body>
</html>