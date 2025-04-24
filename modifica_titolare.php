<?php
include_once("./templates/header_riservata.php");
?>

<div class="container mt-5">
    <div class="mb-4">
        <a href="./home.php" class="btn btn-secondary">Ritorna alla Home</a>
    </div>

    <?php
        $id_t = $_GET['id_t'];
        require("./conf/db_config.php");
        $stmt = $conn->prepare("SELECT * FROM TITOLARI WHERE id_t = ?");
        $stmt->bind_param("i", $id_t);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $conn->close();
    ?>

    <div class="card shadow p-4">
        <h3 class="mb-4 text-center text-dark">Modifica i dati del titolare</h3>

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

        <form method="POST" action="./php/aggiorna_titolare.php" class="mx-auto" style="max-width: 500px;">
            <input type="hidden" name="id_t" value="<?php echo $id_t; ?>">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-control" required value="<?php echo $row['nome']; ?>">
            </div>

            <div class="mb-3">
                <label for="cognome" class="form-label">Cognome:</label>
                <input type="text" name="cognome" class="form-control" required value="<?php echo $row['cognome']; ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required value="<?php echo $row['email']; ?>">
            </div>

            <div class="mb-4">
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="tel" name="telefono" class="form-control" required value="<?php echo $row['telefono']; ?>">
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
