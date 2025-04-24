<?php
session_start();
if (!isset($_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['telefono'], $_SESSION['id_c'])) {
    header("location: ../inserisci_titolare.php?msg=KO");
    exit;
}
//con il require riporto il codice di connessione ad DB
require("../conf/dBconfig.php");
//PROCEDURA ESEGUIRE QUERY (rimando al materiale presente su classroom)
$stmt = $conn->prepare("INSERT INTO TITOLARI (nome, cognome, email, telefono) VALUES (?, ?, ?, ?)"); //creo il nuovo titolare
$stmt->bind_param("ssss", $_POST['nome'], $_POST['cognome'],$_POST['email'], $_POST['telefono']);
if ($stmt->execute()){
    $stmt = $conn->prepare("SELECT id_t FROM TITOLARI WHERE nome = ? AND cognome = ? AND email = ? AND telefono = ?"); //ottengo l'id del titolare appena creato
    $stmt->bind_param("ssss", $_POST['nome'], $_POST['cognome'],$_POST['email'], $_POST['telefono']);
    $stmt->execute();
	$result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $id_t = $row['id_t'];
    $stmt = $conn->prepare("UPDATE CASEIFICI
                    SET id_t = ?
                    WHERE id_c = ?"); //modifico il titolare del caseificio al quale ho fatto l'accesso
    $stmt->bind_param("ii", $id_t, $_SESSION['id_c']);
    if ($stmt->execute()){
        header("location: ../inserisci_titolare.php?msg=OK");
    }else{
        header("location: ../inserisci_titolare.php?msg=KO");
    }
}else{
    header("location: ../inserisci_titolare.php?msg=KO");
}
//chiudo la connessione
$conn->close();
?>
