<?php
include("db/database.php");
global $pdo;
?>


<section class="auth">

    <form action="function\admin_function.php" method="post" name="add_user">
        <p>Добавление пользователя</p>
        <section class="msg">
            <?php
            session_start();
            if ($_SESSION["msg"] != null) {
                switch ($_SESSION["msg"]) {
                    case "add_user_err":
                        echo "<p>Пользователь с такими данными уже существует</p>";
                        $_SESSION["msg"] = null;
                        break;
                }
            }
            ?>

        </section>
        <select name="group" required>
            <option value="1">Администратор</option>
            <option value="2">Пользователь</option>
        </select>
        <input required type="text" name="login" placeholder="Введите логин">
        <input required type="text" name="name" placeholder="Введите ФИО">
        <input required type="email" name="email" placeholder="Введите email">
        <input required type="tel" name="tel" class="phone" placeholder="Введите телефон">
        <input required type="password" name="password" placeholder="Введите временный пароль">
        <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
        <input type="hidden" value="add_user" name="form">
    </form>
</section>