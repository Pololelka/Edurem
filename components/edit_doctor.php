<?php
include("db/database.php");
global $pdo;
$id_doctor = $_POST["id_doctor"];
$doctors = get_doctor_by_id($id_doctor);
foreach ($doctors as $doctor) :
?>
<section class="auth">

    <form action="function\admin_function.php" method="post" name="edit_doctor">
        <p>Редактирование врача</p>
        <input required type="text" name="name" placeholder="Введите ФИО" value="<?php echo $doctor["fio_doctor"] ?>">
        <input required type="text" name="stazh" placeholder="Введите стаж врача" value="<?php echo $doctor["stazh_doctor"] ?>">
        <input required type="file" name="photo" placeholder="Выберите фото врача" value="<?php echo $doctor["img_vrach"] ?>">
        <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
        <input type="hidden" value="edit_doctor" name="form">
        <input type="hidden" value="<?php echo $doctor["id_doctor"] ?>" name="id_doctor">
    </form>
</section>

<?php endforeach ?>