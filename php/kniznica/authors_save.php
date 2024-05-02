<?php
session_start();
include_once 'inc/config.php';
include_once 'inc/functions.php';
// vyberieme meno z pola
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$meno = isset($_POST['meno']) ? checkDBInput($_POST['meno']) : NULL;
$priezvisko = isset($_POST['priezvisko']) ? checkDBInput($_POST['priezvisko']) : NULL;
// spracovanie udajov z postu
if($meno && $priezvisko){
    if($id){
        $sql = "UPDATE authors SET first_name = '$meno', last_name = '$priezvisko' WHERE id = '$id'";
        if (mysqli_query($conn, $sql)) 
            $_SESSION['authors_save'] = "4";
        else 
            $_SESSION['authors_save'] = "5";
    }
else{
$sql = "INSERT INTO authors (first_name, last_name)
VALUES ('$meno', '$priezvisko')";
if (mysqli_query($conn, $sql)) 
    $_SESSION['authors_save'] = "1";
    else 
    $_SESSION['authors_save'] = "2";
}}
else
$_SESSION['authors_save'] = "3";

header("location: authors.php");