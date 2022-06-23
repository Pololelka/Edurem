<?php
include("db/database.php");
global $pdo;

$login = $_SESSION["auth"];
$user_id =  get_id_user($login);
$sql = "SELECT * FROM `tokens` WHERE `id_user` = :id AND token_expiration > now()";
$query = $pdo->prepare($sql);
$query->execute(array(
    "id" => $user_id
));
$count = $query->rowCount();

if ($count == 0) {
    header("Location: index.php");
}
?>
<div class="lk">
    <section class="user">
        <!-- 145 на 165 -->
        <div class="img">
            <i class="fa-solid fa-user fa-10x"></i>
        </div>
        <h2>Мой профиль</h2>
        <div class="user_info">

            <div>
                <p>Имя</p>
                <p>Телефон</p>
                <p>Email</p>
            </div>
            <?php
            $users = get_user($login);
            foreach ($users as $user) :

            ?>
                <div style="text-align: right;">


                    <p><b><?php echo $user["user_name"] ?></b></p>
                    <p><b><?php echo $user['user_phone'] ?></b></p>
                    <p><b><?php echo $user['user_email'] ?></b></p>
                <?php
                $fio_vrach = $user["user_name"];
            endforeach; ?>
                </div>
        </div>
        <!-- <h3>Изменить пароль</h3>
        <form action="function/lk_function.php" method="post">
            <input type="password" name="pswold" placeholder="Старый пароль">
            <input type="password" name="pswnew" placeholder="Новый пароль">
            <input type="password" name="pswnew1" placeholder="Повторите новый пароль">
            <button type="submit">Сохранить</button>
            <input type="hidden" value="pswupd" name="form">
        </form> -->

        <form action="function/lk_function.php" method="post" name="logout" class="logout">
            <button type="submit">Выйти</button>
            <input type="hidden" value="logout" name="form">
        </form>
    </section>
    <section class="priems">
        <div class="tablk">
            <button class="tablinks" onclick="openCity(event, 'priems')">Приемы</button>
            <button class="tablinks" onclick="openCity(event, 'settings')">Настройки</button>
        </div>
        <div id="priems" class="tabcontent">
            <div class="priem_block">

                <p class="priem_head">Предстоящие приемы</p>
                <?php
                $login = $_SESSION["auth"];
                $id_doctor =  get_doctors_id_priem($fio_vrach);

                $sql = "SELECT * FROM priem_doctor WHERE id_doctor = :id_doctor AND date_priem > now()";
                $query = $pdo->prepare($sql);
                $query->execute(array(
                    "id_doctor" => $id_doctor
                ));
                $count = $query->rowCount();

                if ($count != 0) {

                    $priems = get_priem_doctor(get_doctors_id_priem($fio_vrach));
                    foreach ($priems as $priem) :
                        $date1 = new DateTime("now");
                        $date2 = new DateTime($priem['date_priem']);
                        $time1 = new DateTime($priem['time_priem']);
                        if ($date2 > $date1) {
                ?>
                            <p class="priem_fio"><b><?php echo get_fio_user($priem['id_user'])  ?></b></p>
                            <p class="priem_date">Дата приема: <?php echo $date2->format('d.m.Y'); ?></p>
                            <p class="priem_date">Время приема: <?php echo $time1->format('H:i') ?></p>

                            <form action="function/lk_doctor_function.php" method="post" class="form_doctor">
                                <textarea required name="prescription" type="text" placeholder="Введите назначения пациенту"><?php echo $priem['prescription'] ?></textarea>
                                <input type="hidden" name="id_priem" value="<?php echo $priem['id_priem_doctor'] ?>">
                                <input type="hidden" name="form" value="prescription">
                                <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
                            </form>
                <?php }
                    endforeach;
                } else echo "<p>Нет предсоящих записей</p>"  ?>
            </div>
            <div class="priem_block">

                <p class="priem_head">Прошедшие приемы</p>
                <?php
                $login = $_SESSION["auth"];
                $id_doctor =  get_doctors_id_priem($fio_vrach);

                $sql = "SELECT * FROM priem_doctor WHERE id_doctor = :id_doctor AND date_priem < now()";
                $query = $pdo->prepare($sql);
                $query->execute(array(
                    "id_doctor" => $id_doctor
                ));
                $count = $query->rowCount();

                if ($count != 0) {
                    $priems = get_priem_doctor(get_doctors_id_priem($fio_vrach));
                    foreach ($priems as $priem) :
                        $date1 = new DateTime("now");
                        $date2 = new DateTime($priem['date_priem']);
                        $time1 = new DateTime($priem['time_priem']);
                        if ($date2 < $date1) {
                ?>
                            <p class="priem_fio"><b><?php echo get_fio_user($priem['id_user'])  ?></b></p>
                            <p class="priem_date">Дата приема: <?php echo $date2->format('d.m.Y'); ?></p>
                            <p class="priem_date">Время приема: <?php echo $time1->format('H:i') ?></p>

                            <form action="function/lk_doctor_function.php" method="post" class="form_doctor">
                                <textarea required name="prescription" type="text" placeholder="Введите назначения пациенту"><?php echo $priem['prescription'] ?></textarea>
                                <input type="hidden" name="id_priem" value="<?php echo $priem['id_priem_doctor'] ?>">
                                <input type="hidden" name="form" value="prescription">
                                <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
                            </form>
                <?php }
                    endforeach;
                } else echo "<p>Нет прошедших записей</p>" ?>
            </div>
        </div>
        <div id="settings" class="tabcontent">
            <div class="priem_block">
                <form action="function/lk_doctor_function.php" method="post" class="settings">
                    <p>Изменить пароль</p>
                    <section class="msg">
                        <?php
                        if ($_SESSION["msg"] != null) {
                            switch ($_SESSION["msg"]) {
                                case "oldpsw":
                                    echo "<p> Неверно введен старый пароль</p>";
                                    $_SESSION["msg"] = null;
                                    break;
                                case "newpsw":
                                    echo "<p> Новые пароли не совпадают</p>";
                                    $_SESSION["msg"] = null;
                                    break;
                                case "good":
                                    echo "<p> Пароль успешно изменен</p>";
                                    $_SESSION["msg"] = null;
                                    break;
                            }
                        }
                        ?>
                    </section>
                    <input type="password" name="pswold" placeholder="Старый пароль" required>
                    <input type="password" name="pswnew" placeholder="Новый пароль" required>
                    <input type="password" name="pswnew1" placeholder="Повторите новый пароль" required>
                    <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
                    <input type="hidden" value="pswupd" name="form">
                </form>
                <hr class="line">
                <form action="function/lk_doctor_function.php" method="post" class="settings">
                    <p>Изменить email</p>
                    <section class="msg">
                        <?php
                        if ($_SESSION["msg"] != null) {
                            switch ($_SESSION["msg"]) {
                                case "emailupd":
                                    echo "<p>Email успешно изменен</p>";
                                    $_SESSION["msg"] = null;
                                    break;
                                case "emailerr":
                                    echo "<p>Пользователь с такими данными уже существует</p>";
                                    $_SESSION["msg"] = null;
                                    break;
                            }
                        }
                        ?>
                    </section>
                    <input type="email" name="email" placeholder="Введите новый email" required>
                    <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
                    <input type="hidden" value="emailupd" name="form">
                </form>
                <hr class="line">
                <form action="function/lk_doctor_function.php" method="post" class="settings">
                    <p>Изменить логин</p>
                    <section class="msg">
                        <?php
                        if ($_SESSION["msg"] != null) {
                            switch ($_SESSION["msg"]) {
                                case "loginupd":
                                    echo "<p>Логин успешно изменен</p>";
                                    $_SESSION["msg"] = null;
                                    break;
                                case "loginerr":
                                    echo "<p>Пользователь с такими данными уже существует</p>";
                                    $_SESSION["msg"] = null;
                                    break;
                            }
                        }
                        ?>
                    </section>
                    <input type="text" name="login" placeholder="Введите новый логин" required>
                    <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
                    <input type="hidden" value="loginupd" name="form">
                </form>
            </div>
        </div>

    </section>
</div>