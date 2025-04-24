<?php
session_start();

include("./templates/AreaRiservata/headerRiservata.php");
require(".conf/dBconf.php");

$stmt = $conn->prepare("SELECT * FROM Forme WHERE id_v IS NULL AND id_c = ?");
$stmt->bind_param("i", $_SESSION["id_c"]);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<div class="container mt-5">

    <div class="mb-4">
        <a href="./home.php" class="btn btn-secondary">Torna alla Home</a>
    </div>

    <form action="./php/inserisci.php" method="POST" class="card p-4 shadow">
        <h3 class="mb-4 text-center">Inserisci dati vendita</h3>

        <div class="mb-3">
            <label for="Nome" class="form-label">Nome cliente</label>
            <input type="text" name="Nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Tipo" class="form-label">Tipo di cliente</label>
            <select name="Tipo" class="form-select" required>
                <option value="Grossista">Grossista</option>
                <option value="Grande distribuzione">Grande distribuzione</option>
                <option value="Privato">Privato</option>
            </select>
        </div>

        <h5 class="mt-4 mb-3">Forme disponibili</h5>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Scelta</th>
                        <th>Data Produzione</th>
                        <th>Stagionatura</th>
                        <th>Seleziona</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?php echo $row["id_f"]; ?></td>
                            <td><?php echo $row["scelta"]; ?></td>
                            <td><?php echo $row["data_prod"]; ?></td>
                            <td><?php echo $row["stagionatura"]; ?></td>
                            <td>
                                <input type="checkbox" name="forma[]" value="<?php echo $row["id_f"]; ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (count($rows) === 0): ?>
                        <tr>
                            <td colspan="5">Nessuna forma disponibile.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <button type="submit" name="inserisci" value="ok" class="btn btn-success">Inserisci</button>
        </div>
    </form>
</div>

<?php include("./templates/footer.php"); ?>
