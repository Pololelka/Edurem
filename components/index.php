<section class="index_photo">
    <a href="reg.php">
    <figure>
        <img src="img/banner.png" alt="">
        <figcaption>
            <p>Зарегистируйтесь и пройдите обследование в нашем медицинском центре</p>
        </figcaption>

    </figure>
    </a>

</section>

<section class="index_photos">
    <a href="doctors.php">
        <figure>
            <img src="img\slider.png" alt="">
            <figcaption>
                <p>Высококвалифицированные врачи</p>
            </figcaption>
        </figure>
    </a>
    <a href="analyzes.php">
        <figure>
            <img src="img\slider2.png" alt="">
            <figcaption>
                <p>Сдайте клинический анализ крови</p>
            </figcaption>
        </figure>
    </a>
    <a href="surveys.php#Невидимая%20поддержка">
        <figure>
            <img src="img\slider5.png" alt="">
            <figcaption>
                <p>Скидки для работающих в опасных условиях</p>
            </figcaption>
        </figure>
    </a>
</section>

<section class="index_analyz">
    <h1>Популярные анализы</h1>
    <div class="analyzes">
        <?php
        include("db/database.php");
        $analyzes = get_analyzes();
        $i = 0;
        foreach ($analyzes as $analyz) :
            if ($i != 3) {
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
                $i = $i + 1;
            }
        endforeach;
        ?>
    </div>
</section>

<section class="index_analyz">
    <h1>Наши врачи</h1>
    <div class="doctors">
        <?php
        $doctors = get_doctors();
        $i = 0;
        foreach ($doctors as $doctor) :
            if ($i != 3) {
        ?>
                <div class="doctor">
                    <img src="img/<?php echo $doctor["img_vrach"] ?>">
                    <p class="doctor_fio"><?php echo $doctor["fio_doctor"] ?></p>
                    <p class="doctor_spec"><?php echo get_doctor_profil($doctor["id_doctor_profil"]) ?></p>
                    <p class="doctor_stazh"> Врачебный стаж <?php echo $doctor["stazh_doctor"];
                                                            $stazh = $doctor["stazh_doctor"];
                                                            if (($stazh >= 5 && $stazh <= 20) || (($stazh % 10) >= 5)) {
                                                                echo ' лет';
                                                            } elseif ((($stazh % 10) <= 4) && (($stazh % 10) != 1) && (($stazh % 10) != 0))
                                                                echo ' года';
                                                            elseif (($stazh % 10) == 1) {
                                                                echo ' год';
                                                            }
                                                            ?> </p>
                    <p class="doctor_price"><?php echo get_doctor_price($doctor["id_doctor_profil"]) ?>₽</p>
                    <form action="zapis_doctor.php" method="post" class="record">
                        <input type="hidden" name="id_doctor" value="<?php echo $doctor["id_doctor"] ?>">
                        <button type="submit">Записаться на прием</button>
                    </form>
                </div>
        <?php
                $i = $i + 1;
            }
        endforeach;
        ?>
    </div>
</section>

<section class="index_analyz">
    <h1>Пройдите осбледование в нашей клинике</h1>
    <div class="surveys">
        <?php
        $surveys = get_surveys();
        $i = 0;
        foreach ($surveys as $survey) :
            if ($i != 1) {
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
                $i = $i + 1;
            }
        endforeach;
        ?>
    </div>
</section>