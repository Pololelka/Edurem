<section class="auth">
    <form action="function/handler.php" method="post">
        <p>Регистрация</p>
        <section class="msg">
            <?php
            session_start();
            if ($_SESSION["msg"] != null) {
                switch ($_SESSION["msg"]) {
                    case "reg_psw":
                        echo "<p> Пароли не совпадают</p>";
                        $_SESSION["msg"] = null;
                        break;
                    case "reg_user":
                        echo "<p> Пользователь с такими данными уже существует</p>";
                        $_SESSION["msg"] = null;
                        break;
                }
            }
            ?>
        </section>
        <input required name="name" type="text" placeholder="Введите ваше ФИО">
        <input required name="login" type="text" placeholder="Введите ваш логин">
        <input required name="email" type="email" placeholder="Введите вашу почту">
        <input required name="phone" type="tel" class="phone" placeholder="Введите ваш телефон">
        <input required name="psw1" type="password" placeholder="Введите ваш пароль">
        <input required name="psw2" type="password" placeholder="Повторите ваш пароль ">
        <input type="hidden" value="reg" name="form">
        <button type="submit" style="background-color: #9FC63B;">Зарегестрироваться</button>
    </form>
</section>