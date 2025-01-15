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

// Form submission handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $id_semestre = $_POST['id_semestre'];
    $id_annee = $_POST['id_annee'];

    try {
        // id_projet is removed as it is now auto-incrementing
        $query = "INSERT INTO projet (nom, description, id_semestre, id_annee) VALUES (:nom, :description, :id_semestre, :id_annee)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id_semestre', $id_semestre);
        $stmt->bindParam(':id_annee', $id_annee);
        $stmt->execute();

        // Redirect to index.php after successful insertion
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        die("Erreur lors de la création du projet : " . $e->getMessage());
    }
}

// Fetch semesters for the dropdown
try {
    $querySemestres = "SELECT id_semestre, type FROM semestre";
    $stmtSemestres = $pdo->query($querySemestres);
    $semestres = $stmtSemestres->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erreur lors de la récupération des semestres : " . $e->getMessage());
}

// Fetch years for the dropdown
try {
    $queryAnnees = "SELECT id_annee, CONCAT(YEAR(debut_annee), '-', YEAR(debut_annee) + 1) AS annee FROM annee";
    $stmtAnnees = $pdo->query($queryAnnees);
    $annees = $stmtAnnees->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erreur lors de la récupération des années : " . $e->getMessage());
}
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

            <form action="createNew.php" method="post">
                <div class="field">
                    <label class="label">Nom</label>
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
                            <select name="id_semestre" required>
                                <?php foreach ($semestres as $semestre): ?>
                                    <option value="<?php echo $semestre['id_semestre']; ?>"><?php echo htmlspecialchars($semestre['type']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Année</label>
                    <div class="control">
                        <div class="select">
                            <select name="id_annee" required>
                                <?php foreach ($annees as $annee): ?>
                                    <option value="<?php echo $annee['id_annee']; ?>"><?php echo htmlspecialchars($annee['annee']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary">Créer</button>
                    </div>
                    <div class="control">
                        <a href="projets.php" class="button is-light">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
</html>