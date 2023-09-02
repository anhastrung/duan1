<?php
require "../../connect.php";
$VIEW_NAME = "home";
if (isset($_GET['site'])) {
    if ($_GET['site'] == "delete") {
        $id = $_GET['id'];
        $sql = "DELETE FROM product WHERE id_product = $id";
        $connect->exec($sql);
        header("location:?list");
    }
    $VIEW_NAME = $_GET['site'];
}
$sql = "SELECT name_category, COUNT(id_product) as soluong, MAX(price_product) as caonhat, MIN(price_product) as thapnhat, AVG(price_product) as trungbinh FROM product inner JOIN category on product.id_category = category.id_category GROUP BY product.id_category";
$listTK = $connect->query($sql)->fetchAll();
require "../layout.php";