<?php
include("db/database.php");
global $pdo;
?>

<section class="auth">

    <form action="function\admin_function.php" method="post" name="add_analyz">
        <p>Добавление анализа</p>
        <select name="category" required>
            <?php
        $categories = get_categories_analyzes();
        foreach ($categories as $category) :
        ?>
            <option value="<?php echo $category['id_categories_analyzes']?>"><?php echo $category['name_categories']?></option>
        <?php
        endforeach; ?>
        </select>
        <input required type="text" name="name" placeholder="Введите название">
        <input required type="text" name="price" placeholder="Введите цену">
        <button type="submit" style="background-color: #9FC63B;">Сохранить</button>
        <input type="hidden" value="add_analyz" name="form">
    </form>
</section>