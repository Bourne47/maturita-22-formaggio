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

<?php include './templates/header_ris.php'; ?>

<div class="container mt-5">
    <?php include("./templates/navbar.php"); ?>

    <h2 class="mb-4">Inserisci Dati Produzione - Caseificio: <span class="text-primary"><?php echo $nome_caseificio; ?></span></h2>

    <?php if(isset($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <?php if(isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm p-4 mb-5">
        <h4 class="mb-3">Inserisci dati di produzione del latte</h4>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="data" class="form-label">Data di produzione:</label>
                <input type="date" name="data" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="qt_lav" class="form-label">Quantità di latte lavorata (litri):</label>
                <input type="number" name="qt_lav" step="0.01" class="form-control" required>
            </div>
            <div class="mb-4">
                <label for="qt_prod" class="form-label">Quantità di latte per la produzione (litri):</label>
                <input type="number" name="qt_prod" step="0.01" class="form-control" required>
            </div>
            <button type="submit" name="submit_dati_latte" class="btn btn-success">Salva Dati Produzione</button>
        </form>
    </div>

    <a href="vis_dati_prod.php" class="btn btn-outline-primary">Visualizza Dati Produzione</a>
</div>

<?php include './templates/footer.php'; ?>

<?php $conn->close(); ?>
