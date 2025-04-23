<?php

if(!isset($_SESSION["login"])){
    header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
<header>
    <?php
    echo"<h1>Gestione Parco</h1>" .$_SESSION["parco"]."         admin: " .$_SESSION["nome"]." ". $_SESSION["cognome"]."<button onClick=\"location.href='./index.php'\" class=\"buttonform\">logout</button>";
    ?>
</header>

