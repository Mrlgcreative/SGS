
<?php
// Inclure le fichier de configuration pour la connexion à la base de données


// Récupérer les informations de l'élève et du paiement via les variables GET ou POST
$eleve_id = $_GET['eleve_id'] ?? null;
$paiement_id = $_GET['paiement_id'] ?? null;

// Vérifier que les informations nécessaires sont présentes
if (!$eleve_id || !$paiement_id) {
    die("ID de l'élève ou du paiement manquant.");
}

// Récupérer les informations de l'élève
$stmt = $mysqli->prepare("SELECT * FROM eleves WHERE id = ?");
$stmt->bind_param("i", $eleve_id);
$stmt->execute();
$eleve = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Récupérer les informations de paiement
$stmt = $mysqli->prepare("SELECT * FROM paiements WHERE id = ?");
$stmt->bind_param("i", $paiement_id);
$stmt->execute();
$paiement = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$eleve || !$paiement) {
    die("Informations de l'élève ou du paiement introuvables.");
}

// Définir l'option s'il s'agit d'un élève du secondaire
$option = ($eleve['section'] === 'secondaire' && $eleve['classe'] !== '7ème' && $eleve['classe'] !== '8ème') ? $eleve['option'] : null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f3f3;
        }
        .receipt-container {
            width: 40rem;
            height: 40rem;
            border: 1px solid #000;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            position: relative;
        }
        .header {
            display: flex;
            justify-content: space-between;
        }
        .header .school-name {
            font-size: 12px;
            font-weight: bold;
        }
        .header .receipt-number {
            font-size: 12px;
        }
        .details {
            margin-top: 10px;
            font-size: 10px;
        }
        .details p {
            margin: 2px 0;
        }
        .footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
        }
        .footer button {
            padding: 5px 10px;
            font-size: 10px;
            cursor: pointer;
        }
    </style>
    <script>
        function printReceipt() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="receipt-container">
        <!-- Header -->
        <div class="header">
            <div class="school-name">École Saint Sophie</div>
            <div class="receipt-number">Reçu #<?php echo $paiement_id; ?></div>
        </div>

        <!-- Détails -->
        <div class="details">
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($eleve['nom']); ?></p>
            <p><strong>Post-nom :</strong> <?php echo htmlspecialchars($eleve['post_nom']); ?></p>
            <p><strong>Prénom :</strong> <?php echo htmlspecialchars($eleve['prenom']); ?></p>
            <p><strong>Section :</strong> <?php echo htmlspecialchars($eleve['section']); ?></p>
            <p><strong>Classe :</strong> <?php echo htmlspecialchars($eleve['classe']); ?></p>
            <?php if ($option): ?>
                <p><strong>Option :</strong> <?php echo htmlspecialchars($option); ?></p>
            <?php endif; ?>
            <p><strong>Motif :</strong> <?php echo htmlspecialchars($paiement['motif']); ?></p>
            <p><strong>Montant :</strong> <?php echo htmlspecialchars($paiement['amount_paid']); ?> $</p>
</div>
<!-- Bouton imprimer -->
<div class="footer">
            <button onclick="printReceipt()">Imprimer</button>
        </div>
    </div>
</body>
</html>
