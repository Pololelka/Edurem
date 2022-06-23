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
        header("Location: index.php");
        $_SESSION["auth"] = null;
        break;
}

if (get_groups($_SESSION["auth"]) == 1) {
    echo  " ";
} else {
    header("Location: index.php");
}

?>

<form action="admin.php" method="post" name="logout" style="text-align: center; margin-bottom: 30px;">
<section class="msg_admin">
    <?php
if ($_SESSION["msg"] != null) {
    switch ($_SESSION["msg"]) {
        case "del_appeal":
            echo "<p> Обращение удалено</p>";
            $_SESSION["msg"] = null;
            break;
        case "del_user":
            echo "<p> Пользователь удален</p>";
            $_SESSION["msg"] = null;
            break;
        case "del_doctor":
            echo "<p> Врач удален</p>";
            $_SESSION["msg"] = null;
            break;
        case "del_analyzes":
            echo "<p> Анализ удален</p>";
            $_SESSION["msg"] = null;
            break;
        case "del_surveys":
            echo "<p> Обследование удалено</p>";
            $_SESSION["msg"] = null;
            break;
        case "add_user":
            echo "<p> Пользователь добавлен</p>";
            $_SESSION["msg"] = null;
            break;
        case "add_doctor":
            echo "<p> Врач добавлен</p>";
            $_SESSION["msg"] = null;
            break;
        case "add_analyz":
            echo "<p> Анализ добавлен</p>";
            $_SESSION["msg"] = null;
            break;
        case "add_surveys":
            echo "<p> Обследование добавлено</p>";
            $_SESSION["msg"] = null;
            break;
        case "edit_user":
            echo "<p> Пользователь изменен</p>";
            $_SESSION["msg"] = null;
            break;
        case "edit_surveys":
            echo "<p> Обсделование изменено</p>";
            $_SESSION["msg"] = null;
            break;
        case "edit_doctor":
            echo "<p> Врач изменен</p>";
            $_SESSION["msg"] = null;
            break;
        case "edit_analyz":
            echo "<p> Анализ изменен</p>";
            $_SESSION["msg"] = null;
            break;
    }
}
?>
</section>
    <button type="submit">Выйти из админ-панели</button>
    <input type="hidden" value="logout" name="form">
</form>



<!-- названия табов -->
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'users')">Пользователи</button>
    <button class="tablinks" onclick="openCity(event, 'doctors')">Врачи</button>
    <button class="tablinks" onclick="openCity(event, 'analyzes')">Анализы</button>
    <button class="tablinks" onclick="openCity(event, 'surveys')">Обследования</button>
    <button class="tablinks" onclick="openCity(event, 'appeal')">Обратная связь</button>
</div>

<!-- таб с пользователями -->

<div id="users" class="tabcontent">

    <form action="add_user.php" method="post" name="add_user">
        <button style="background-color: #9FC63B;" type="submit">Добавить пользователя</button>
    </form>
    <section class="doctors">
        <?php
        $users = get_users();
        foreach ($users as $user) :
        ?>
            <div class="doctor">
                <p class="doctor_stazh"><b>Группа: </b><?php echo get_groups_by_id($user["id_group"]) ?></p>
                <p class="doctor_stazh"><b>Логин: </b><?php echo $user["user_login"] ?></p>
                <p class="doctor_stazh"><b>Имя: </b><?php echo $user["user_name"] ?></p>
                <p class="doctor_stazh"><b>Email: </b><?php echo $user["user_email"] ?></p>
                <p class="doctor_stazh"><b>Телефон: </b><?php echo $user["user_phone"] ?></p>

                <form action="function\admin_function.php" method="post" name="del_user">
                    <button type="submit">Удалить пользователя</button>
                    <input type="hidden" value="del_user" name="form">
                    <input type="hidden" value="<?php echo $user["id_user"] ?>" name="id_user">
                </form>
                <form action="edit_user.php" method="post" name="edit_user">
                    <button type="submit">Редактировать пользователя</button>
                    <input type="hidden" value="edit_user" name="form">
                    <input type="hidden" value="<?php echo $user["id_user"] ?>" name="id_user">
                </form>
            </div>
        <?php
        endforeach;
        ?>
    </section>
</div>


<!-- таб с врачами -->

<div id="doctors" class="tabcontent">
    <form action="add_doctor.php" method="post" name="add_user">
        <button style="background-color: #9FC63B;" type="submit">Добавить врача</button>
    </form>
    <section class="doctors">

        <?php
        $doctors = get_doctors();
        foreach ($doctors as $doctor) :
        ?>
            <div class="doctor">
                <img src="img/<?php echo $doctor["img_vrach"] ?>">
                <p class="doctor_fio"><?php echo $doctor["fio_doctor"] ?></p>
                <p class="doctor_spec"><?php echo get_doctor_profil($doctor["id_doctor_profil"]) ?></p>
                <p class="doctor_stazh"> Врачебный стаж <?php echo $doctor["stazh_doctor"];
                                                        $stazh = $doctor["stazh_doctor"];
                                                        if (($stazh >= 5 && $stazh <= 20) || (($stazh % 10) >= 5)) {
                                                            echo ' лет';
                                                        } elseif ((($stazh % 10) <= 4) && (($stazh % 10) != 1) && (($stazh % 10) != 0))
                                                            echo ' года';
                                                        elseif (($stazh % 10) == 1) {
                                                            echo ' год';
                                                        }
                                                        ?> </p>


                <form action="function\admin_function.php" method="post" name="del_doctor">
                    <button type="submit">Удалить врача</button>
                    <input type="hidden" value="del_doctor" name="form">
                    <input type="hidden" value="<?php echo $doctor["id_doctor"] ?>" name="id_doctor">
                </form>
                <form action="edit_doctor.php" method="post" name="edit_doctor">
                    <button type="submit">Редактировать врача</button>
                    <input type="hidden" value="edit_doctor" name="form">
                    <input type="hidden" value="<?php echo $doctor["id_doctor"] ?>" name="id_doctor">
                </form>
            </div>
        <?php
        endforeach;
        ?>
    </section>
</div>

<!-- таб с анализами -->

<div id="analyzes" class="tabcontent">
    <form action="add_analyz.php" method="post" name="add_analyz">
        <button style="background-color: #9FC63B;" type="submit">Добавить анализ</button>
    </form>
    <section class="analyzes">
        <?php
        $analyzes = get_analyzes();
        foreach ($analyzes as $analyz) :
        ?>
            <div class="analyz">
                <p class="doctor_fio"><?php echo $analyz["name_analyzes"] ?></p>
                <p class="doctor_spec"><?php echo get_name_categories_analyzes($analyz["id_categories_analyzes"]) ?></p>
                <p class="doctor_price"><?php echo $analyz["price_analyzes"] ?>₽</p>

                <form action="function\admin_function.php" method="post" name="del_analyzes">
                    <button type="submit">Удалить анализ</button>
                    <input type="hidden" value="del_analyzes" name="form">
                    <input type="hidden" value="<?php echo $analyz["id_analyzes"] ?>" name="id_analyzes">
                </form>
                <form action="edit_analyz.php" method="post" name="edit_analyzes">
                    <button type="submit">Редактировать анализ</button>
                    <input type="hidden" value="edit_analyzes" name="form">
                    <input type="hidden" value="<?php echo $analyz["id_analyzes"] ?>" name="id_analyzes">
                </form>
            </div>
        <?php
        endforeach;
        ?>
    </section>
</div>


<!-- таб с обследованиями -->

<div id="surveys" class="tabcontent">

    <form action="add_survey.php" method="post" name="add_surveys">
        <button style="background-color: #9FC63B;" type="submit">Добавить обследование</button>
    </form>
    <section class="surveys">
        <?php
        $surveys = get_surveys();
        foreach ($surveys as $survey) :
        ?>
            <div class="survey">
                <p class="survey_name"><?php echo $survey["name_surveys"] ?></p>
                <p class="doctor_spec"><?php echo get_name_categories_surveys($survey["id_categories_surveys"]) ?></p>
                <p class="description_surveys"><?php echo $survey["description_surveys"] ?></p>
                <p class="doctor_price"><?php echo $survey["price_surveys"] ?>₽</p>

                <form action="function\admin_function.php" method="post" name="del_surveys">
                    <button type="submit">Удалить обследование</button>
                    <input type="hidden" value="del_surveys" name="form">
                    <input type="hidden" value="<?php echo $survey["id_surveys"] ?>" name="id_surveys">
                </form>
                <form action="edit_survey.php" method="post" name="edit_surveys">
                    <button type="submit">Редактировать обследование</button>
                    <input type="hidden" value="edit_surveys" name="form">
                    <input type="hidden" value="<?php echo $survey["id_surveys"] ?>" name="id_surveys">
                </form>
            </div>
        <?php
        endforeach;
        ?>
    </section>
</div>

<!-- таб с обратной связью -->


<div id="appeal" class="tabcontent">
    <section class="surveys">
        <?php
        $appeals = get_appeals();
        foreach ($appeals as $appeal) :
        ?>
            <div class="survey">
                <p class="doctor_stazh"><b>Имя: </b><?php echo $appeal["user_name"] ?></p>
                <p class="doctor_stazh"><b>Телефон: </b><?php echo $appeal["user_phone"] ?></p>
                <p class="doctor_stazh"><b>Email: </b><?php echo $appeal["user_email"] ?></p>
                <p class="doctor_stazh"><b>Обращение: </b><?php echo $appeal["user_problem"] ?></p>
                <p class="doctor_stazh"><b>Дата обращения: </b><?php echo $appeal["appeal_date"] ?></p>

                <form action="function\admin_function.php" method="post" name="del_appeal">
                    <button type="submit">Удалить обращение</button>
                    <input type="hidden" value="del_appeal" name="form">
                    <input type="hidden" value="<?php echo $appeal["id_appeal"] ?>" name="id_appeal">
                </form>
            </div>
        <?php
        endforeach;
        ?>
    </section>
</div>