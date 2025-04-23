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
<a href="./home.php">home</a>
<?php
if (empty($rows)) {
    echo "<h3>Non ci sono vendite</h3>";
} else {
    echo"
    <table>
        <tr>
            <th class=\"cella\">data vendita</th>
            <th class=\"cella\">nome</th>
            <th class=\"cella\">tipo aquirente</th>
        </tr>
    ";
    foreach ($rows as $row) {
        echo " <tr>
            <td class=\"cella\">".$row["v.data_v"]."</td>
            <td class=\"cella\">".$row["v.nome"]."</td>
            <td class=\"cella\">".$row["v.tipo_acq"]."</td>
        </tr>";
    }
    echo "</table>";
}
?>
</body>
</html>