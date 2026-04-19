<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=library', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie !<br><br>";
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

$sql = "SELECT * FROM livres WHERE YEAR(annee_publication) > :annee ORDER BY titre ASC";
$stmt = $pdo->prepare($sql);

$annee = 2000;
$stmt->execute(['annee' => $annee]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$result) {
    echo "Aucuns livres trouvé après l'année ", $annee;
} else {
    foreach ($result as $row) {
        echo $row['titre'] . " — " . $row['auteur'] . " (" . $row['annee_publication'] . ")<br>";
    }
}