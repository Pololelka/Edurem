<?php
include("db/database.php");
global $pdo;
$id_user = $_POST["id_user"];
$users = get_user_by_id($id_user);
foreach ($users as $user):
?>

<section class="auth">

    <form action="function\admin_function.php" method="post" name="edit_user">
        <p>Редактировать пользователя</p>
        <input required type="text" name="login" placeholder="Введите логин" value="<?php echo $user['user_login'] ?>">
        <input required type="text" name="name" placeholder="Введите ФИО" value="<?php echo $user["user_name"] ?>">
        <input required type="email" name="email" placeholder="Введите email" value="<?php echo $user['user_email'] ?>">
        <input required type="tel" name="tel" class="phone" placeholder="Введите телефон" value="<?php echo $user['user_phone'] ?>">
        <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
        <input type="hidden" value="edit_user" name="form">
        <input type="hidden" value="<?php echo $user["id_user"] ?>" name="id_user">
    </form>
</section>

<?php endforeach ?>