<?php
session_start();
session_unset();
session_destroy();

include("./templates/login/header.php");
include("./templates/login/login.php");
?>
