<?php
include("../db/database.php");
global $pdo;

session_start();

$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$problem = $_POST["problem"];

$sql = "INSERT INTO appeal (user_name, user_phone, user_email, user_problem) VALUES (:name, :phone, :email, :problem)";
$query = $pdo->prepare($sql);
$query->execute(array(
    "name" => $name,
    "phone" => $phone,
    "email" => $email,
    "problem" => $problem
));


$_SESSION["msg"] = "appeal_good";

header("Location: ../contact.php");


