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
<a href="./home.php">home</a>
<form action="./php/inserisci.php" method="POST">
    <h3>Inserisci dati vendita</h3>
    <label for="Nome">Nome</label>
    <input type="text" name="Nome"></input></br>
    <label for="Tipo">Tipo</label>
    <select name="Tipo">
        <option value="Grossista">Grossista</option>
        <option value="Grande distribuzione">Grande distribuzione</option>
        <option value="Privato">Privato</option>
    </select></br>
    <?php
    echo "
    <table>
        <tr>
            <th class=\"cella\">id</th>
            <th class=\"cella\">scelta</th>
            <th class=\"cella\">data produzione</th>
            <th class=\"cella\">stagionatura</th>
        </tr>
    ";
    foreach ($rows as $row) {
        echo " <tr>
            <td class=\"cella\">".$row["id_f"]."</td>
            <td class=\"cella\">".$row["scelta"]."</td>
            <td class=\"cella\">".$row["data_prod"]."</td>
            <td class=\"cella\">".$row["stagionatura"]."</td>
            <td class=\"cella\"> <input type=\"checkbox\" name=\"forma[]\" value=\"".$row["id_f"]."\"></td>
        </tr>
    ";
    }//metto nel name forma[] perche' possono essere piu' di uno e in questo modo li prendo tutti creando un array
    echo "</table>";
    
    ?>
    <button type="submit" name="inserisci" value="ok">inserisci</button>
</form>
</body>
</html>