<?php
session_start();
if (!isset($_POST['id_t'], $_SESSION['id_c'])) {
    header("location: ../seleziona_titolare.php?msg=KO");
    exit;
}
//con il require riporto il codice di connessione ad DB
require("../conf/dBconfig.php");
//PROCEDURA ESEGUIRE QUERY (rimando al materiale presente su classroom)
$stmt = $conn->prepare("UPDATE CASEIFICI
                    SET id_t = ?
                    WHERE id_c = ?"); //modifico il titolare del caseificio al quale ho fatto l'accesso
$stmt->bind_param("ii", $_POST['id_t'], $_SESSION['id_c']);
if ($stmt->execute()){
    header("location: ../seleziona_titolare.php?msg=OK");
}else{
    header("location: ../seleziona_titolare.php?msg=KO");
}
//chiudo la connessione
$conn->close();
?>
