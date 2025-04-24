<?php
include_once("./templates/header_riservata.php");
?>

<div class="container mt-5">

    <div class="mb-4">
        <a href="./home.php" class="btn btn-secondary">Ritorna alla Home</a>
    </div>

    <div class="card shadow p-4">
        <h2 class="text-center text-dark mb-4">PRODUZIONE</h2>

        <?php
        echo "<h3 class=\"text-center\">Benvenuto ".$_SESSION['nome']."</h3>";

        // Connessione al database e query per recuperare i dati
        require("./conf/db_config.php");

        $stmt = $conn->prepare("SELECT data, qt_lav, qt_prod FROM DATI_LATTE WHERE id_c = ? ORDER BY data DESC");
        $stmt->bind_param("i", $_SESSION['id_c']);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Stampa della tabella con i dati di produzione
        echo "<table class=\"table table-striped\">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Qt Lavorata (litri)</th>
                    <th>Qt Prodotta (litri)</th>
                </tr>
            </thead>
            <tbody>";

        foreach($rows as $row){
            echo "<tr>
                <td>".$row['data']."</td>
                <td>".$row['qt_lav']."</td>
                <td>".$row['qt_prod']."</td>
                </tr>";
        }

        echo "</tbody></table>";

        ?>

    </div>
</div>

<?php
include_once("./templates/footer.php");
?>
