<?php
session_start();
?>


<section class="map">
<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A9e070a272a7a76fa8beaf386ec5d7264a99f573f43e9359b2faaee85e7a6958c&amp;width=600&amp;height=450&amp;lang=ru_RU&amp;scroll=true"></script>
    <div>
    <p><b>Наш адрес</b> - г. Москва, ул. Казакова, дом 16</p><br>
    <p><b>Наш телефон</b> - 8 800 555-35-35</p><br>
    <p><b>Наш email</b> - edurem@mail.ru</p><br>
    </div>
</section>

<section class="contact">
    <h1>Остались вопросы?</h1>
    <form action="function/appeal.php" method="post">
        <p>Обратная связь</p>
        <section class="msg">
            <?php
            if ($_SESSION["msg"] != null) {
                switch ($_SESSION["msg"]) {
                    case "appeal_good":
                        echo "<p> Ваше обращение принято</p>";
                        $_SESSION["msg"] = null;
                        break;
                }
            }
            ?>
        </section>
        <input required name="name" type="text" placeholder="Ваше имя">
        <input required name="phone" type="tel" class="phone" placeholder="Ваш телефон">
        <input required name="email" type="email" placeholder="Ваш email">
        <textarea required name="problem" type="text" placeholder="Ваш вопрос"></textarea>
        <button type="submit" style="background-color: #E6B711;">Отправить </button>
        <input type="hidden" value="contact" name="form">
    </form>
</section>