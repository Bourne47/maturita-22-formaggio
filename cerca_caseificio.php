<?php
include "./templates/header.php";
include "./templates/navbar.php";
require "./conf/dBconfig.php";

echo '<div class="container mt-5">';
echo '<form method="POST" action="./cerca_caseificio.php" class="mb-4">';
echo '  <div class="mb-3">';
echo '    <label for="nome" class="form-label">Nome del caseificio:</label>';
echo '    <input type="text" id="nome" name="nome" class="form-control" required>';
echo '  </div>';
echo '  <input type="submit" value="Cerca" class="btn btn-success">';
echo '</form>';

if (isset($_POST["nome"])) {
   
    $stmt = $conn->prepare("SELECT * FROM caseifici WHERE nome = ?");
    $stmt->bind_param("s", $_POST["nome"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $caseificio = $result->fetch_assoc();
    $stmt->close();

    if ($caseificio) {
        
        $stmtImg = $conn->prepare("SELECT * FROM immagini WHERE id_c = ?");
        $stmtImg->bind_param("i", $caseificio["id"]);
        $stmtImg->execute();
        $imagesResult = $stmtImg->get_result();
        $immagini = $imagesResult->fetch_all(MYSQLI_ASSOC);
        $stmtImg->close();
        $conn->close();

        echo '<div class="row">';

        
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
        echo '<h3>' . htmlspecialchars($caseificio["nome"]) . '</h3>';
        echo '<p><strong>Indirizzo:</strong> ' . htmlspecialchars($caseificio["indirizzo"]) . '</p>';
        echo '<p><strong>Coordinate:</strong> ' . htmlspecialchars($caseificio["latit"]) . ', ' . htmlspecialchars($caseificio["long"]) . '</p>';
        echo '<p><strong>ID 4 cifre:</strong> ' . htmlspecialchars($caseificio["id_4_cifre"]) . '</p>';
        echo '</div>';

        echo '</div>'; 
    } else {
        echo '<p class="alert alert-warning">Nessun caseificio trovato con quel nome.</p>';
    }
}

echo '</div>';
?>
