<?php

$host = "127.0.0.1";
$dbname = "";
$username = "";
$password = "";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);

    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$nom = htmlspecialchars($data['nom']);
$prenom = htmlspecialchars($data['prenom']);
$email = htmlspecialchars($data['email']);
$telephone = htmlspecialchars($data['telephone']);
$message = htmlspecialchars($data['message']);

$sql = "INSERT INTO contacts
(nom, prenom, email, telephone, message)
VALUES
(:nom, :prenom, :email, :telephone, :message)";

$stmt = $pdo->prepare($sql);

$success = $stmt->execute([

    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':telephone' => $telephone,
    ':message' => $message

]);

echo json_encode([
    "success" => $success,
    "message" => $success
        ? "Message envoyé avec succès"
        : "Erreur lors de l'envoi"
]);