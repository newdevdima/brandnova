<?php

$pdo = new PDO(
    "mysql:host=localhost;dbname=brandnova;charset=utf8",
    "root",
    ""
);

$messages = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC");

?>

    <h1>Messages reçus</h1>

<?php foreach($messages as $message): ?>

    <div style="border:1px solid #ccc;padding:20px;margin-bottom:20px;">

        <h3>
            <?= $message['nom']; ?>
            <?= $message['prenom']; ?>
        </h3>

        <p>
            <?= $message['email']; ?>
        </p>

        <p>
            <?= $message['telephone']; ?>
        </p>

        <p>
            <?= $message['message']; ?>
        </p>

        <small>
            <?= $message['created_at']; ?>
        </small>

    </div>

<?php endforeach; ?>