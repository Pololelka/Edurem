<?php
session_start();
$_SESSION["msg"] = null;
$title = "Edurem";
include("components/header.php");
include("components/index.php");
include("components/footer.php");
?>
