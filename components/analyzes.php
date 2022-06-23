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
    <form action="analyzes.php" method="post">
        <select name="select">
            <option value="all">Все категории</option>
            <?php
            $categories = get_categories_analyzes();
            foreach ($categories as $category) :
            ?>
                <option value="<?php echo $category['name_categories'] ?>" <?php if ($_SESSION["select"] == $category['name_categories']) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $category['name_categories'] ?></option>
            <?php
            endforeach; ?>
        </select>
        <button type="submit" style="background-color: #E6B711;">Применить</button>
    </form>
    <form action="analyzes.php" method="post">
    <button type="submit" style="background-color: #9FC63B;">Сбросить</button>
        <input type="hidden" value="cancel" name="form">
    </form>
</section>
<section class="analyzes">
<?php


if (isset($_POST['select'])) {
    $select = $_POST["select"];
}

$analyzes = get_analyzes();


if (!isset($_POST['select'])) {
    foreach ($analyzes as $analyz) :
?>
        <div class="analyz" id="<?php echo $analyz["name_analyzes"] ?>">
            <p class="doctor_fio"><?php echo $analyz["name_analyzes"] ?></p>
            <p class="doctor_spec"><?php echo get_name_categories_analyzes($analyz["id_categories_analyzes"]) ?></p>
            <p class="doctor_price"><?php echo $analyz["price_analyzes"] ?>₽</p>

            <form action="zapis_analyzes.php" method="post">
                <input type="hidden" name="id_analyz" value="<?php echo $analyz["id_analyzes"] ?>">
                <button type="submit">Записаться</button>
            </form>
        </div>
        <?php
    endforeach;
} else {
    foreach ($analyzes as $analyz) :
        if (get_name_categories_analyzes($analyz["id_categories_analyzes"]) == $select) {
        ?>

            <div class="analyz">
                <p class="doctor_fio"><?php echo $analyz["name_analyzes"] ?></p>
                <p class="doctor_spec"><?php echo get_name_categories_analyzes($analyz["id_categories_analyzes"]) ?></p>
                <p class="doctor_price"><?php echo $analyz["price_analyzes"] ?>₽</p>

                <form action="zapis_analyzes.php" method="post">
                    <input type="hidden" name="id_analyz" value="<?php echo $analyz["id_analyzes"] ?>">
                    <button type="submit">Записаться</button>
                </form>
            </div>
        <?php

        } elseif ($select == "all") {
        ?>
            <div class="analyz">
                <p class="doctor_fio"><?php echo $analyz["name_analyzes"] ?></p>
                <p class="doctor_spec"><?php echo get_name_categories_analyzes($analyz["id_categories_analyzes"]) ?></p>
                <p class="doctor_price"><?php echo $analyz["price_analyzes"] ?>₽</p>

                <form action="zapis_analyzes.php" method="post">
                    <input type="hidden" name="id_analyz" value="<?php echo $analyz["id_analyzes"] ?>">
                    <button type="submit">Записаться</button>
                </form>
            </div>
<?php
        }
    endforeach;
}
?>
</section>