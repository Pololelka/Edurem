<?php
include("db/database.php");
$title = "Запись подтверждена";
include("components/header.php");
session_start();
$login = $_SESSION["auth"];

$user_id =  get_id_user($login);

$id = $_POST["id_doctor"];
$date = $_POST["date"];
$time = $_POST["time"];

$sql = "INSERT INTO priem_doctor (id_doctor, id_user, date_priem, time_priem) VALUES (:id, :user_id, :date, :time)";
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
        <p>Вы записаны на прием</p>
        <?php
        $doctors = get_doctor_by_id($id);
        foreach ($doctors as $doctor) :
        ?>
            <p><?php echo $doctor['fio_doctor'] ?></p>
            <p><?php echo get_doctor_profil($doctor["id_doctor_profil"]) ?></p>
            <p>Цена приема: <?php echo get_doctor_price($doctor["id_doctor_profil"]) ?>₽</p>

        <?php endforeach; ?>
        <p>Дата приема: <?php echo $date1->format('d.m.Y') ?></p>
        <p>Время приема: <?php echo $time2->format('H:i') ?></p>
    </div>
</section>
<?php
include("components/footer.php");
