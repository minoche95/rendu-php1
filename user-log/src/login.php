<?php
session_start();

try {
    $pdo = new PDO('mysql:host=localhost;port=8889;dbname=exercice_login;charset=utf8mb4', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur lors de la connexion a la BDD : " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $request = $pdo->prepare("SELECT id, mot_de_passe FROM utilisateurs WHERE email = :email");
        $request->execute([
            'email' => $email
        ]);

        $user = $request->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            header('Location: index.php');
            exit;
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page de connexion</title>
</head>
<body>
<header>
    <h1>Se connecter</h1>
</header>

<main>
    <form action="login.php" method="POST">
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
