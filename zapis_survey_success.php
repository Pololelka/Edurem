<?php
include("db/database.php");
$title = "Запись подтверждена";
include("components/header.php");
session_start();
$login = $_SESSION["auth"];

$user_id =  get_id_user($login);

$id = $_POST["id_survey"];
$date = $_POST["date"];
$time = $_POST["time"];

$sql = "INSERT INTO priem_surveys (id_surveys, id_user, date_priem, time_priem) VALUES (:id, :user_id, :date, :time)";
$query = $pdo->prepare($sql);
$query->execute(array(
    "id" => $id,
    "user_id" => $user_id,
    "date" => $date,
    "time" => $time
));

$date1 = new DateTime($date);
$time2 = new DateTime($time);
?>
<section class="zapis">
    <h1>Талон</h1>
    <div>
        <p>Вы записаны на обследование</p>
        <?php
        $surveys =  get_survey_by_id($id);
        foreach ($surveys as $survey) :
        ?>
            <p><?php echo $survey["name_surveys"] ?></p>
            <p>Цена приема: <?php echo $survey['price_surveys'] ?></p>

        <?php endforeach; ?>


        <p>Дата приема: <?php echo $date1->format('d.m.Y') ?></p>
        <p>Время приема: <?php echo $time2->format('H:i') ?></p>
    </div>
</section>
<?php
include("components/footer.php");
