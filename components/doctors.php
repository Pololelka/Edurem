<?php
include("db/database.php");
session_start();
$_SESSION["select"] = null;
if (isset($_POST['select'])) {
    $_SESSION["select"] = $_POST["select"];
}
if (isset($_POST['cancel'])) {
    $_SESSION["select"] = null;
}
?>
<section class="filter">
<form action="doctors.php" method="post" >
   <select name="select">
        <option value="all">Все специализации</option>
        <?php
        $profils = get_profil();
        foreach ($profils as $profil) :
        ?>
            <option value="<?php echo $profil['name_profil'] ?>" <?php if ($_SESSION["select"] == $profil['name_profil']) {
                                                                        echo "selected";
                                                                    } ?>><?php echo $profil['name_profil'] ?></option>
        <?php
        endforeach; ?>
    </select>
   
    <button type="submit" style="background-color: #E6B711;">Применить</button>
</form>
<form action="doctors.php" method="post">
    <button type="submit" style="background-color: #9FC63B;">Сбросить</button>
    <input type="hidden" value="cancel" name="form">
</form>
</section>
<section class="doctors">
<?php


if (isset($_POST['select'])) {
    $select = $_POST["select"];
}

$doctors = get_doctors();


if (!isset($_POST['select'])) {
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
        <p class="doctor_price"><?php echo get_doctor_price($doctor["id_doctor_profil"]) ?>₽</p>
        <form action="zapis_doctor.php" method="post" class="record">
            <input type="hidden" name="id_doctor" value="<?php echo $doctor["id_doctor"] ?>">
            <button type="submit">Записаться на прием</button>
        </form>
        </div>
        <?php
    endforeach;
} else {
    foreach ($doctors as $doctor) :
        if (get_doctor_profil($doctor["id_doctor_profil"]) == $select) {
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
        <p class="doctor_price"><?php echo get_doctor_price($doctor["id_doctor_profil"])?>₽</p>
        <form action="zapis_doctor.php" method="post" class="record">
            <input type="hidden" name="id_doctor" value="<?php echo $doctor["id_doctor"] ?>">
            <button type="submit">Записаться на прием</button>
        </form>
        </div>
        <?php

        } elseif ($select == "all") {
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
        <p class="doctor_price"><?php echo get_doctor_price($doctor["id_doctor_profil"])?>₽</p>
        <form action="zapis_doctor.php" method="post" class="record">
            <input type="hidden" name="id_doctor" value="<?php echo $doctor["id_doctor"] ?>">
            <button type="submit">Записаться на прием</button>
        </form>
        </div>
<?php
        }
    endforeach;
}
?>
</section>
