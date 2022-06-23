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

$id = $_POST["id_survey"];

?>


<section class="zapis">
    <h1>Запись</h1>
    <?php
    $surveys =  get_survey_by_id($id);
    foreach ($surveys as $survey) :
    ?>
        <p class="doctor_fio"><?php echo $survey["name_surveys"] ?></p>
        <p class="doctor_price">Цена: <?php echo $survey["price_surveys"] ?>₽ </p>

    <?php endforeach; ?>




<?php $date = new DateTime("now") ?>
<section class="zapis_form">
    <form action="zapis_survey_success.php" method="post">
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
        <input required type="hidden" name="id_survey" value="<?php echo $id ?>">
        <button type="submit" style="background-color: #9FC63B;">Подтвредить запись</button>
    </form>
</section>
</section>