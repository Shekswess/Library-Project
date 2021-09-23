<?php

function update_balance($member_username, $balance)
{
    global $con;
    $query = $con->prepare("SELECT username FROM member WHERE username=?;");
    $query->bind_param("s", $member_username);
    $query->execute();
    if (mysqli_num_rows($query->get_result()) != 1)
        return "INVALID USERNAME";
    else {
        $query = $con->prepare("UPDATE member SET balance=balance+? WHERE username=?;");
        $query->bind_param("ds", $balance, $member_username);
        if (!$query->execute())
            return "ERROR";
        return "SUCCESS";
    }
}
function fetch_pending_book_requests()
{
    global $con;
    $query = $con->prepare("SELECT * FROM pending_book_requests;");
    $query->execute();
    $result = $query->get_result();
    return $result;
}
function grant_book_requests($result)
{
    global $con;
    $header = 'From: <noreply@library.com>' . "\r\n";
    $requests = 0;
    foreach ($result as $res) {
        if (isset($_POST['cd_' . $res['request_id']])) {
            $request_id =  $res['request_id'];

            $query = $con->prepare("SELECT member, book_isbn FROM pending_book_requests WHERE request_id = ?;");
            $query->bind_param("d", $request_id);
            $query->execute();
            $row = mysqli_fetch_array($query->get_result());
            $member = $row[0];
            $isbn = $row[1];

            $query = $con->prepare("INSERT INTO book_issue_log(member, book_isbn) VALUES(?, ?);");
            $query->bind_param("ss", $member, $isbn);
            if (!$query->execute())
                return "BOOK CAN NOT BE ISSUED";
            $requests++;

            $query = $con->prepare("SELECT email FROM member WHERE username = ?;");
            $query->bind_param("s", $member);
            $query->execute();
            $to = mysqli_fetch_array($query->get_result())[0];
            $subject = "Книгата Ви е успешно позајмена!";

            $query = $con->prepare("SELECT title FROM book WHERE isbn = ?;");
            $query->bind_param("s", $isbn);
            $query->execute();
            $title = mysqli_fetch_array($query->get_result())[0];

            $query = $con->prepare("SELECT due_date FROM book_issue_log WHERE member = ? AND book_isbn = ?;");
            $query->bind_param("ss", $member, $isbn);
            $query->execute();
            $due_date = mysqli_fetch_array($query->get_result())[0];
            $message = "Книгата '" . $title . "' со ISBN " . $isbn . " Ви е успешно позајмена. Крајниот рок за враќање на книгата е " . $due_date . ".";

            mail($to, $subject, $message, $header);
        }
    }
    if ($requests > 0)
        return $requests;
    else
        return "NOTHING SELECTED";
}
function reject_book_requests($result)
{
    global $con;
    $header = 'From: <noreply@library.com>' . "\r\n";
    $requests = 0;
    foreach ($result as $res) {
        if (isset($_POST['cd_' . $res['request_id']])) {
            $request_id =  $res['request_id'];

            $query = $con->prepare("SELECT member, book_isbn FROM pending_book_requests WHERE request_id = ?;");
            $query->bind_param("d", $request_id);
            $query->execute();
            $row = mysqli_fetch_array($query->get_result());
            $member = $row[0];
            $isbn = $row[1];

            $query = $con->prepare("SELECT email FROM member WHERE username = ?;");
            $query->bind_param("s", $member);
            $query->execute();
            $to = mysqli_fetch_array($query->get_result())[0];
            $subject = "Одбиено барање за позајмување на книга!";

            $query = $con->prepare("SELECT title FROM book WHERE isbn = ?;");
            $query->bind_param("s", $isbn);
            $query->execute();
            $title = mysqli_fetch_array($query->get_result())[0];
            $message = "Вашето барање за позајмување на книгата '" . $title . "' со ISBN " . $isbn . " е одбиено.";

            $query = $con->prepare("DELETE FROM pending_book_requests WHERE request_id = ?");
            $query->bind_param("d", $request_id);
            if (!$query->execute())
                return "ERROR";
            $requests++;
            mail($to, $subject, $message, $header);
        }
    }
    if ($requests > 0)
        return $requests;
    else
        return "NOTHING SELECTED";
}

function fetch_pending_registrations()
{
    global $con;
    $query = $con->prepare("SELECT username, name, email, balance FROM pending_registrations");
    $query->execute();
    $result = $query->get_result();
    return $result;
}

function confirm_registrations($result)
{
    global $con;
    $header = 'From: <noreply@library.com>' . "\r\n";
    $members = 0;
    foreach ($result as $res) {
        if (isset($_POST['cd_' . $res['username']])) {
            $username =  $res['username'];

            $query = $con->prepare("SELECT * FROM pending_registrations WHERE username = ?;");
            $query->bind_param("s", $username);
            $query->execute();
            $row = mysqli_fetch_array($query->get_result());

            $query = $con->prepare("INSERT INTO member(username, password, name, email, balance) VALUES(?, ?, ?, ?, ?);");
            $query->bind_param("ssssd", $username, $row[1], $row[2], $row[3], $row[4]);
            if (!$query->execute())
                return "ERROR";
            $members++;

            $to = $row[3];
            $subject = "Успешна регистрација!";
            $message = "Вашето барање за регистрација е одобрено.";
            mail($to, $subject, $message, $header);
        }
    }
    if ($members > 0)
        return $members;
    else
        return "NOTHING SELECTED";
}

function delete_registrations($result)
{
    global $con;
    $header = 'From: <noreply@library.com>' . "\r\n";
    $requests = 0;
    foreach ($result as $res) {
        if (isset($_POST['cd_' . $res['username']])) {
            $username =  $res['username'];

            $query = $con->prepare("SELECT email FROM pending_registrations WHERE username = ?;");
            $query->bind_param("s", $username);
            $query->execute();
            $email = mysqli_fetch_array($query->get_result())[0];

            $query = $con->prepare("DELETE FROM pending_registrations WHERE username = ?;");
            $query->bind_param("s", $username);
            if (!$query->execute())
                return "ERROR";
            $requests++;

            $to = $email;
            $subject = "Неуспешна регистрација";
            $message = "Вашето барање за регистрација е одбиено.";
            mail($to, $subject, $message, $header);
        }
    }
    if ($requests > 0)
        return $requests;
    else
        return "NOTHING SELECTED";
}
