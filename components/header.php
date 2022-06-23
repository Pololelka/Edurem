<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/font-awesome/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="script/jquery.maskedinput.min.js" type="text/javascript"></script>

    

    <title><?php echo ($title) ?></title>
    <script>
        $(function($) {
            $(".phone").mask("+7 (999) 999-9999");
        });
    </script>

</head>

<body>
    <header>
        <nav class="container_header">
            <div class="logo">
                <a href="index.php"><img src="img/logo.png" class="logo"></a>
            </div>
            <ul class="menu">
                <li><a href="doctors.php">Врачи</a></li>
                <li><a href="analyzes.php">Анализы</a></li>
                <li><a href="surveys.php">Обследования</a></li>
                <li><a href="about.php">О нас</a></li>
                <li><a href="contact.php">Контакты</a></li>
                <li><a href="function/handler.php">Личный кабинет</a></li>
            </ul>
        </nav>
    </header>
    <main>