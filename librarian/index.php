<?php
require_once('../db_connect.php');
require_once('verify_librarian.php');
require_once('../header.php');
require_once('../model/book_db.php');
require_once('../model/librarian_db.php');
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
    include('home.php');
} else if ($action == 'list_books') {
    $result = list_books();
    if (!$result)
        die("Грешка!");
    include('display_books.php');
} else if ($action == 'insert_book') {
    include('insert_book.php');
} else if ($action == 'add_book') {
    $target_dir = "../covers/";

    if ($_FILES["b_cover"]["size"] == 0) {
        $target_file = "../covers/no_cover.jpg";
    } else {
        $target_file = $target_dir . basename($_FILES["b_cover"]["name"]);
    }

    $book = new Book($_POST['b_isbn'], $_POST['b_title'], $_POST['b_author'], $_POST['b_category'], $_POST['b_price'], $_POST['b_copies'], $target_file);
    $message = add_book($book);

    global $error_text;
    switch ($message) {
        case "ISBN":
            $error_text = "Книга со таков ISBN веќе постои!";
            include('insert_book.php');
            break;
        case "EXTENSION":
            $error_text = "Ве молиме одберете датодека со екстензија .jpg, .png, .jpeg или .gif!";
            include('insert_book.php');
            break;
        case "ERROR":
            $error_text = "Настана грешка при прикачувањето на сликата од насловната страна.";
            include('insert_book.php');
            break;
        case "SUCCESS":
            $error_text = "";
            include('home.php');
            break;
    }
} else if ($action == "delete_book_view") {
    $result = list_books();
    if (!$result)
        die("Грешка!");
    include('delete_book.php');
} else if ($action == "delete_book") {
    global $delete_error;
    if (isset($_GET['isbn'])) {
        $isbn = $_GET['isbn'];
        $result_delete = delete_book($isbn);

        if ($result_delete) {
            $result = list_books();
            if (!$result)
                die("Грешка!");
            include('delete_book.php');
        } else {
            $delete_error = "Грешка!";
            $result = list_books();
            if (!$result)
                die("Грешка!");
            include('delete_book.php');
        }
    }
} else if ($action == "update_copies_view") {
    include('update_copies.php');
} else if ($action == "update_copies") {
    $message = update_copies($_POST['b_isbn'], $_POST['b_copies']);
    global $update_error;
    switch ($message) {
        case "ISBN":
            $update_error = "Невалиден ISBN";
            include('update_copies.php');
            break;
        case "ERROR":
            $update_error = "Неуспешно додадени примероци!";
            include('update_copies.php');
            break;
        case "SUCCESS":
            $update_error = "";
            include('home.php');
            break;
    }
} else if ($action == "update_balance_view") {
    include('update_balance.php');
} else if ($action == "update_balance") {
    $message = update_balance($_POST['m_user'], $_POST['m_balance']);
    global $balance_error;
    switch ($message) {
        case "INVALID USERNAME":
            $balance_error = "Невалидно корисничко име!";
            include('update_balance.php');
            break;
        case "ERROR":
            $balance_error = "Грешка!";
            include('update_balance.php');
            break;
        case "SUCCESS":
            $balance_error = "";
            include('home.php');
            break;
    }
} else if ($action == "pending_book_requests_view") {
    global $book_requests_error;
    $result = fetch_pending_book_requests();
    if (!$result)
        die("Грешка!");
    include('pending_book_requests.php');
} else if ($action == "book_requests") {
    $result = fetch_pending_book_requests();
    if (!$result)
        die("Грешка!");
    if (isset($_POST['l_grant'])) {
        $message = grant_book_requests($result);
    } else if (isset($_POST['l_reject'])) {
        $message = reject_book_requests($result);
    }

    switch ($message) {
        case "BOOK CAN NOT BE ISSUED":
            $book_requests_error = "Книгата не може да се позајми!";
            include('pending_book_requests.php');
            break;
        case "NOTHING SELECTED":
            $book_requests_error = "Ве молиме одберете барање.";
            include('pending_book_requests.php');
            break;
        case "ERROR":
            $book_requests_error = "Грешка!";
            include('pending_book_requests.php');
            break;
        default:
            $book_requests_error = $message;
            $result = fetch_pending_book_requests();
            if (!$result)
                die("Грешка!");
            include('pending_book_requests.php');
            break;
    }
} else if ($action == "pending_registrations_view") {
    $result = fetch_pending_registrations();
    if (!$result)
        die("Грешка!");
    include('pending_registrations.php');
} else if ($action == "registration_requests") {
    global $registration_error;
    $result = fetch_pending_registrations();
    if (!$result)
        die("Грешка!");
    if (isset($_POST['l_confirm'])) {
        $message = confirm_registrations($result);
    } else if (isset($_POST['l_delete'])) {
        $message = delete_registrations($result);
    }
    switch ($message) {
        case "NOTHING SELECTED":
            $registration_error = "Ве молиме одберете барање.";
            include('pending_registrations.php');
            break;
        case "ERROR":
            $registration_error = "Грешка!";
            include('pending_registrations.php');
            break;
        default:
            $registration_error = $message;
            $result = fetch_pending_registrations();
            if (!$result)
                die("Грешка!");
            include('pending_registrations.php');
            break;
    }
}
