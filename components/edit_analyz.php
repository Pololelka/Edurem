<?php
include("db/database.php");
global $pdo;
$id_analyzes = $_POST["id_analyzes"];
$analyzes = get_analyz_by_id($id_analyzes);
foreach ($analyzes as $analyz) :
?>

<section class="auth">

    <form action="function\admin_function.php" method="post" name="edit_analyz">
        <p>Редактирование анализа</p>
        <input required type="text" name="name" placeholder="Введите название" value="<?php echo $analyz["name_analyzes"] ?>">
        <input required type="text" name="price" placeholder="Введите цену" value="<?php echo $analyz["price_analyzes"] ?>">
        <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
        <input type="hidden" value="edit_analyz" name="form">
        <input type="hidden" value="<?php echo $analyz["id_analyzes"] ?>" name="id_analyzes">
    </form>
</section>
<?php endforeach ?>