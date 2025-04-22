<?php
include_once("./templates/header_riservata.php");
//include_once("./templates/menusx.php");
?>
<div id="menusx">
        <div>
            <?php
                echo "<div><button type=\"button\" onClick=\"location.href='./home.php'\" class=\"buttonform menubutton\">RITORNA ALLA HOME</button></div>";
                //echo "<div><button type=\"button\" onClick=\"location.href='./visualizza_specie_re.php'\" class=\"buttonform menubutton\">VISUALIZZA SPECIE A RISCHIO ESTINZIONE</button></div>";
            ?>
        </div>
</div>
<div id="central" style="width: 100%;margin-left:25px">
    <h2>PRODUZIONE</h2>
    
    <?php
    //print_r($_GET);

    //STAMPO i dati che ricevo dall'URL creata in logincheck.php riga 20
    echo "<h3>Benvenuto ".$_SESSION['nome']."</h3>";

    //SELECT id_d, data, qt_lav, qt_prod FROM DATI_LATTE WHERE id_c = {$_SESSION['id_c']} ORDER BY data desc

    //STAMPA delle VERIFICHE ancora da svolgere
    require("./conf/db_config.php");

    $stmt = $conn->prepare("SELECT data, qt_lav, qt_prod FROM DATI_LATTE WHERE id_c = ? ORDER BY data DESC");
    $stmt->bind_param("i", $_SESSION['id_c']);
    $stmt->execute();

    
    //estrazione multi-riga
	$result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    //************************************************************
    //****************STAMPO IL RISULTATO DELLA QUERY (MULTIRIGHE)
	echo "<table class=\"table\">
    <tr>
    <td><b>Data</td>
    <td><b>Qt lavorata</td>
    <td><b>Qt prodotta</td>
    </tr><tbody>";

    //ciclo FOREACH che scorre tutte le righe del risultato delle query
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

<?php
include_once("./templates/footer.php");
?>