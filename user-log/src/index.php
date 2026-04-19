<?php
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HomePage</title>
</head>
<body>
<header>
    <h1>Page d'accueil</h1>
</header>

<main>
    <?php
    if (isset($_SESSION['user_id'])) {
        // Utilisation de 'htmlspecialchars' (pas encore vu en cours qui est un equivalent du echo) permettant d'éviter l'injection de code (transformation en texte brut)
        echo "<p>Connecté en tant que l'utilisateur ID: <strong>" . htmlspecialchars($_SESSION['user_id']) . "</strong></p>";
        echo '<form action="logout.php" method="POST">
                <button type="submit">Se déconnecter</button>
              </form>';
    } else {
        echo '<a href="login.php">Connexion</a><br><br>';
        echo '<a href="register.php">Inscription</a>';
    }
    ?>
</main>
</body>
</html>