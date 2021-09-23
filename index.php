<?php
require_once('db_connect.php');
require_once('header.php');
require_once('model/member_db.php');
require_once('model/member.php');
require_once('message_display.php');

session_start();
if (empty($_SESSION['type']));
else if (strcmp($_SESSION['type'], "librarian") == 0)
    header("Location: librarian/index.php");
else if (strcmp($_SESSION['type'], "member") == 0)
    header("Location: member/index.php");

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
    include('home_view.php');
}

if ($action == 'login') {
    if ($_POST['m_user'] == 'admin') {
        $query = $con->prepare("SELECT id FROM librarian WHERE username = ? AND password = ?;");
        $query->bind_param("ss", $_POST['m_user'], $_POST['m_pass']);
        $query->execute();
        $result = $query->get_result();
        if (mysqli_num_rows($result) != 1)
            print("Невалидно корисничко име/лозинка!");
        else {
            $resultRow = mysqli_fetch_array($result);
            $_SESSION['type'] = "librarian";
            $_SESSION['id'] = $resultRow[0];
            $_SESSION['username'] = $_POST['m_user'];
            header('Location: librarian/index.php');
        }
    } else {
        $query = $con->prepare("SELECT id, balance FROM member WHERE username=? AND password =?;");
        $query->bind_param("ss", $_POST['m_user'], sha1($_POST['m_pass']));
        $query->execute();
        $result = $query->get_result();

        if (mysqli_num_rows($result) != 1)
            print("Невалидно корисничко име/лозинка!");
        else {
            $resultRow = mysqli_fetch_array($result);
            $balance = $resultRow[1];
            if ($balance < 0) {
                print("Вашата корисничка сметка е суспендирана!");
            } else {
                $_SESSION['type'] = "member";
                $_SESSION['id'] = $resultRow[0];
                $_SESSION['username'] = $_POST['m_user'];
                header('Location: member/index.php');
            }
        }
    }
} else if ($action == "register_view") {
    include('register.php');
} else if ($action == "register") {
    global $register_error;
    $member = new Member($_POST['m_name'], $_POST['m_email'], $_POST['m_user'], $_POST['m_pass'], $_POST['m_balance']);
    $message = register($member);

    switch ($message) {
        case "LOW BALANCE":
            $register_error = "Вредноста на кредитот мора да биде најмалку 500 денари за да се креира нова корисничка сметка.";
            include('register.php');
            break;
        case "USERNAME EXISTS":
            $register_error = "Корисничкото име веќе постои.";
            include('register.php');
            break;
        case "EMAIL EXISTS":
            $register_error = "Корисничката email адреса веќе постои.";
            include('register.php');
            break;
        case "ERROR":
            $register_error = "Неуспешна регистрација. Обидете се повторно подоцна.";
            include('register.php');
            break;
        case "SUCCESS":
            $register_error = "SUCCESS";
            include('register.php');
            break;
    }
}
