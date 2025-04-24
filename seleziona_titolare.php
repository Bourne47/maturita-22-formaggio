<?php
include_once("./templates/AreaRiservata/headerRiservata.php");
?>

<div class="container mt-5">

    <div class="mb-4">
        <a href="./home.php" class="btn btn-secondary">Ritorna alla Home</a>
    </div>

    <div class="card shadow p-4">
        <h3 class="text-center text-dark mb-4">Seleziona un titolare da modificare</h3>

        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] == 'KO'): ?>
                <div class="alert alert-danger" role="alert">
                    ATTENZIONE! Operazione non andata a buon fine!
                </div>
            <?php elseif ($_GET['msg'] == 'OK'): ?>
                <div class="alert alert-success" role="alert">
                    MODIFICATO! Operazione avvenuta con successo.
                    <br>Ora puoi ritornare alla <a href="home.php" class="alert-link">HOME</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <form method="POST" action="./php/cambio_titolare.php" class="mx-auto" style="max-width: 600px;">
            <div class="mb-3">
                <label for="id_t" class="form-label">Titolare:</label>
                <select name="id_t" class="form-select" required>
                    <?php
                    require("./conf/dBconfig.php");
                    $stmt = $conn->prepare("SELECT id_t, nome, cognome, email, telefono FROM TITOLARI ORDER BY cognome, nome");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $id_t = htmlspecialchars($row['id_t']);
                        $nome = htmlspecialchars($row['nome']);
                        $cognome = htmlspecialchars($row['cognome']);
                        $email = htmlspecialchars($row['email']);
                        $telefono = htmlspecialchars($row['telefono']);
                        echo "<option value=\"$id_t\">$cognome $nome - $email - $telefono</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="text-center">
                <input type="submit" value="Modifica titolare" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<?php
include("./templates/footer.php");
?>
