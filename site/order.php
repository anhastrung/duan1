<?php
session_start();
require "../connect.php";
if (isset($_SESSION['user'])) {
    extract($_SESSION['user']);
    try {
        $sql = "SELECT * FROM hoadon where email = '$email'";
        $run = $connect->prepare($sql);
        $run->execute();
        $user = $run->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    }
}
?>

<!doctype html>
<!-- 
Template Name: Shopmartio - Responsive HTML Template 
Version: 1.0.0
Author: Kamleshyadav
Website: 
Purchase: 
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- Begin Head -->

<!-- Mirrored from kamleshyadav.com/html/shopmartio/html/Bootstrap5/order.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Jul 2023 16:45:27 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="We design best Multipurpose HTML Website Template for any online shop, online store, shopping, fashion, accessories, shoes, bags, t-shirts, electronics, furniture, christmas, ecommerce html template">
    <meta name="keywords" content="business, multipurpose, multipurpose html website template, online shop, online store, shopping, fashion, accessories, shoes, bags, t-shirts, electronics, furniture, christmas, ecommerce html template">
    <meta name="author" content="kamleshyadav">
    <meta name="MobileOptimized" content="320">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/font.css">
    <link rel="stylesheet" href="assets/css/comman.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Favicon Link -->
    <link rel="shortcut icon" type="image/png" href="assets/images/index1/favicon.png">
    <title>Shopmartio - Multipurpose eCommerce Responsive HTML Website Template</title>
</head>

<body>
    <!-- main-wrapper start -->
    <div class="main-wrapper">
        <!-- Preloader Box -->
        <div class="preloader-wrapper preloader-active preloader-open">
            <div class="preloader-holder">
                <div class="preloader d-flex justify-content-center align-items-center h-100">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

        <div class="e-breadcumb-wrap text-center">
            <h2 class="e-breadcumb-title">My Account</h2>
        </div>
        <!-- My account start -->
        <div class="e-myaccount-wrap mb-80">
            <div class="container-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="e-ma-details">
                            <div class="e-mad-orderdeatils">
                                <div class="shopcart-table-wrap">
                                    <form class="table-responsive">
                                        <table class="shopcart-table">
                                            <thead>
                                                <tr>
                                                    <th>Họ và tên</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Email</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Đơn giá</th>
                                                    <th>Ngày mua</th>
                                                    <th>Phương thức thanh toán</th>
                                                    <th>Tình trạng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($user as $us) { ?>
                                                    <tr>
                                                        <td><?= $us['fullname'] ?></td>
                                                        <td><?= $us['location'] ?></td>
                                                        <td><?= $us['email'] ?></td>
                                                        <td><?= $us['phone'] ?></td>
                                                        <td><?= $us['dongia'] ?></td>
                                                        <td><?= $us['ngaymua'] ?></td>
                                                        <td><?php if ($us['thanhtoan'] == 'truc_tiep') {
                                                                echo "Đã thanh toán";
                                                            } else {
                                                                echo "Thanh toán khi nhận hàng";
                                                            } ?></td>
                                                        <td><span class="sc-product-prc">
                                                                <?= ($us['trang_thai'] == 0) ? ("Đang chờ xác nhận") : (($us['trang_thai'] == 1) ? ("Đã xác nhận") : (($us['trang_thai'] == 1) ? "Đang giao" :  "Đã giao")) ?>
                                                            </span></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- main-wrapper End -->

    <!-- sidebar cart start -->



    <!-- Login form start -->
    <!-- The Modal -->

    <!-- Register form start -->
    <!-- The Modal -->


    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/SmoothScroll.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

<!-- Mirrored from kamleshyadav.com/html/shopmartio/html/Bootstrap5/order.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Jul 2023 16:45:27 GMT -->

</html>