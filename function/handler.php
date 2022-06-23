<?php
session_start();
include("../db/database.php");
global $pdo;

function genRandomString($length = 8)
{
    $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charsLength = strlen($chars);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $chars[rand(0, $charsLength - 1)];
    }
    return $randomString;
}

// function get_groups($login)
// {
//     global $pdo;
//     $users = $pdo->query("SELECT * FROM `users` WHERE `user_login` = '$login' ");
//     foreach ($users as $user) {
//         return $user['id_group'];
//     }
// }

function checkAuth()
{
    global $pdo;

    $login = $_SESSION["auth"];
    $sql = "SELECT * FROM users WHERE (user_login = :login OR user_email = :login)";
    $query = $pdo->prepare($sql);
    $query->execute(array(
        "login" => $login
    ));
    $count = $query->rowCount();
    $result = $query->fetch(PDO::FETCH_OBJ);

    $token = @$_SESSION["token"];
    $session = session_id();
    $sql = "SELECT * FROM tokens WHERE token = :token AND session_id = :session AND id_user = :user AND token_expiration > now()";
    $query = $pdo->prepare($sql);
    $query->execute(array(
        "token" => $token,
        "session" => $session,
        "user" =>  $result->id_user
    ));
    $count = $query->rowCount();
    $result = $query->fetch(PDO::FETCH_OBJ);
    if ($count) {
        $sql = "UPDATE tokens SET token_expiration = DATE_ADD(now(), INTERVAL 24 MINUTE) WHERE id_user =:user AND  token = :token AND session_id = :session";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "user" => $result->id_user,
            "token" => $token,
            "session" => $session
        ));
        return true;
        //Действия в случае нахождения активного ключа безопасности. Требуется вернуть «истину» и обновить существующий ключ.
    } else {
        return false;
        //Действия в случае отсутствия активного ключа безопасности. Требуется вернуть «ложь».
    }
}

if (checkAuth()) {
    // $login = $_POST["login"];
    if (get_groups($_SESSION["auth"]) == 1) {
        header("Location: ../admin.php");
    } elseif (get_groups($_SESSION["auth"]) == 2) {
        header("Location: ../lk.php");
    } elseif (get_groups($_SESSION["auth"]) == 3) {
        header("Location: ../lk_doctor.php");
    }
} else {
    header("Location: ../auth.php");
}

$form = @$_POST["form"];
switch ($form) {
    case "reg":
        $login = $_POST["login"];
        $email = $_POST["email"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $password = $_POST["psw1"];
        $confirm = $_POST["psw2"];

        $sql = "SELECT * FROM users WHERE user_login = :login OR user_email = :mail";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "login" => $login,
            "mail" => $email
        ));
        $count = $query->rowCount();

        if ($count == 0) {
            if ($_POST["psw1"] === $_POST["psw2"]) {
                $datas = array(
                    "user_login" => $_POST["login"],
                    "user_email" => $_POST["email"],
                    "user_psw" => $_POST["psw1"],
                    "user_phone" => $_POST["phone"],
                    "user_name" => $_POST["name"]
                );
                $sql = "INSERT INTO users (user_login, user_email,  user_name, user_password, user_phone) VALUES (:user_login, :user_email, :user_name, :user_psw, :user_phone)";
                $query = $pdo->prepare($sql);
                $query->execute($datas);
                $_SESSION["msg"] = "reg";
            } else {
                $_SESSION["msg"] = "reg_psw";
                header("Location: ../reg.php");
            }
        } else {
            $_SESSION["msg"] = "reg_user";
            header("Location: ../reg.php");
        }
        break;
    case "auth": {
            $login = $_POST["login"];
            $password = $_POST["psw"];
            $sql = "SELECT * FROM users WHERE (user_login = :login OR user_email = :login) AND BINARY user_password = :psw";
            $query = $pdo->prepare($sql);
            $query->execute(array(
                "login" => $login,
                "psw" => $password
            ));
            $count = $query->rowCount();
            $result = $query->fetch(PDO::FETCH_OBJ);
            $_SESSION["auth"] = $login;

            if ($count == 1) {
                $token = genRandomString(32);
                $_SESSION["token"] = $token;
                $session = session_id();
                $sql = "INSERT INTO tokens (id_user, token, session_id, token_expiration) VALUES (:user, :token, :session, DATE_ADD(now(), INTERVAL 24 MINUTE))";
                $query = $pdo->prepare($sql);
                $query->execute(array(
                    "user" => $result->id_user,
                    "token" => $token,
                    "session" => $session
                ));


                if (get_groups($login) == 1) {
                    header("Location: ../admin.php");
                } elseif (get_groups($login) == 2) {
                    header("Location: ../lk.php");
                } elseif (get_groups($login) == 3) {
                    header("Location: ../lk_doctor.php");
                }
            } else {
                $_SESSION["msg"] = "logpsw";
            }
        }
        break;
    default:
        echo "Вы кто такие? Я вас не звал.";
        break;
}
