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

// Funzione per aggiungere una nuova forma di formaggio
if (isset($_POST['submit_forma'])) {
    $scelta = $_POST['scelta'];
    $data_prod = $_POST['data_prod'];
    $peso = $_POST['peso'];

    $stmt = $conn->prepare("INSERT INTO forme (scelta, data_prod id_c) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $scelta, $data_prod, $id_c);
    $stmt->execute();
    
    if($stmt->affected_rows > 0) {
        $success_message = "Forma aggiunta con successo!";
    } else {
        $error_message = "Errore nell'aggiunta della forma: " . $conn->error;
    }
}

?>

<?php 
include './templates/header.php';

?>

<div class="container">

   <?php include("./templates/navbar.php"); ?>

    <div class="content">
        <h2>AGGIUNGI NUOVA FORMA DI FORMAGGIO - CASEIFICIO: <?php echo $nome_caseificio; ?></h2>

        <?php if(isset($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if(isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Modulo per aggiungere una nuova forma di formaggio -->
        <h3>Inserisci dati della forma</h3>
        <form method="POST" action="">
            <div>
                <label for="scelta">Scelta:</label>
                <select name="scelta" required>
                    <option value="prima">Prima</option>
                    <option value="seconda">Seconda</option>
                </select>
            </div>
            <div>
                <label for="data_prod">Data di produzione:</label>
                <input type="date" name="data_prod" required>
            </div>
            <button type="submit" name="submit_forma">Aggiungi Forma</button>
        </form>

        <h3>Forme di formaggio esistenti</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Scelta</th>
                    <th>Data di produzione</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Recupera tutte le forme di questo caseificio
                $stmt = $conn->prepare("SELECT * FROM forme WHERE id_c = ? ORDER BY data_prod DESC");
                $stmt->bind_param("s", $id_c);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_f'] . "</td>";
                        echo "<td>" . $row['scelta'] . "</td>";
                        echo "<td>" . $row['data_prod'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nessuna forma registrata</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include './templates/footer.php'; ?>

<?php
$conn->close();
?>