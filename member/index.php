<?php
require_once('../db_connect.php');
require_once('verify_member.php');
require_once('../header.php');
require_once('../model/book_db.php');
require_once('../model/member_db.php');
require_once('../model/book.php');
require_once('../message_display.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}

if ($action == '') {
    $result = list_books();
    if (!$result)
        die("Грешка!");
    include('home.php');
} else if ($action == 'request_book') {
    global $member_home_error;
    if (isset($_POST['rd_book'])) {
        $message = request_book($_POST['rd_book'], $_SESSION['username']);
        switch ($message) {
            case "NO COPIES":
                $member_home_error = "Нема достапни примероци од избраната книга!";
                $result = list_books();
                if (!$result)
                    die("Грешка!");
                include('home.php');
                break;
            case "TOO MANY REQUESTS":
                $member_home_error = "Можете да испратите само едно барање за позајмување на книга. Ве молиме почекајте истото да Ви биде одобрено, пред да испратите барање за позајмување на друга книга.";
                $result = list_books();
                if (!$result)
                    die("Грешка!");
                include('home.php');
                break;
            case "TOO MANY BOOKS":
                $member_home_error = "Не може да позајмите повеќе од 3 книги!";
                $result = list_books();
                if (!$result)
                    die("Грешка!");
                include('home.php');
                break;
            case "BOOK EXISTS":
                $member_home_error = "Веќе имате позајмен примерок од избраната книга!";
                $result = list_books();
                if (!$result)
                    die("Грешка!");
                include('home.php');
                break;
            case "BALANCE":
                $member_home_error = "Немате доволно кредит за да ја позајмите книгата!";
                $result = list_books();
                if (!$result)
                    die("Грешка!");
                include('home.php');
                break;
            case "ERROR":
                $member_home_error = "Грешка";
                $result = list_books();
                if (!$result)
                    die("Грешка!");
                include('home.php');
                break;
            case "SUCCESS":
                $member_home_error = "SUCCESS";
                $result = list_books();
                if (!$result)
                    die("Грешка!");
                include('home.php');
                break;
        }
    } else {
        $member_home_error = "Ве молиме одберете книга за позајмување!";
        $result = list_books();
        if (!$result)
            die("Грешка!");
        include('home.php');
    }
} else if ($action == "my_books") {
    $result = get_my_books($_SESSION['username']);
    if (!$result)
        die("Грешка!");
    include('my_books.php');
} else if ($action == "return_books") {
    global $return_error;
    $result = get_my_books($_SESSION['username']);
    if (!$result)
        die("Грешка!");
    $message = return_books($result);
    switch ($message) {
        case "ERROR":
            $return_error = "Грешка!";
            include('my_books.php');
            break;
        case "NOTHING SELECTED":
            $return_error = "Ве молиме одберете книга што сакате да ја вратите!";
            include('my_books.php');
            break;
        default:
            $return_error = $message;
            $result = get_my_books($_SESSION['username']);
            if (!$result)
                die("Грешка!");
            include('my_books.php');
            break;
    }
}
