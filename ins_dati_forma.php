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

// Inserimento nuova forma
if (isset($_POST['submit_forma'])) {
    $scelta = $_POST['scelta'];
    $data_prod = $_POST['data_prod'];

    $stmt = $conn->prepare("INSERT INTO forme (scelta, data_prod, id_c) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $scelta, $data_prod, $id_c);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $success_message = "Forma aggiunta con successo!";
    } else {
        $error_message = "Errore nell'aggiunta della forma: " . $conn->error;
    }
}
?>

<?php include './templates/header.php'; ?>
<?php include './templates/navbar.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">AGGIUNGI NUOVA FORMA DI FORMAGGIO - CASEIFICIO: <span class="text-success"><?php echo htmlspecialchars($nome_caseificio); ?></span></h2>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <div class="card p-4 mb-5 shadow-sm">
        <h4 class="mb-3">Inserisci dati della forma</h4>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="scelta" class="form-label">Scelta:</label>
                <select name="scelta" class="form-select" required>
                    <option value="prima">Prima</option>
                    <option value="seconda">Seconda</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="data_prod" class="form-label">Data di produzione:</label>
                <input type="date" name="data_prod" class="form-control" required>
            </div>
            <button type="submit" name="submit_forma" class="btn btn-success">Aggiungi Forma</button>
        </form>
    </div>

    <h4>Forme di formaggio esistenti</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success text-center">
                <tr>
                    <th>ID</th>
                    <th>Scelta</th>
                    <th>Data di produzione</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                $stmt = $conn->prepare("SELECT * FROM forme WHERE id_c = ? ORDER BY data_prod DESC");
                $stmt->bind_param("s", $id_c);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['id_f'] . "</td>";
                        echo "<td>" . ucfirst($row['scelta']) . "</td>";
                        echo "<td>" . $row['data_prod'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nessuna forma registrata</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include './templates/footer.php'; ?>
<?php $conn->close(); ?>
