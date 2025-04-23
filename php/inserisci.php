<?php
session_start();
require("../conf/dBconfig.php");

if (isset($_POST["inserisci"]) && $_POST["inserisci"] == "ok") {
    $nome = $_POST["Nome"];
    $tipo = $_POST["Tipo"];
    $stmt = $conn-> prepare("INSERT INTO vendite (data_v, nome, tipo_acq) VALUES (CURRENT_DATE(),?,?)");
    $stmt->bind_param("ss", $nome, $tipo);
    $stmt->execute();
    $id_v = $stmt->insert_id; // Prendi l'id della vendita appena inserita

    $stmt_forme = $conn->prepare("UPDATE forme SET id_v = ? WHERE id_f = ?");
    foreach ($_POST["forma"] as $id_forma) {
        $stmt_update->bind_param("ii", $id_v, $id_forma);
        $stmt_update->execute();
    }
    $conn->close();
    header("Location: ../home.php?msg=Dati vendita inseriti con successo");
}else{
    header("Location: ../home.php?msg=Dati vendita non inseriti ");
}
?>


