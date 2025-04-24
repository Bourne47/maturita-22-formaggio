<?php
session_start();

include("./templates/AreaRiservata/headerRiservata.php");
require(".conf/dBconf.php");

$stmt = $conn->prepare("SELECT v.data_v, v.nome, v.tipo_acq FROM vendite v JOIN forme f on v.id_v = f.id_v JOIN caseifici c on c.id_c = f.id_c WHERE c.id_c = ?");
$stmt->bind_param("i", $_SESSION["id_c"]);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<div class="container mt-5">
    <div class="mb-4">
        <a href="./home.php" class="btn btn-secondary">Ritorna alla Home</a>
    </div>

    <h2 class="text-center mb-4">Vendite</h2>

    <?php
    if (empty($rows)) {
        echo "<h3 class='text-center text-danger'>Non ci sono vendite</h3>";
    } else {
        echo "<table class='table table-striped'>
            <thead>
                <tr>
                    <th>Data Vendita</th>
                    <th>Nome</th>
                    <th>Tipo Acquirente</th>
                </tr>
            </thead>
            <tbody>";
        
        foreach ($rows as $row) {
            echo "<tr>
                <td>".$row["v.data_v"]."</td>
                <td>".$row["v.nome"]."</td>
                <td>".$row["v.tipo_acq"]."</td>
            </tr>";
        }

        echo "</tbody></table>";
    }
    ?>
</div>

<?php include("./templates/footer.php"); ?>
