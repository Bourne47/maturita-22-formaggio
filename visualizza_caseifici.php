<?php
include "./templates/header.php";
include "./templates/navbar.php";
require "./conf/dBconfig.php";

echo '<div class="container mt-5">';
echo '<h2 class="mb-4">Elenco dei Caseifici</h2>';


$stmt = $conn->prepare("SELECT * FROM caseifici");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $caseifici = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($caseifici as $caseificio) {
    
        $stmtImg = $conn->prepare("SELECT * FROM immagini WHERE id_c = ?");
        $stmtImg->bind_param("i", $caseificio["id"]);
        $stmtImg->execute();
        $imgResult = $stmtImg->get_result();
        $immagini = $imgResult->fetch_all(MYSQLI_ASSOC);
        $stmtImg->close();

        echo '<div class="row mb-5 border rounded p-3 shadow-sm">';

        echo '<div class="col-md-6">';
        if (!empty($immagini)) {
            $mainImg = array_shift($immagini);
            echo '<div class="mb-3 text-center">';
            echo '<img src="' . $mainImg["path"] . '" class="img-fluid rounded shadow" alt="' . $mainImg["desc"] . '">';
            echo '</div>';

            if (!empty($immagini)) {
                echo '<div class="d-flex flex-wrap gap-2 justify-content-center">';
                foreach ($immagini as $img) {
                    echo '<div>';
                    echo '<img src="' . $img["path"] . '" class="img-thumbnail" style="max-width: 150px;" alt="' . $img["desc"] . '">';
                    echo '</div>';
                }
                echo '</div>';
            }
        } else {
            echo '<p class="text-muted">Nessuna immagine disponibile.</p>';
        }
        echo '</div>';

        echo '<div class="col-md-6">';
        echo '<h4>' . htmlspecialchars($caseificio["nome"]) . '</h4>';
        echo '<p><strong>Indirizzo:</strong> ' . htmlspecialchars($caseificio["indirizzo"]) . '</p>';
        echo '<p><strong>Coordinate:</strong> ' . htmlspecialchars($caseificio["latit"]) . ', ' . htmlspecialchars($caseificio["long"]) . '</p>';
        echo '<p><strong>ID 4 cifre:</strong> ' . htmlspecialchars($caseificio["id_4_cifre"]) . '</p>';
        echo '</div>';

        echo '</div>';
    }
} else {
    echo '<p class="alert alert-info">Nessun caseificio presente nel database.</p>';
}

$conn->close();
echo '</div>';
?>
