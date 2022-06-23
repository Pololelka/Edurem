<section class="auth">

    <form action="function/handler.php" method="post">
        <p>Авторизация</p>
        <section class="msg">
            <?php
            session_start();
            if ($_SESSION["msg"] != null) {
                switch ($_SESSION["msg"]) {
                    case "logpsw":
                        echo "<p>Неверный логин или пароль</p>";
                        $_SESSION["msg"] = null;
                        break;
                    case "reg":
                        echo "<p>Регистрация завершена</p>";
                        $_SESSION["msg"] = null;
                        break;
                    case "zapis":
                        echo "<p>Для записи нужно авторизоваться</p>";
                        $_SESSION["msg"] = null;
                        break;
                }
            }

            ?>
        </section>
        <input required name="login" type="text" placeholder="Логин или электронная почта">
        <input required name="psw" type="password"  id="password-input" placeholder="Пароль">
        
        <div style="display: flex; justify-content: space-between; margin-top:15px;">
            <button type="submit" style="background-color: #9FC63B;">Войти</button>
            <p style="padding-top: 20px; text-align: right;"> <a style="color: black; text-decoration: underline; font-size: 20px;" href="reg.php">Нет аккаунта?</a></p>
        </div>
        <input type="hidden" value="auth" name="form">
    </form>
</section>
