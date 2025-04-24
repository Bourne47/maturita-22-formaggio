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
    <title>Home_riservata</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
      background-color: #f8f9fa;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    header {
      background-color: #28a745;
      color: white;
      padding: 2rem 0;
      margin-bottom: 2rem;
    }
    .navbar-nav .nav-link {
      color: white !important;
      font-weight: 500;
    }
    .navbar-nav .nav-link:hover {
      color: #e9ecef !important;
    }
    .login-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      padding: 2rem;
      margin-bottom: 2rem;
    }
    footer {
      background-color: #343a40;
      color: white;
      padding: 1rem 0;
      margin-top: auto;
    }
    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }
  </style>
</head>
<body>
<header>
    <?php
    echo"<h1>Gestione Caseificio</h1>" .$_SESSION["nome"]. "<button onClick=\"location.href='./login.php'\" class=\"buttonform\">logout</button>";
    ?>
</header>

