<?php
include_once 'phpUtils/connectDB.php';
include_once 'phpUtils/fct.php';

if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mangattack</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/summary.css">
</head>

<body>
    <!-- Header -->
    <?php
    include_once 'phpUtils/header.php';
    ?>

    <!-- Main -->
    <main>
        <section id="summary">
            <h2 class="title-section">Recapitulatif de votre commande</h2>
            <div id="summaryContent">
                <div id="summaryHeader">
                    <?php
                    $resultIdSummary = $conn->prepare("SELECT id FROM summary WHERE mail_user = '" . $_SESSION['identifier'] . "' ORDER BY id DESC LIMIT 1");
                    $resultIdSummary->execute();
                    $idSummary = $resultIdSummary->fetch(PDO::FETCH_NUM)[0];

                    echo '<h3>Commande n°' . $idSummary . '</h3>
                    <h3>MangAttack SARL</h3>
                    <h3>1 Rue de la Paix</h3>
                    <h3>75008 Paris</h3>
                    <h3>Tel.01.23.45.67.89</h3>
                    </br>';
                    ?>
                </div>
                <div id="items">
                    <?php
                    $resultSummaryVolume = $conn->prepare("SELECT * FROM summary_volume WHERE id_summary = " . $idSummary);
                    $resultSummaryVolume->execute();

                    echo '<div class="summary-item">
                            <p>Quantité</p>
                            <p>Produit</p>
                            <p>PU</p>
                            <p>PT</p>
                        </div><br>';

                    while ($row = $resultSummaryVolume->fetch(PDO::FETCH_NUM)) {
                        $id_volume = $row[1];
                        $quantity = $row[2];

                        $resultVolume = $conn->prepare("SELECT * FROM volume WHERE id = " . $id_volume);
                        $resultVolume->execute();
                        $resultVolume = $resultVolume->fetch(PDO::FETCH_NUM);

                        $resultManga = $conn->prepare("SELECT * FROM manga WHERE id = " . $resultVolume[2]);
                        $resultManga->execute();
                        $resultManga = $resultManga->fetch(PDO::FETCH_NUM);

                        $unitPrice = $resultVolume[4];
                        $price = $unitPrice * $quantity;
                        $name = $resultManga[1] . ' - Tome ' . $resultVolume[1];

                        echo '<div class="summary-item">
                            <p>' . $quantity . '</p>
                            <p>' . $name . '</p>
                            <p>' . $unitPrice . '€</p>
                            <p>' . $price . '€</p>
                        </div><br>';
                    }
                    ?>
                </div>
                <div id="totalPrice">
                    <?php
                    $resultSummary = $conn->prepare("SELECT * FROM summary WHERE mail_user = '" . $_SESSION['identifier'] . "' ORDER BY id DESC LIMIT 1");
                    $resultSummary->execute();
                    $resultSummary = $resultSummary->fetch(PDO::FETCH_NUM);

                    echo '<p>Sous Total : ' . $resultSummary[3] . '€</p>';
                    echo '<p>TVA 5.00%</p>';
                    echo '<div class="separator"></div>';
                    echo '<p>Total TTC : ' . $resultSummary[3] + (0.05 * $resultSummary[3]) . '€</p>';


                    ?>
                </div>
                <div id="date">
                    <?php
                    echo '<p>Date : ' . $resultSummary[2] . '</p>';
                    ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>
</body>

</html>