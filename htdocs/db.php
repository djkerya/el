<?php
$db = mysqli_connect('localhost','el','el','el');
if (mysqli_connect_errno()) {
 echo 'DB connection error: '.mysqli_connect_errno().'  '.mysqli_connect_error();
 exit();
}
mysqli_query($db,"SET NAMES 'utf-8' ");

require 'rb.php';
R::setup('mysql:host=localhost;dbname=el',
    'el','el' );

session_start();
?>