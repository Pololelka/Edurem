<?php
include("../db/database.php");
global $pdo;
session_start();

$form = @$_POST["form"];
switch ($form) {
    case "del_appeal":
        $id_appeal = @$_POST["id_appeal"];
        $sql = "DELETE FROM `appeal` WHERE `id_appeal` = :id";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "id" => $id_appeal
        ));
        header("Location: ../admin.php");
        $_SESSION["msg"] = "del_appeal";
        break;
    case "del_user":
        $id_user = @$_POST["id_user"];
        $sql = "DELETE FROM `users` WHERE `id_user` = :id";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "id" => $id_user
        ));
        header("Location: ../admin.php");
        $_SESSION["msg"] = "del_user";
        break;
    case "del_doctor":
        $id_doctor = @$_POST["id_doctor"];
        $sql = "DELETE FROM `doctors` WHERE `id_doctor` = :id";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "id" => $id_doctor
        ));
        header("Location: ../admin.php");
        $_SESSION["msg"] = "del_doctor";
        break;
    case "del_analyzes":
        $id_analyzes = @$_POST["id_analyzes"];
        $sql = "DELETE FROM `analyzes` WHERE `id_analyzes` = :id";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "id" => $id_analyzes
        ));
        header("Location: ../admin.php");
        $_SESSION["msg"] = "del_analyzes";
        break;
    case "del_surveys":
        $id_surveys = @$_POST["id_surveys"];
        $sql = "DELETE FROM `surveys` WHERE `id_surveys` = :id";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "id" => $id_surveys
        ));
        header("Location: ../admin.php");
        $_SESSION["msg"] = "del_surveys";
        break;
    case "add_user":
        $login = $_POST["login"];
        $email = $_POST["email"];

        $sql = "SELECT * FROM users WHERE user_login = :login OR user_email = :mail";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "login" => $login,
            "mail" => $email
        ));
        $count = $query->rowCount();

        if ($count == 0) {
            $datas = array(
                "user_login" => $_POST["login"],
                "user_email" => $_POST["email"],
                "user_psw" => $_POST["password"],
                "user_phone" => $_POST["tel"],
                "id_group" => $_POST["group"],
                "user_name" => $_POST["name"]
            );
            $sql = "INSERT INTO users (id_group, user_login, user_email,  user_name, user_password, user_phone) VALUES (:id_group, :user_login, :user_email, :user_name, :user_psw, :user_phone)";
            $query = $pdo->prepare($sql);
            $query->execute($datas);
            $_SESSION["msg"] = "add_user";
            header("Location: ../admin.php");
        } else {
            $_SESSION["msg"] = "add_user_err";
            header("Location: ../add_user.php");
        }

        break;
    case "add_doctor":
        $login = $_POST["login"];
        $email = $_POST["email"];

        $sql = "SELECT * FROM users WHERE user_login = :login OR user_email = :mail";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "login" => $login,
            "mail" => $email
        ));
        $count = $query->rowCount();

        if ($count == 0) {
            $datas = array(
                "user_login" => $_POST["login"],
                "user_email" => $_POST["email"],
                "user_psw" => $_POST["password"],
                "user_phone" => $_POST["tel"],
                "id_group" => $_POST["group"],
                "user_name" => $_POST["name"]
            );
            $sql = "INSERT INTO users (id_group, user_login, user_email,  user_name, user_password, user_phone) VALUES (:id_group, :user_login, :user_email, :user_name, :user_psw, :user_phone)";
            $query = $pdo->prepare($sql);
            $query->execute($datas);

            $datas = array(
                "id_doctor_profil" => $_POST["profil"],
                "user_name" => $_POST["name"],
                "stazh_doctor" => $_POST["stazh"],
                "img_vrach" => $_POST["photo"]
            );
            $sql = "INSERT INTO doctors (fio_doctor, id_doctor_profil , stazh_doctor,  img_vrach) VALUES (:user_name, :id_doctor_profil, :stazh_doctor, :img_vrach)";
            $query = $pdo->prepare($sql);
            $query->execute($datas);

            $_SESSION["msg"] = "add_doctor";
            header("Location: ../admin.php");
        } else {
            $_SESSION["msg"] = "add_doctor_err";
            header("Location: ../add_doctor.php");
        }

        break;
    case "add_analyz":
        $datas = array(
            "name_analyzes" => $_POST["name"],
            "price_analyzes" => $_POST["price"],
            "id_categories_analyzes" => $_POST["category"]
        );
        $sql = "INSERT INTO analyzes (id_categories_analyzes, name_analyzes, price_analyzes) VALUES (:id_categories_analyzes, :name_analyzes, :price_analyzes)";
        $query = $pdo->prepare($sql);
        $query->execute($datas);
        $_SESSION["msg"] = "add_analyz";
        header("Location: ../admin.php");

        break;
    case "add_surveys":
        $datas = array(
            "id_categories_surveys" => $_POST["category"],
            "name_surveys" => $_POST["name"],
            "price_surveys" => $_POST["price"],
            "description_surveys" => $_POST["description"]
        );
        $sql = "INSERT INTO surveys (id_categories_surveys, name_surveys, price_surveys, description_surveys) VALUES (:id_categories_surveys, :name_surveys, :price_surveys, :description_surveys)";
        $query = $pdo->prepare($sql);
        $query->execute($datas);
        $_SESSION["msg"] = "add_surveys";
        header("Location: ../admin.php");
        break;
    case "edit_user":
        $datas = array(
            "user_login" => $_POST["login"],
            "user_email" => $_POST["email"],
            "user_phone" => $_POST["tel"],
            "user_name" => $_POST["name"],
            "id_user" => $_POST["id_user"]
        );
        $sql = "UPDATE `users` SET `user_login` = :user_login, `user_name` = :user_name, `user_email` = :user_email, `user_phone` = :user_phone WHERE `users`.`id_user` = :id_user;";
        $query = $pdo->prepare($sql);
        $query->execute($datas);
        $_SESSION["msg"] = "edit_user";
        header("Location: ../admin.php");
        break;
    case "edit_surveys":
        $datas = array(
            "name_surveys" => $_POST["name"],
            "price_surveys" => $_POST["price"],
            "description_surveys" => $_POST["description"],
            "id_surveys" => $_POST["id_surveys"]
        );
        $sql = "UPDATE `surveys` SET `name_surveys` = :name_surveys, `price_surveys` = :price_surveys, `description_surveys` = :description_surveys WHERE `surveys`.`id_surveys` = :id_surveys;";
        $query = $pdo->prepare($sql);
        $query->execute($datas);
        $_SESSION["msg"] = "edit_surveys";
        header("Location: ../admin.php");
        break;
    case "edit_doctor":
        $datas = array(
            "user_name" => $_POST["name"],
            "stazh_doctor" => $_POST["stazh"],
            "img_vrach" => $_POST["photo"],
            "id_doctor" => $_POST["id_doctor"]
        );
        $sql = "UPDATE `doctors` SET `fio_doctor` = :user_name, `stazh_doctor` = :stazh_doctor, `img_vrach` = :img_vrach WHERE `doctors`.`id_doctor` = :id_doctor;";
        $query = $pdo->prepare($sql);
        $query->execute($datas);
        $_SESSION["msg"] = "edit_doctor";
        header("Location: ../admin.php");
        break;
    case "edit_analyz":
        $datas = array(
            "name_analyzes" => $_POST["name"],
            "price_analyzes" => $_POST["price"],
            "id_analyzes" => $_POST["id_analyzes"]
        );
        $sql = "UPDATE `analyzes` SET `name_analyzes` = :name_analyzes, `price_analyzes` = :price_analyzes WHERE `analyzes`.`id_analyzes` = :id_analyzes;";
        $query = $pdo->prepare($sql);
        $query->execute($datas);
        $_SESSION["msg"] = "edit_analyz";
        header("Location: ../admin.php");
        break;
}
