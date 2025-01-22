<?php
function afficherHeader($titre = "SAE Manager") {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre; ?></title>
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
        }
        .table, .table td, .table th {
             color: black!important;
        }
    </style>
</head>
<body>
    <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php?module=deconnexion" style="font-weight: bold; color: white;">Déconnexion</a>
            <a class="navbar-item" href="index.php?module=projets" style="font-weight: bold; color: white;">Liste des projets</a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
    </nav>
<?php
}
?>