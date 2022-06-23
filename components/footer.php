</main>

<footer>
    <div class="container_footer">
        <div class="footer_info">
            <i class="fa-solid fa-location-dot fa-2x"></i>
            <div>
                <p>Наша локация</p>
                <p class="footer_p2">г. Москва, ул. Казакова, дом 16</p>
            </div>

        </div>
        <div class="footer_info">
            <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
            <div>
                <p>Позвоните нам</p>
                <p class="footer_p2 ">8 800 555-35-35</p>
            </div>

        </div>
        <div class="footer_info">
            <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
            <div>
                <p>Напишите нам</p>
                <p class="footer_p2">edurem@mail.ru</p>
            </div>

        </div>
    </div>
    <hr>
    <div class="container_footer">
        <div style="width: 800px;">
            <img src="img/logo.png" class="logo">
            <p class="footer_p2">Ведущий медицинский центр в Росии</p>
        </div>
        <div class="icons">
            <p>Подпишитесь на нас</p>
            <i class="fa-brands fa-telegram fa-2x"></i>
            <i class="fa-brands fa-instagram fa-2x"></i>
            <i class="fa-brands fa-vk fa-2x"></i>
        </div>
    </div>


</footer>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    
</script>

</body>

</html>