<?php
include("db/database.php");
global $pdo;
?>


<section class="auth">

    <form action="function\admin_function.php" method="post" name="add_doctor">
        <p>Добавление врача</p>
        <section class="msg">
            <?php
            session_start();
            if ($_SESSION["msg"] != null) {
                switch ($_SESSION["msg"]) {
                    case "add_doctor_err":
                        echo "<p> Пользователь с такими данными уже существует </p>";
                        $_SESSION["msg"] = null;
                        break;
                }
            }
            ?>

        </section>
        <select name="profil" required>
            <?php
            $profils = get_profil();
            foreach ($profils as $profil) :
            ?>
                <option value="<?php echo $profil['id_doctor_profil'] ?>"><?php echo $profil['name_profil'] ?></option>
            <?php
            endforeach; ?>
        </select>
        <input required type="text" name="login" placeholder="Введите логин">
        <input required type="text" name="name" placeholder="Введите ФИО">
        <input required type="email" name="email" placeholder="Введите email">
        <input required type="tel" name="tel" class="phone" placeholder="Введите телефон">
        <input required type="text" name="stazh" placeholder="Введите стаж врача">
        <input required type="file" name="photo" placeholder="Выберите фото врача">
        <input required type="password" name="password" placeholder="Введите временный пароль">
        <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
        <input type="hidden" value="add_doctor" name="form">
        <input type="hidden" value="3" name="group">
    </form>
</section>