<?php
require "../../connect.php";
$VIEW_NAME = "list";
if (isset($_GET['site'])) {
    $VIEW_NAME = $_GET['site'];
}
require "../layout.php";
