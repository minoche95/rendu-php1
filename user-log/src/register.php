<?php
try {
    $pdo = new PDO('mysql:host=localhost;port=8889;dbname=exercice_login', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur lors de la connexion a la BDD : " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $request = $pdo->prepare("INSERT INTO utilisateurs (email, mot_de_passe) VALUES (:email, :mot_de_passe)");
        $request->execute([
            'email' => $email,
            'mot_de_passe' => $hashedPassword
        ]);

        echo 'Inscription réussie';
    } else {
        echo 'Veuillez renseigner tous les champs';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
</head>
<body>
<header>
    <h1>S'inscrire</h1>
</header>

<main>
    <form action="register.php" method="POST">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Connexion</button>
    </form>

    <a href="index.php">Accueil</a>
</main>
</body>
</html>

