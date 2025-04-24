<?php
session_start();
if (!isset($_POST['id_t'], $_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['telefono'])) {
    header("location: ../modifica_titolare.php?msg=KO&id_t=".$_POST['id_t']."");
    exit;
}

//con il require riporto il codice di connessione ad DB
require("../conf/dBconfig.php");
//PROCEDURA ESEGUIRE QUERY (rimando al materiale presente su classroom)
$stmt = $conn->prepare("UPDATE TITOLARI
                    SET nome = ?, cognome = ?, email = ?, telefono = ?
                    WHERE id_t = ?");
$stmt->bind_param("ssssi", $_POST['nome'], $_POST['cognome'],$_POST['email'], $_POST['telefono'], $_POST['id_t']);
if ($stmt->execute()){
    header("location: ../modifica_titolare.php?msg=OK&id_t=".$_POST['id_t']."");
}else{
    header("location: ../modifica_titolare.php?msg=KO&id_t=".$_POST['id_t']."");
}
//chiudo la connessione
$conn->close();
?>
