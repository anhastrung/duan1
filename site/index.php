<?php
session_start();
if (isset($_SESSION['user'])) {
    extract($_SESSION['user']);
}
require "../connect.php";
$VIEW_NAME = "home";
if (isset($_GET['site'])) {
    $VIEW_NAME = $_GET['site'];
}
require "./layout.php";