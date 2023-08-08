<?php
require "../../connect.php";
$VIEW_NAME = "list";
if (isset($_GET['site'])) {
    if ($_GET['site'] == "sua") {
        $id = $_GET['id'];
        $trang_thai=$_GET['tt'];
        $sql = "UPDATE  hoadon set UPDATE user SET trang_thai=$trang_thai WHERE id_hoadon = $id";
        $connect->exec($sql);
        header("location:?list");
    }
    $VIEW_NAME = $_GET['site'];
}
require "../layout.php";