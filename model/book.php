<?php
class Book
{
  public $book_isbn;
  public $book_title;
  public $book_author;
  public $book_cathegory;
  public $book_price;
  public $book_copies;
  public $book_cover;

  public function __construct($book_isbn, $book_title, $book_author, $book_cathegory, $book_price, $book_copies, $book_cover)
  {
    $this->book_isbn = $book_isbn;
    $this->book_title = $book_title;
    $this->book_author = $book_author;
    $this->book_cathegory = $book_cathegory;
    $this->book_price = $book_price;
    $this->book_copies = $book_copies;
    $this->book_cover = $book_cover;
  }
  function set_isbn($book_isbn)
  {
    $this->book_isbn = $book_isbn;
  }
  function get_isbn()
  {
    return $this->book_isbn;
  }
  function set_title($book_title)
  {
    $this->book_title = $book_title;
  }
  function get_title()
  {
    return $this->book_title;
  }
  function set_author($book_author)
  {
    $this->book_author = $book_author;
  }
  function get_author()
  {
    return $this->book_author;
  }
  function set_cathegory($book_cathegory)
  {
    $this->book_cathegory = $book_cathegory;
  }
  function get_cathegory()
  {
    return $this->book_cathegory;
  }
  function set_price($book_price)
  {
    $this->book_price = $book_price;
  }
  function get_price()
  {
    return $this->book_price;
  }
  function set_copies($book_copies)
  {
    $this->book_copies = $book_copies;
  }
  function get_copies()
  {
    return $this->book_copies;
  }
  function set_cover($book_cover)
  {
    $this->book_cover = $book_cover;
  }
  function get_cover()
  {
    return $this->book_cover;
  }
}
