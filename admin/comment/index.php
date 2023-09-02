<?php
require "../../connect.php";
$VIEW_NAME = "listconfirm";
if (isset($_GET['site'])) {
    $VIEW_NAME = $_GET['site'];
}
require "../layout.php";
