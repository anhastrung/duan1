<?php
session_start();
if (isset($_SESSION['user'])) {
  extract($_SESSION['user']);
}
if (!$role == "1") {
  header("location:../../");
}
$limitPage = 9;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 0;
}
$productPage = $page * $limitPage;
$url = $_SERVER['REQUEST_URI'];
$accept = [
  "image/png",
  "image/jpeg",
  "image/jpg",
  "image/gif",
];
?>
<!DOCTYPE html>
<html lang="en">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IVYmoda Admin</title>
  <link href="../style.css" rel="stylesheet">
  <link href="../checkbox.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-light flex justify-start">
  <div class="sidebar sidebar-dark h-[200%]" id="sidebar">
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-item">
        <a class="nav-link" href="../../site/">
          <svg class="nav-icon"></svg> Trang chủ
        </a>
      </li>
      <li class="nav-title">Admin</li>
      <li class="nav-item">
        <a class="nav-link" href="../category">
          <svg class="nav-icon"></svg> Category
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../product">
          <svg class="nav-icon"></svg> Product
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../user">
          <svg class="nav-icon"></svg> User
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../comment">
          <svg class="nav-icon"></svg> Comment
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../delivery">
          <svg class="nav-icon"></svg> Delivery check
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../thong-ke">
          <svg class="nav-icon"></svg> Thống Kê
        </a>
      </li>
    </ul>
  </div>
  <div class="w-full p-8">
    <?php require $VIEW_NAME . ".php" ?>
  </div>
</body>

</html>