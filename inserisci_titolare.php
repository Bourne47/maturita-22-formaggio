<?php include_once("./templates/header_riservata.php"); ?>

<div class="container mt-5">
    <div class="mb-4">
        <a href="./home.php" class="btn btn-secondary">Ritorna alla Home</a>
    </div>

    <div class="text-center">
        <h3 class="text-dark mb-4">Inserisci i dati del titolare</h3>

        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] == 'KO'): ?>
                <div class="alert alert-danger" role="alert">
                    ATTENZIONE! Operazione non andata a buon fine!
                </div>
            <?php elseif ($_GET['msg'] == 'OK'): ?>
                <div class="alert alert-success" role="alert">
                    REGISTRATO! Operazione avvenuta con successo.<br>
                    Ora puoi ritornare alla <a href="home.php" class="alert-link">HOME</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <form method="POST" action="./php/registra_titolare.php" class="mx-auto" style="max-width: 500px;">
            <div class="mb-3 text-start">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3 text-start">
                <label for="cognome" class="form-label">Cognome:</label>
                <input type="text" name="cognome" class="form-control" required>
            </div>
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-4 text-start">
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="tel" name="telefono" class="form-control" required>
            </div>
            <div>
                <input type="submit" value="Registra titolare" class="btn btn-success">
            </div>
        </form>
    </div>
</div>

<?php include("./templates/footer.php"); ?>
