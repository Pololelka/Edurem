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
                <?php endforeach; ?>
                </div>
        </div>

        <form action="function/lk_function.php" method="post" name="logout" class="logout">
            <button type="submit">Выйти</button>
            <input type="hidden" value="logout" name="form">
        </form>
    </section>

    <section class="priems">
        <div class="tablk">
            <button class="tablinks" onclick="openCity(event, 'doctors')">Врачи</button>
            <button class="tablinks" onclick="openCity(event, 'analyzes')">Анализы</button>
            <button class="tablinks" onclick="openCity(event, 'surveys')">Обследования</button>
            <button class="tablinks" onclick="openCity(event, 'settings')">Настройки</button>
        </div>
        <div id="doctors" class="tabcontent">
            <div class="priem_block">
                <p class="priem_head">Предстоящие записи к врачу</p>
                <?php

                $login = $_SESSION["auth"];
                $user_id =  get_id_user($login);

                $sql = "SELECT * FROM priem_doctor WHERE id_user = :user_id AND date_priem > now()";
                $query = $pdo->prepare($sql);
                $query->execute(array(
                    "user_id" => $user_id
                ));
                $count = $query->rowCount();

                if ($count != 0) {
                    $priems = get_priem_user($user_id);
                    foreach ($priems as $priem) :
                        $date1 = new DateTime("now");
                        $date2 = new DateTime($priem['date_priem']);
                        $time1 = new DateTime($priem['time_priem']);
                        if ($date2 > $date1) {
                ?>
                            <?php
                            $doctors = get_doctor_by_id($priem["id_doctor"]);
                            foreach ($doctors as $doctor) :
                            ?>

                                <p class="priem_fio"><?php echo $doctor['fio_doctor'] ?></p>
                                <p class="priem_profil"><?php echo get_doctor_profil($doctor["id_doctor_profil"]) ?></p>
                            <?php endforeach; ?>

                            <p class="priem_date">Дата приема: <?php echo $date2->format('d.m.Y'); ?></p>
                            <p class="priem_time">Время приема: <?php echo $time1->format('H:i') ?></p>

                            <hr class="line">

                <?php }
                    endforeach;
                } else echo "<p>Нет ближайших записей</p>" ?>



            </div>

            <div class="priem_block">
                <p class="priem_head">Прошедшие записи к врачу</p>
                <?php
                $login = $_SESSION["auth"];
                $user_id =  get_id_user($login);

                $sql = "SELECT * FROM priem_doctor WHERE id_user = :user_id AND date_priem < now()";
                $query = $pdo->prepare($sql);
                $query->execute(array(
                    "user_id" => $user_id
                ));
                $count = $query->rowCount();

                if ($count != 0) {
                    $priems = get_priem_user($user_id);
                    foreach ($priems as $priem) :
                        $date1 = new DateTime("now");
                        $date2 = new DateTime($priem['date_priem']);
                        $time1 = new DateTime($priem['time_priem']);
                        if ($date2 < $date1) {
                ?>
                            <?php
                            $doctors = get_doctor_by_id($priem["id_doctor"]);
                            foreach ($doctors as $doctor) :
                            ?>
                                <p class="priem_fio"><?php echo $doctor['fio_doctor'] ?></p>
                                <p class="priem_profil"><?php echo get_doctor_profil($doctor["id_doctor_profil"]) ?></p>
                            <?php endforeach; ?>

                            <p class="priem_date">Дата приема: <?php echo $date2->format('d.m.Y'); ?></p>
                            <p class="priem_time">Время приема: <?php echo $time1->format('H:i') ?></p>
                            <p class="prescription_priem_head">Назначения врача:</p>
                            <p class="prescription_priem"><?php echo $priem['prescription'] ?></p>
                            <hr class="line">

                <?php }
                    endforeach;
                } else echo "<p>Нет прошедших записей</p>" ?>
            </div>
        </div>
        <div id="analyzes" class="tabcontent">
            <div class="priem_block">
                <p class="priem_head">Предстоящие записи на анализы</p>
                <?php
                $login = $_SESSION["auth"];
                $user_id =  get_id_user($login);

                $sql = "SELECT * FROM priem_analyzes WHERE id_user = :user_id AND date_priem > now()";
                $query = $pdo->prepare($sql);
                $query->execute(array(
                    "user_id" => $user_id
                ));
                $count = $query->rowCount();

                if ($count != 0) {
                    $priems = get_analyz_user($user_id);
                    foreach ($priems as $priem) :
                        $date1 = new DateTime("now");
                        $date2 = new DateTime($priem['date_priem']);
                        $time1 = new DateTime($priem['time_priem']);
                        if ($date2 > $date1) {
                ?>

                            <?php
                            $analyzes = get_analyz_by_id($priem["id_analyzes"]);
                            foreach ($analyzes as $analyz) :
                            ?>
                                <p class="priem_fio"><?php echo $analyz['name_analyzes'] ?></p>
                            <?php endforeach; ?>

                            <p class="priem_date">Дата приема: <?php echo $date2->format('d.m.Y'); ?></p>
                            <p class="priem_time">Время приема: <?php echo $time1->format('H:i') ?></p>
                            <hr class="line">
                <?php }
                    endforeach;
                } else echo "<p>Нет ближайших записей</p>" ?>
            </div>
            <div class="priem_block">
                <p class="priem_head">Прошедшие записи на анализы</p>
                <?php
                $login = $_SESSION["auth"];
                $user_id =  get_id_user($login);

                $sql = "SELECT * FROM priem_analyzes WHERE id_user = :user_id AND date_priem < now()";
                $query = $pdo->prepare($sql);
                $query->execute(array(
                    "user_id" => $user_id
                ));
                $count = $query->rowCount();

                if ($count != 0) {
                    $priems = get_analyz_user($user_id);
                    foreach ($priems as $priem) :
                        $date1 = new DateTime("now");
                        $date2 = new DateTime($priem['date_priem']);
                        $time1 = new DateTime($priem['time_priem']);
                        if ($date2 < $date1) {
                ?>

                            <?php
                            $analyzes = get_analyz_by_id($priem["id_analyzes"]);
                            foreach ($analyzes as $analyz) :
                            ?>
                                <p class="priem_fio"><?php echo $analyz['name_analyzes'] ?></p>
                            <?php endforeach; ?>

                            <p class="priem_date">Дата приема: <?php echo $date2->format('d.m.Y'); ?></p>
                            <p class="priem_time">Время приема: <?php echo $time1->format('H:i') ?></p>
                            <hr class="line">
                <?php }
                    endforeach;
                } else echo "<p>Нет прошедших записей</p>" ?>
            </div>
        </div>
        <div id="surveys" class="tabcontent">
            <div class="priem_block">

                <p class="priem_head">Предстоящие записи на обследования</p>
                <?php
                $login = $_SESSION["auth"];
                $user_id =  get_id_user($login);

                $sql = "SELECT * FROM priem_surveys WHERE id_user = :user_id AND date_priem > now()";
                $query = $pdo->prepare($sql);
                $query->execute(array(
                    "user_id" => $user_id
                ));
                $count = $query->rowCount();

                if ($count != 0) {
                    $priems = get_survey_user($user_id);
                    foreach ($priems as $priem) :
                        $date1 = new DateTime("now");
                        $date2 = new DateTime($priem['date_priem']);
                        $time1 = new DateTime($priem['time_priem']);
                        if ($date2 > $date1) {
                ?>

                            <?php
                            $surveys = get_survey_by_id($priem["id_surveys"]);
                            foreach ($surveys as $survey) :
                            ?>
                                <p class="priem_fio"><?php echo $survey['name_surveys'] ?></p>
                            <?php endforeach; ?>

                            <p class="priem_date">Дата приема: <?php echo $date2->format('d.m.Y'); ?></p>
                            <p class="priem_time">Время приема: <?php echo $time1->format('H:i') ?></p>
                            <hr class="line">
                <?php }
                    endforeach;
                } else echo "<p>Нет ближайших записей</p>" ?>
            </div>
            <div class="priem_block">

                <p class="priem_head">Прошедшие записи на обследования</p>
                <?php
                $login = $_SESSION["auth"];
                $user_id =  get_id_user($login);

                $sql = "SELECT * FROM priem_surveys WHERE id_user = :user_id AND date_priem < now()";
                $query = $pdo->prepare($sql);
                $query->execute(array(
                    "user_id" => $user_id
                ));
                $count = $query->rowCount();

                if ($count != 0) {
                    $priems = get_survey_user($user_id);
                    foreach ($priems as $priem) :
                        $date1 = new DateTime("now");
                        $date2 = new DateTime($priem['date_priem']);
                        $time1 = new DateTime($priem['time_priem']);
                        if ($date2 < $date1) {
                ?>

                            <?php
                            $surveys = get_survey_by_id($priem["id_surveys"]);
                            foreach ($surveys as $survey) :
                            ?>
                                <p class="priem_fio"><?php echo $survey['name_surveys'] ?></p>
                            <?php endforeach; ?>

                            <p class="priem_date">Дата приема: <?php echo $date2->format('d.m.Y'); ?></p>
                            <p class="priem_time">Время приема: <?php echo $time1->format('H:i') ?></p>
                            <hr class="line">
                <?php }
                    endforeach;
                } else echo "<p>Нет прошедших записей</p>" ?>
            </div>
        </div>
        <div id="settings" class="tabcontent">
            <div class="priem_block">
                <form action="function/lk_function.php" method="post" class="settings">
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
                <form action="function/lk_function.php" method="post" class="settings">
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
                <form action="function/lk_function.php" method="post" class="settings">
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
</div>




</section>

</div>