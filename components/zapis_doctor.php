<?php
include("db/database.php");
session_start();
$login = $_SESSION["auth"];
$user_id =  get_id_user($login);
$sql = "SELECT * FROM `tokens` WHERE `id_user` = :id AND token_expiration > now()";
$query = $pdo->prepare($sql);
$query->execute(array(
    "id" => $user_id
));
$count = $query->rowCount();

if ($count == 0) {
    $_SESSION["msg"] = "zapis";
    header("Location: auth.php");
}

$id = $_POST["id_doctor"];

?>
<section class="zapis">
    <h1>Запись</h1>
    <?php
    $doctors = get_doctor_by_id($id);
    foreach ($doctors as $doctor) :
    ?>
        <p class="doctor_fio"><?php echo $doctor['fio_doctor'] ?></p>
        <p class="doctor_spec"><?php echo get_doctor_profil($doctor["id_doctor_profil"]) ?></p>
        <p class="doctor_price">Цена: <?php echo get_doctor_price($doctor["id_doctor_profil"]) ?>₽ </p>
    <?php endforeach; ?>




<?php $date = new DateTime("now") ?>
<section class="zapis_form">
    <form action="zapis_doctor_success.php" method="post">
        <p>Выберете дату и время</p>
        <input required type="date" name="date" min="<?php echo $date->format('Y-m-d') ?>" max="2022-06-30">
        <input required type="time" name="time" list="time-list">
        <datalist id="time-list">
            <option value="09:00">
            <option value="10:00">
            <option value="11:00">
            <option value="12:00">
            <option value="13:00">
            <option value="14:00">
            <option value="15:00">
            <option value="16:00">
            <option value="17:00">
            <option value="18:00">
            <option value="19:00">
        </datalist>
        <input required type="hidden" name="id_doctor" value="<?php echo $id ?>">
        <button type="submit"  style="background-color: #9FC63B;">Подтвредить запись</button>
    </form>
</section>
</section>