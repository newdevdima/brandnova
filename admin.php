
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

$sql = "SELECT * FROM contacts ORDER BY id DESC";

$stmt = $pdo->query($sql);

$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Messages reçus</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 40px;
        }

        h1{
            margin-bottom: 30px;
        }

        .card{
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .label{
            font-weight: bold;
        }

        .message{
            margin-top: 10px;
            padding: 15px;
            background: #f7f7f7;
            border-radius: 8px;
            white-space: pre-wrap;
        }

        .date{
            margin-top: 15px;
            color: gray;
            font-size: 14px;
        }

    </style>

</head>

<body>

    <h1>
        Messages reçus
    </h1>

    <?php if(count($contacts) > 0): ?>

        <?php foreach($contacts as $contact): ?>

            <div class="card">

                <p>
                    <span class="label">Nom :</span>
                    <?= htmlspecialchars($contact['nom']) ?>
                </p>

                <p>
                    <span class="label">Prénom :</span>
                    <?= htmlspecialchars($contact['prenom']) ?>
                </p>

                <p>
                    <span class="label">Email :</span>
                    <?= htmlspecialchars($contact['email']) ?>
                </p>

                <p>
                    <span class="label">Téléphone :</span>
                    <?= htmlspecialchars($contact['telephone']) ?>
                </p>

                <div class="message">

                    <?= htmlspecialchars($contact['message']) ?>

                </div>

                <?php if(isset($contact['created_at'])): ?>

                    <div class="date">

                        Envoyé le :
                        <?= $contact['created_at'] ?>

                    </div>

                <?php endif; ?>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <p>
            Aucun message trouvé.
        </p>

    <?php endif; ?>

</body>

</html>
