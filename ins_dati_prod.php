<?php
session_start();
include './config/db_config.php';

if (!isset($_SESSION['login']))
   header("location: ../index.php");

$id_c = $_SESSION['id_c'];

$stmt = $conn->prepare("SELECT * FROM caseifici WHERE id_c = ?");
$stmt->bind_param("s", $id_c); 
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$nome_caseificio = $row["nome"];

if (isset($_POST['submit_dati_latte'])) {
    $data = $_POST['data'];
    $qt_lav = $_POST['qt_lav'];
    $qt_prod = $_POST['qt_prod'];

    $stmt = $conn->prepare("INSERT INTO dati_latte (data, qt_lav, qt_prod, id_c) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdds", $data, $qt_lav, $qt_prod, $id_c);
    $stmt->execute();
    
    if($stmt->affected_rows > 0) {
        $success_message = "Dati della produzione aggiunti con successo!";
    } else {
        $error_message = "Errore nell'aggiunta dei dati di produzione: " . $conn->error;
    }
}

?>

<?php 
include './templates/header_ris.php';
?>

<div class="container">

   <?php include("./templates/navbar.php"); ?>

    <div class="content">
        <h2>INSERISCI DATI PRODUZIONE - CASEIFICIO: <?php echo $nome_caseificio; ?></h2>

        <?php if(isset($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if(isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <h3>Inserisci dati di produzione del latte</h3>
        <form method="POST" action="">
            <div>
                <label for="data">Data di produzione:</label>
                <input type="date" name="data" required>
            </div>
            <div>
                <label for="qt_lav">Quantità di latte lavorata (litri):</label>
                <input type="number" name="qt_lav" step="0.01" required>
            </div>
            <div>
                <label for="qt_prod">Quantità di latte per la produzione (litri):</label>
                <input type="number" name="qt_prod" step="0.01" required>
            </div>
            <button type="submit" name="submit_dati_latte">Salva Dati Produzione</button>
        </form>

        <div style="margin-top: 20px;">
            <a href="vis_dati_prod.php">
                <button type="button">Visualizza Dati Produzione</button>
            </a>
        </div>
    </div>
</div>

<?php include './templates/footer.php'; ?>

<?php
$conn->close();
?>