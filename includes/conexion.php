<?php
//conexion
$server = 'localhost';
$username = 'root';
$pasword = '';
$database = 'mi_blog';

$db = mysqli_connect($server, $username, $pasword, $database);
mysqli_query($db, "SET NAMES 'utf8'");

//Start session
if(!isset($_SESSION)) {
    session_start();
}