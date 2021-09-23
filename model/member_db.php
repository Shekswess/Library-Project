<?php

function request_book($isbn, $username)
{
    global $con;
    $query = $con->prepare("SELECT copies FROM book WHERE isbn = ?;");
    $query->bind_param("s", $isbn);
    $query->execute();
    $copies = mysqli_fetch_array($query->get_result())[0];
    if ($copies == 0)
        return "NO COPIES";
    else {
        $query = $con->prepare("SELECT request_id FROM pending_book_requests WHERE member = ?;");
        $query->bind_param("s", $username);
        $query->execute();
        if (mysqli_num_rows($query->get_result()) == 1)
            return "TOO MANY REQUESTS";
        else {
            $query = $con->prepare("SELECT book_isbn FROM book_issue_log WHERE member = ?;");
            $query->bind_param("s", $username);
            $query->execute();
            $result = $query->get_result();
            if (mysqli_num_rows($result) >= 3)
                return "TOO MANY BOOKS";
            else {
                $rows = mysqli_num_rows($result);
                for ($i = 0; $i < $rows; $i++)
                    if (strcmp(mysqli_fetch_array($result)[0], $isbn) == 0)
                        break;
                if ($i < $rows)
                    return "BOOK EXISTS";
                else {
                    $query = $con->prepare("SELECT balance FROM member WHERE username = ?;");
                    $query->bind_param("s", $username);
                    $query->execute();
                    $memberBalance = mysqli_fetch_array($query->get_result())[0];

                    $query = $con->prepare("SELECT price FROM book WHERE isbn = ?;");
                    $query->bind_param("s", $isbn);
                    $query->execute();
                    $bookPrice = mysqli_fetch_array($query->get_result())[0];
                    if ($memberBalance < $bookPrice)
                        return "BALANCE";
                    else {
                        $query = $con->prepare("INSERT INTO pending_book_requests(member, book_isbn) VALUES(?, ?);");
                        $query->bind_param("ss", $username, $isbn);
                        if (!$query->execute())
                            return "ERROR";
                        else
                            return "SUCCESS";
                    }
                }
            }
        }
    }
}

function register($member)
{
    global $con;
    $name = $member->get_name();
    $email = $member->get_email();
    $username = $member->get_username();
    $password = $member->get_password();
    $balance = $member->get_balance();

    if ($balance < 500)
        return "LOW BALANCE";
    else {
        $query = $con->prepare("(SELECT username FROM member WHERE username = ?) UNION (SELECT username FROM pending_registrations WHERE username = ?);");
        $query->bind_param("ss", $username, $username);
        $query->execute();
        if (mysqli_num_rows($query->get_result()) != 0)
            return "USERNAME EXISTS";
        else {
            $query = $con->prepare("(SELECT email FROM member WHERE email = ?) UNION (SELECT email FROM pending_registrations WHERE email = ?);");
            $query->bind_param("ss", $email, $email);
            $query->execute();
            if (mysqli_num_rows($query->get_result()) != 0)
                return "EMAIL EXISTS";
            else {
                $query = $con->prepare("INSERT INTO pending_registrations(username, password, name, email, balance) VALUES(?, ?, ?, ?, ?);");
                $password = sha1($password);
                $query->bind_param("ssssd", $username, $password, $name, $email, $balance);
                if ($query->execute())
                    return "SUCCESS";
                else
                    return "ERROR";
            }
        }
    }
}

function get_my_books($username)
{
    global $con;
    $query = $con->prepare("SELECT book_isbn FROM book_issue_log WHERE member = ?;");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();
    return $result;
}

function get_due_date($username, $isbn)
{
    global $con;
    $query = $con->prepare("SELECT due_date FROM book_issue_log WHERE member = ? AND book_isbn = ?;");
    $query->bind_param("ss", $username, $isbn);
    $query->execute();
    return mysqli_fetch_array($query->get_result())[0];
}

function return_books($result)
{
    global $con;
    $books = 0;
    foreach ($result as $res) {
        if (isset($_POST['cd_' . $res['book_isbn']])) {
            $query = $con->prepare("DELETE FROM book_issue_log WHERE member = ? AND book_isbn = ?;");
            $query->bind_param("ss", $_SESSION['username'], $_POST['cd_' . $res['book_isbn']]);
            if (!$query->execute())
                return "ERROR";

            $books++;
        }
        if ($books > 0) {
            return $books;
        } else
            return "NOTHING SELECTED";
    }
}
