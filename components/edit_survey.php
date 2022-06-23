<?php
include("db/database.php");
global $pdo;
$id_surveys = $_POST["id_surveys"];
$surveys = get_survey_by_id($id_surveys);
foreach ($surveys as $survey):
?>

<section class="auth">

    <form action="function\admin_function.php" method="post" name="edit_surveys">
        <p>Редактирование обследования</p>
        <input required type="text" name="name" placeholder="Введите название" value="<?php echo $survey["name_surveys"] ?>">
        <textarea required name="description" type="text" placeholder="Введите описание обследования"><?php echo $survey["description_surveys"] ?></textarea>
        <input required type="text" name="price" placeholder="Введите цену" value="<?php echo $survey["price_surveys"] ?>">
        <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
        <input type="hidden" value="edit_surveys" name="form">
        <input type="hidden" value="<?php echo $survey["id_surveys"] ?>" name="id_surveys">
    </form>
</section>

<?php endforeach ?>