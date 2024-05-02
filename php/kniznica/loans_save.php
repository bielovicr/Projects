<?php
include_once 'inc/config.php';
include_once 'inc/functions.php';

// vyberieme meno z pola
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : NULL;
$book_printout_ids = isset($_POST['book_printout_id']) ? $_POST['book_printout_id'] : array();
$books = array();
foreach($book_printout_ids as $book_printout_id)
{
    $book_printout_id = intval($book_printout_id);
    if($book_printout_id) // ci je vacsie ako 0
    {
        $books[] = $book_printout_id;

    }
    
}
if($books && $user_id)
{
    $sql = "INSERT INTO book_loans VALUES (NULL, NOW(), $user_id, NOW(), NULL)";
    $result = mysqli_query($conn, $sql);
    $last_id = mysqli_insert_id($conn);
    if($result)
    {
        foreach($books as $book){
        $sql = "INSERT INTO book_loan_book_printout VALUES('$last_id', '$book', NULL, NOW(), NULL)";
        mysqli_query($conn, $sql);
    }
}
}

header("location: loans.php");