<?php
session_start();
session_unset();
session_destroy();

include "./templates/header.php";
include "./templates/login.php";
include "./templates/footer.php";
?>
