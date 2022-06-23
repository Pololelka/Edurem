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
    <form action="surveys.php" method="post">
        <select name="select">
            <option value="all">Все категории</option>
            <?php
            $categories = get_categories_surveys();
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
    <form action="surveys.php" method="post">
    <button type="submit" style="background-color: #9FC63B;">Сбросить</button>
        <input type="hidden" value="cancel" name="form">
    </form>
</section>
<section class="surveys">
    <?php


    if (isset($_POST['select'])) {
        $select = $_POST["select"];
    }

    $surveys = get_surveys();


    if (!isset($_POST['select'])) {
        foreach ($surveys as $survey) :
    ?>
            <div class="survey" id="<?php echo $survey["name_surveys"] ?>">
                <p class="survey_name"><?php echo $survey["name_surveys"] ?></p>
                <p class="doctor_spec"><?php echo get_name_categories_surveys($survey["id_categories_surveys"]) ?></p>
                <p class="description_surveys"><?php echo $survey["description_surveys"] ?></p>
                <p class="doctor_price"><?php echo $survey["price_surveys"] ?>₽</p>

                <form action="zapis_surveys.php" method="post">
                    <input type="hidden" name="id_survey" value="<?php echo $survey["id_surveys"] ?>">
                    <button type="submit">Записаться</button>
                </form>
            </div>
            <?php
        endforeach;
    } else {
        foreach ($surveys as $survey) :
            if (get_name_categories_surveys($survey["id_categories_surveys"]) == $select) {
            ?>

                <div class="survey">
                    <p class="survey_name"><?php echo $survey["name_surveys"] ?></p>
                    <p class="doctor_spec"><?php echo get_name_categories_surveys($survey["id_categories_surveys"]) ?></p>
                    <p class="description_surveys"><?php echo $survey["description_surveys"] ?></p>
                    <p class="doctor_price"><?php echo $survey["price_surveys"] ?>₽</p>

                    <form action="zapis_surveys.php" method="post">
                        <input type="hidden" name="id_survey" value="<?php echo $survey["id_surveys"] ?>">
                        <button type="submit">Записаться</button>
                    </form>
                </div>
            <?php

            } elseif ($select == "all") {
            ?>
                <div class="survey">
                    <p class="survey_name"><?php echo $survey["name_surveys"] ?></p>
                    <p class="doctor_spec"><?php echo get_name_categories_surveys($survey["id_categories_surveys"]) ?></p>
                    <p class="description_surveys"><?php echo $survey["description_surveys"] ?></p>
                    <p class="doctor_price"><?php echo $survey["price_surveys"] ?>₽</p>

                    <form action="zapis_surveys.php" method="post">
                        <input type="hidden" name="id_survey" value="<?php echo $survey["id_surveys"] ?>">
                        <button type="submit">Записаться</button>
                    </form>
                </div>
    <?php
            }
        endforeach;
    }
    ?>
</section>