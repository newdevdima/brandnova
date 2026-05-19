<?php

$host = "127.0.0.1";
$dbname = "u574796069_BRANDNOVA";
$username = "u574796069_brandnova";
$password = "BrandNova@2026227";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){

    die("Erreur connexion : " . $e->getMessage());

}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $message = htmlspecialchars($_POST['message']);

    $sql = "INSERT INTO contacts
            (nom, prenom, email, telephone, message)
            VALUES
            (:nom, :prenom, :email, :telephone, :message)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([

        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':telephone' => $telephone,
        ':message' => $message

    ]);

    echo "Message enregistré avec succès.";

}
?>