<?php
include("../db/database.php");
global $pdo;
session_start();


$form = @$_POST["form"];
switch ($form) {
    case "logout":
        $login = $_SESSION["auth"];
        $user_id =  get_id_user($login);
        $sql = "DELETE FROM `tokens` WHERE `id_user` = :id";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "id" => $user_id
        ));
        header("Location: ../index.php");
        $_SESSION["auth"] = null;
        break;
    case "pswupd":
        $pswold = $_POST["pswold"];
        $pswnew = $_POST["pswnew"];
        $pswnew1 = $_POST["pswnew1"];
        $login = $_SESSION["auth"];

        $sql = "SELECT * FROM `users` WHERE `user_login` = :login AND `user_password` = :pswold ";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "login" => $login,
            "pswold" => $pswold
        ));
        $count = $query->rowCount();

        if ($pswnew == $pswnew1) {
            if ($count) {
                $sql = "UPDATE `users` SET `user_password` = :pswnew WHERE `user_login` = :login";
                $query = $pdo->prepare($sql);
                $query->execute(array(
                    "login" => $login,
                    "pswnew" => $pswnew
                ));

                $_SESSION["msg"] = "good";
            } else {
                $_SESSION["msg"] = "oldpsw";
            }
        } else {
            $_SESSION["msg"] = "newpsw";
        }

        header("Location: ../lk_doctor.php#settings");
        break;
    case "emailupd":
        $email = $_POST["email"];
        $login = $_SESSION["auth"];

        $sql = "SELECT * FROM `users` WHERE `user_email` = :email";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "email" => $email
        ));
        $count = $query->rowCount();

        if ($count == 0) {
            $sql = "UPDATE `users` SET `user_email` = :email WHERE `user_login` = :login";
            $query = $pdo->prepare($sql);
            $query->execute(array(
                "login" => $login,
                "email" => $email
            ));

            $_SESSION["msg"] = "emailupd";
        } else {
            $_SESSION["msg"] = "emailerr";
        }

        header("Location: ../lk_doctor.php#settings");
        break;
    case "loginupd":
        $loginnew = $_POST["login"];
        $login = $_SESSION["auth"];

        $sql = "SELECT * FROM `users` WHERE `user_login` = :login";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "login" => $loginnew
        ));
        $count = $query->rowCount();

        if ($count == 0) {
            $sql = "UPDATE `users` SET `user_login` = :loginnew WHERE `user_login` = :login";
            $query = $pdo->prepare($sql);
            $query->execute(array(
                "login" => $login,
                "loginnew" => $loginnew
            ));
            $_SESSION["auth"] = $loginnew;

            $_SESSION["msg"] = "loginupd";
        } else {
            $_SESSION["msg"] = "loginerr";
        }

        header("Location: ../lk_doctor.php#settings");
        break;
    case "prescription":
        $prescription = $_POST["prescription"];
        $id_priem = $_POST["id_priem"];

        $sql = "UPDATE `priem_doctor` SET `prescription` = :prescription WHERE `id_priem_doctor` = :id_priem";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "prescription" => $prescription,
            "id_priem" => $id_priem
        ));
        header("Location: ../lk_doctor.php");
        break;
}
