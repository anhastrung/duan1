<?php
require "../../connect.php";
$VIEW_NAME = "list";
if (isset($_GET['site'])) {
    if ($_GET['site'] == "delete") {
        $id = $_GET['id'];
        $sql = "DELETE FROM comment WHERE id_comment = $id";
        $connect->exec($sql);
        header("location:?list");
    }
    $VIEW_NAME = $_GET['site'];
}
require "../layout.php";