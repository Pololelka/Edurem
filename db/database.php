<?php

global $pdo;

$host = "localhost";
$db = "edurem";
$user = "root";
$password = "";

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);

//получение ид юзера по логину
function get_id_user($login)
{
    global $pdo;
    $users = $pdo->query("SELECT * FROM `users` WHERE `user_login` = '$login' ");
    foreach ($users as $user) {
        return $user['id_user'];
    }
}

//получение группы юзера по логину
function get_groups($login)
{
    global $pdo;
    $users = $pdo->query("SELECT * FROM `users` WHERE `user_login` = '$login' ");
    foreach ($users as $user) {
        return $user['id_group'];
    }
}


//получение названия группы пользователя по ид
function get_groups_by_id($id)
{
    global $pdo;
    $groups = $pdo->query("SELECT * FROM `groups` WHERE `id_group` = '$id' ");
    foreach ($groups as $group) {
        return $group['group_name'];
    }
}

//получение юзера по логину
function get_user($login)
{
    global $pdo;
    $users = $pdo->query("SELECT * FROM `users` WHERE `user_login` = '$login' ");
    return $users;
}
//получение пользователя по айди
function get_user_by_id($id)
{
    global $pdo;
    $user = $pdo->query("SELECT * FROM `users` WHERE `id_user` = '$id' ");
    return $user;
}
//получение фио юзера по ид
function get_fio_user($id)
{
    global $pdo;
    $users = $pdo->query("SELECT * FROM `users` WHERE `id_user` = '$id' ");
    foreach ($users as $user) {
        return $user['user_name'];
    }
}
//получение докторов
function get_doctors()
{
    global $pdo;
    $doctors = $pdo->query("SELECT * FROM `doctors` ");
    return $doctors;
}
//получение наименование профиля по ид
function get_doctor_profil($id)
{
    global $pdo;
    $profils = $pdo->query("SELECT * FROM doctor_profil where id_doctor_profil  = $id ");
    foreach ($profils as $profil) {
        return $profil['name_profil'];
    }
}


//получение цены для специализации
function get_doctor_price($id)
{
    global $pdo;
    $prices = $pdo->query("SELECT * FROM doctor_profil where id_doctor_profil  = $id ");
    foreach ($prices as $price) {
        return $price['price_doctors'];
    }
}


//получение доктора по ид
function get_doctor_by_id($id)
{
    global $pdo;
    $doctor = $pdo->query("SELECT * FROM `doctors` WHERE `id_doctor` = $id ");
    return $doctor;
}
//получение приема по ид юзера
function get_priem_user($id)
{
    global $pdo;
    $doctors = $pdo->query("SELECT * FROM `priem_doctor` WHERE `id_user` = $id ");
    return $doctors;
}

//полчение ид доктора по фамилии юзера
function get_doctors_id_priem($fio)
{
    global $pdo;
    $doctors = $pdo->query("SELECT * FROM `doctors` WHERE `fio_doctor` = '$fio'");
    foreach ($doctors as $doctor) {
        return $doctor['id_doctor'];
    }
}
//получение приема по ид доктора
function get_priem_doctor($id)
{
    global $pdo;
    $doctors = $pdo->query("SELECT * FROM `priem_doctor` WHERE `id_doctor` = $id ");
    return $doctors;
}
//получение специализаций
function get_profil()
{
    global $pdo;
    $profils = $pdo->query("SELECT * FROM doctor_profil");
    return $profils;
}

//получение категорий анализов

function get_categories_analyzes()
{
    global $pdo;
    $categories = $pdo->query("SELECT * FROM categories_analyzes");
    return $categories;
}

//получение анализов
function get_analyzes()
{
    global $pdo;
    $analyzes = $pdo->query("SELECT * FROM `analyzes` ");
    return $analyzes;
}

//получение категории анализов по ид
function get_name_categories_analyzes($id)
{
    global $pdo;
    $categories = $pdo->query("SELECT * FROM categories_analyzes where id_categories_analyzes  = $id ");
    foreach ($categories as $category) {
        return $category['name_categories'];
    }
}

//получение анализа по ид
function get_analyz_by_id($id)
{
    global $pdo;
    $analyz = $pdo->query("SELECT * FROM `analyzes` WHERE `id_analyzes` = $id ");
    return $analyz;
}
//получение анализов приема по ид юхера
function get_analyz_user($id)
{
    global $pdo;
    $analyzes = $pdo->query("SELECT * FROM `priem_analyzes` WHERE `id_user` = $id ");
    return $analyzes;
}




//получение категорий обследований
function get_categories_surveys()
{
    global $pdo;
    $categories = $pdo->query("SELECT * FROM categories_surveys");
    return $categories;
}

//получение обследований
function get_surveys()
{
    global $pdo;
    $surveys = $pdo->query("SELECT * FROM `surveys` ");
    return $surveys;
}

//получение категории обследований по ид
function get_name_categories_surveys($id)
{
    global $pdo;
    $categories = $pdo->query("SELECT * FROM categories_surveys where id_categories_surveys  = $id ");
    foreach ($categories as $category) {
        return $category['name_categories'];
    }
}

//получение обследования по ид
function get_survey_by_id($id)
{
    global $pdo;
    $survey = $pdo->query("SELECT * FROM `surveys` WHERE `id_surveys` = $id ");
    return $survey;
}
//получение обследования приема по ид юхера
function get_survey_user($id)
{
    global $pdo;
    $surveys = $pdo->query("SELECT * FROM `priem_surveys` WHERE `id_user` = $id ");
    return $surveys;
}

// получение всех юзеров
function get_users()
{
    global $pdo;
    $users = $pdo->query("SELECT * FROM `users` ");
    return $users;
}
//получение всех обращений из формы обратной связи
function get_appeals()
{
    global $pdo;
    $appeals = $pdo->query("SELECT * FROM `appeal` ");
    return $appeals;
}