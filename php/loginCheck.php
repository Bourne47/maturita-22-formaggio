<?php
require("../conf/dBconfig.php");

$stmt = $conn->prepare("SELECT c.nome, c.id_c, t.id_t FROM caseifici c JOIN titolari t on c.id_t = t.id_t WHERE nome = ? AND psw = ?");
$stmt-> bind_param("ss", $_POST['username'], $_POST['psw']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$conn->close();

if(($row['rUsername'] == $_POST['username']) && ($row['rPassword'] == $_POST['psw'])){
    // Se l'utente è stato trovato, inizializza la sessione e memorizza i dati dell'utente
    session_start();
    $_SESSION['login'] = 'ok';
    $_SESSION['id_c'] = intval($row['c.id_c']);
    $_SESSION['id_t'] = intval($row['t.id_t']);
    $_SESSION['nome'] = $row['c.nome'];
    var_dump($_SESSION);
    header("Location: ../home.php");
}else{
    print("utente non trovato ");
    header("Location: ../index.php");
}
?>