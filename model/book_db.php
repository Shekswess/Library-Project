<?php
require_once("book.php");

function add_book($book)
{
    global $con;
    $book_isbn = $book->get_isbn();
    $book_title = $book->get_title();
    $book_author = $book->get_author();
    $book_cathegory = $book->get_cathegory();
    $book_price = $book->get_price();
    $book_copies = $book->get_copies();
    $book_cover = $book->get_cover();

    $query = $con->prepare("SELECT isbn FROM book WHERE isbn = ?;");
    $query->bind_param("s", $book_isbn);
    $query->execute();

    if (mysqli_num_rows($query->get_result()) != 0) {
        return "ISBN";
    } else {
        $imageFileType = strtolower(pathinfo($book_cover, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            return "EXTENSION";
        } else {
            if (strcmp($book_cover, "../covers/no_cover.jpg") == 0) {
                $query = $con->prepare("INSERT INTO book VALUES(?, ?, ?, ?, ?, ?, ?);");
                $query->bind_param("ssssdds", $book_isbn, $book_title, $book_author, $book_cathegory, $book_price, $book_copies, $book_cover);
                if (!$query->execute())
                    die();
                return "SUCCESS";
            } else if (strcmp($book_cover, "../covers/no_cover.jpg") != 0 && move_uploaded_file($_FILES["b_cover"]["tmp_name"], $book_cover)) {
                $query = $con->prepare("INSERT INTO book VALUES(?, ?, ?, ?, ?, ?, ?);");
                $query->bind_param("ssssdds", $book_isbn, $book_title, $book_author, $book_cathegory, $book_price, $book_copies, $book_cover);
                if (!$query->execute())
                    die();
                return "SUCCESS";
            } else {
                return "ERROR";
            }
        }
    }
}
function list_books()
{
    global $con;
    $query = $con->prepare("SELECT * FROM book ORDER BY title");
    $query->execute();
    $result = $query->get_result();
    return $result;
}
function delete_book($isbn)
{
    global $con;
    $query = "DELETE FROM book WHERE isbn=$isbn";
    $result = mysqli_query($con, $query);
    return $result;
}
function update_copies($isbn, $copies)
{
    global $con;
    $query = $con->prepare("SELECT isbn FROM book WHERE isbn=?;");
    $query->bind_param("s", $isbn);
    $query->execute();
    if (mysqli_num_rows($query->get_result()) != 1)
        return "ISBN";
    else {
        $query = $con->prepare("UPDATE book SET copies=copies+ ? WHERE isbn=?;");
        $query->bind_param("ds", $copies, $isbn);
        if (!$query->execute())
            return "ERROR";
        return "SUCCESS";
    }
}
function get_book_title($isbn)
{
    global $con;
    $query = $con->prepare("SELECT title FROM book WHERE isbn=?;");
    $query->bind_param("s", $isbn);
    $query->execute();
    $book_result = $query->get_result();
    $book_row = mysqli_fetch_array($book_result);
    return $book_row[0];
}
function get_book($isbn)
{
    global $con;
    $query = $con->prepare("SELECT title, author, category, bookCover FROM book WHERE isbn = ?;");
    $query->bind_param("s", $isbn);
    $query->execute();
    $result = mysqli_fetch_array($query->get_result());
    return $result;
}
