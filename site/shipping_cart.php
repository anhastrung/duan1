<?php
session_start();
require "../connect.php";
$gia = $_GET['tong'];
if (isset($_SESSION['user'])) {
    extract($_SESSION['user']);
    try {
        $sql = "SELECT * FROM user where email = '$email'";
        $run = $connect->prepare($sql);
        $run->execute();
        $user = $run->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    }
    try {
        $id = $user['id_user'];
        $sql = "SELECT c.id_product, c.id_user, p.name_product, p.price_product, p.sale_product, p.img, COUNT(c.id_product) as sl FROM cart c join user u on c.id_user=u.id_user join product p on c.id_product=p.id_product  where c.id_user = $id  group by c.id_product ";
        $run = $connect->prepare($sql);
        $run->execute();
        $cart = $run->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    }
}

if (isset($_POST['mua'])) {
    $id_product = rand(0, 999);
    $date = date('Y/m/d');
    $fullname = $_POST['fullname'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $thanh_toan = $_POST['payment'];

    if (empty($fullname)) {
        $error['fullname'] = "Vui lòng nhập họ và tên";
    }
    if (empty($location)) {
        $error['location'] = "Vui lòng nhập địa chỉ";
    }
    if (empty($phone)) {
        $error['phone'] = "Vui lòng nhập số điện thoại";
    }
    if (empty($email)) {
        $error['email'] = "Vui lòng nhập email";
    }
    if (empty($thanh_toan)) {
        $error['thanh_toan'] = "Vui lòng chọn phương thức thanh toán";
    }
    $sql = "INSERT INTO `hoadon` (`fullname`, `location`, `email`, `phone`, `dongia`, `ngaymua`, `thanhtoan`, `trang_thai`, `id_product`) VALUES ( '$fullname', '$location', '$email', '$phone', '$gia', '$date', '$thanh_toan', 0, '1212')";
    $run = $connect->prepare($sql);
    $run->execute();
    header("location:./index.php");
    die;
}

?>
<?php




?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="We design best Multipurpose HTML Website Template for any online shop, online store, shopping, fashion, accessories, shoes, bags, t-shirts, electronics, furniture, christmas, ecommerce html template">
    <meta name="keywords" content="business, multipurpose, multipurpose html website template, online shop, online store, shopping, fashion, accessories, shoes, bags, t-shirts, electronics, furniture, christmas, ecommerce html template">
    <meta name="author" content="kamleshyadav">
    <meta name="MobileOptimized" content="320">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/comman.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Favicon Link -->
    <link rel="shortcut icon" type="image/png" href="assets/images/index1/favicon.png">
    <title>Shopmartio - Multipurpose eCommerce Responsive HTML Website Template</title>
</head>

<body>
    <!-- main-wrapper start -->
    <div class="main-wrapper">
        <div class="e-breadcumb-wrap text-center">
            <h2 class="e-breadcumb-title">Đặt hàng</h2>
        </div>
        <!-- Product Category start -->
        <section class="e-checkout-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <form action="" method="post" class="e-checkout-sec mb-80">
                            <div class="">
                                <div class="cmn-ck-wrap mb-30">
                                    <div class="cmn-ck-header">
                                        <h2 class="cmn-ck-heading">Thông tin khách hàng</h2>
                                    </div>
                                    <div class="cmn-ck-body">
                                        <form method="post" class="cmn-ck-box mb-20">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="e-form-field mb-30">
                                                        <label>Họ và tên</label>
                                                        <input class="e-field-inner" name="fullname" type="text" value="<?= $user['fullname'] ?? "" ?>">
                                                        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['fullname'] ?? "" ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="e-form-field mb-30">
                                                        <label>Email</label>
                                                        <input class="e-field-inner" name="email" type="email" value="<?= $user['email'] ?? "" ?>">
                                                        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['email'] ?? "" ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="e-form-field mb-30">
                                                        <label>Số điện thoại</label>
                                                        <input class="e-field-inner" name="phone" type="text" value="<?= $user['phone'] ?? "" ?>">
                                                        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['phone'] ?? "" ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="e-form-field mb-30">
                                                        <label>Địa chỉ</label>
                                                        <input class="e-field-inner" name="location" type="text" value="<?= $user['location'] ?? "" ?>">
                                                        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['location'] ?? "" ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row"> -->
                                            <fieldset class="row" name="payment">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="mb-30">
                                                        <input type="radio" name="payment" id="payment2" value="nhan_hang" class="cstm-fileinput">
                                                        <label for="payment2" class="pay-checkbox">
                                                            <span>Thanh toán khi nhận hàng</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class=" mb-30">
                                                        <input type="radio" name="payment" id="payment1" value="truc_tiep" class="cstm-fileinput">
                                                        <label for="payment1" class="pay-checkbox">
                                                            <span>Trực tiếp</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['thanh_toan'] ?? "" ?></span>
                                            <button type="submit" name="mua" style="width: 100%;" class="e-btn">Mua hàng</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="e-shopcart-sidebar mb-80">
                            <div class="e-totalsumry mb-30">
                                <div class="e-totalsumry-header">
                                    <h2 class="e-totalsumry-ttl">Thông tin đơn hàng</h2>
                                </div>
                                <table style="width: 100%;">
                                    <thead>
                                        <tr class="e-totalsumry-list">
                                            <th>Ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cart as $car) : ?>
                                            <tr>
                                                <td><img src="../upload/<?= $car['img'] ?? "" ?>" alt="" style="width:40px; height:40px;"></td>
                                                <td><?= $car['name_product'] ?? "" ?></td>
                                                <td><?= $car['price_product'] ?? "" ?></td>
                                                <td><?= $car['sl'] ?? "" ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                <div class="e-totalsumry-fotr">
                                    <ul class="e-totalsumry-list total">
                                        <li>
                                            <span class="ts-list-head">Tổng tiền</span>
                                            <span class="ts-list-shead"><?= $gia ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



    </div>



    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/SmoothScroll.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

<!-- Mirrored from kamleshyadav.com/html/shopmartio/html/Bootstrap5/shipping_cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Jul 2023 16:45:26 GMT -->

</html>