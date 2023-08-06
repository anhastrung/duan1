<?php
session_start();
if (isset($_SESSION['user'])) {
    extract($_SESSION['user']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>San Pham Chi Tiet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            font-family: sans-serif;
        }

        .content-right-suppost {
            cursor: pointer;
            max-height: 29px;
            overflow: hidden;
            transition: all 0.5s;
        }

        .content-right-suppost-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-right-suppost-flex:hover p {
            color: red;
        }

        .content-right-suppost-flex p {
            font-weight: 700;
        }

        .content-right-suppost-flex {
            transition: all 0.5s;
        }

        .content-right-suppost button {
            border: none;
            background: red;
            width: 180px;
            height: 36px;
            color: white;
        }

        .toggle {
            max-height: 1000px;
        }

        .rotate {
            transform: rotate(180deg);
            transition: all 0.5s;
        }

        .cart {
            padding: 100px 50px;
        }

        .cart-top-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cart-top {
            height: 2px;
            width: 70%;
            background-color: #dddddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 50px 0 100px;
        }

        .cart-top-item {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
        }

        .cart-top-cart {
            border: 1px solid #0db7ea;
        }

        .cart-top-cart i {
            color: #0db7ea;
        }

        .cart-content-left {
            flex: 2;
            padding-right: 12px;
        }

        .cart-content-left table {
            width: 100%;
            align-items: center;
        }

        .cart-content-left table th {
            padding-bottom: 30px;
            font-size: 12px;
            text-transform: uppercase;
            color: #333;
            border-collapse: collapse;
            border-bottom: 2px solid #dddddd;
        }

        .cart-content-left table p {
            font-size: 12px;
        }

        .cart-content-left table input {
            width: 30px;
        }

        .cart-content-left td:first-child img {
            width: 130px;
        }

        .cart-content-left td:nth-child(2) {
            max-width: 130px;
        }

        .cart-content-left td:nth-child(3) img {
            width: 30px;
        }

        .cart-content-right {
            flex: 1;
            padding-left: 12px;
            border-left: 2px solid #dddddd;
        }

        .cart-content-right table {
            width: 100%;
        }

        .cart-content-right table th {
            padding-bottom: 30px;
            font-size: 12px;
            color: #333;
            border-collapse: collapse;
            border-bottom: 2px solid #dddddd;
        }

        .cart-content-right table td {
            font-size: 12px;
            color: #333;
            padding: 6px 0;
        }

        .cart-content-right tr:nth-child(4) td {
            border-top: 2px solid #dddddd;
        }

        .cart-content-right tr td:last-child {
            text-align: right;
        }

        .cart-content-right-text {
            margin: 20px 0;
            text-align: center;
        }

        .cart-content-right-text p {
            font-size: 12px;
            color: #333;
        }

        .cart-content-right-button {
            text-align: center;
            align-items: center;
        }

        .cart-content-right-button button {
            padding: 0 18px;
            height: 35px;
            cursor: pointer;
        }

        .cart-content-right-button button:first-child {
            background-color: #fff;
            border: 2px solid black;
            margin-right: 20px;
        }

        .cart-content-right-button button:first-child:hover {
            background-color: #dddddd;
        }

        .cart-content-right-button button:last-child {
            background-color: #000;
            color: white;
            border: none;
            border: 1px solid black;
        }

        .cart-content-right-button button:last-child:hover {
            background-color: #fff;
            color: #333;
        }

        .cart-content-right-dangnhap {
            margin-top: 20px;
        }

        .cart-content-right-dangnhap p {
            font-size: 12px;
            color: #333;
        }

        .cart-content-right-dangnhap p a {
            color: red;
        }

        .cart-content-right-dangnhap p:last-child {
            margin-left: 20px;
        }

        .cart-content-left table span {
            display: block;
            width: 20px;
            height: 20px;
            border: 1px solid #dddddd;
            text-align: center;
            cursor: pointer;
        }

        .cart-content-left table td {
            padding: 20px 0;
            border-bottom: 2px solid #dddddd;
        }
    </style>
</head>

<body>
    <div class="container w-[1440x] m-auto">
        <header class="mb-[32px]">
            <?php require "./layout/header.php" ?>
        </header>
        <div class="content">
            <section class="cart">
                <div class="container">
                    <div class="cart-top-wrap">
                        <div class="cart-top">
                            <div class="cart-top-cart cart-top-item">
                                <i class="fa-solid fa-cart-shopping "></i>
                            </div>
                            <div class="cart-top-adress cart-top-item"><i class="fa-solid fa-location-dot"></i></div>
                            <div class="cart-top-payment cart-top-item">
                                <i class="fa-solid fa-money-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="cart-content row">
                        <div class="cart-content-left">
                            <table>
                                <tr>
                                    <th class="w-[calc(100%/7)] text-left">Sản phẩm</th>
                                    <th class="w-[calc(100%/7)] text-left">Tên sản phẩm</th>
                                    <th class="w-[calc(100%/7)] text-left">Màu </th>
                                    <th class="w-[calc(100%/7)] text-left">Size</th>
                                    <th class="w-[calc(100%/7)] text-left">SL</th>
                                    <th class="w-[calc(100%/7)] text-left">Thành tiền</th>
                                    <th class="w-[calc(100%/7)] text-left">Xóa</th>
                                </tr>
                                <?php
                                if (isset($_SESSION['user'])) {
                                    $sql = "select img, name_product, cart.id_product, COUNT(cart.id_product) as sl, price_product from product inner join cart on product.id_product = cart.id_product where id_user = $id_user group by cart.id_product";
                                    $listProduct = $connect->query($sql)->fetchAll();
                                    $tong = 0;
                                    foreach ($listProduct as $li) { ?>
                                        <tr>
                                            <td class="w-[calc(100%/7)]"><img src="../upload/<?= $li['img'] ?>" alt=""></td>
                                            <td class="w-[calc(100%/7)]">
                                                <p><?= $li['name_product'] ?></p>
                                            </td>
                                            <td class="w-[calc(100%/7)]"><img src="https://pubcdn2.ivymoda.com/images/color/012.png" alt=""></td>
                                            <td class="w-[calc(100%/7)]">
                                                <p>L</p>
                                            </td>
                                            <td class="w-[calc(100%/7)]">
                                                <p><?= $li['sl'] ?></p>
                                            </td>
                                            <td class="w-[calc(100%/7)]"><?= $li['price_product'] * $li['sl'] ?><sup>đ</sup></td>
                                            <td class="w-[calc(100%/7)]">
                                                <?php
                                                if (isset($_POST['delete-product'])) {
                                                    $id_product = $li['id_product'];
                                                    $sql = "DELETE FROM cart WHERE id_product = $id_product and id_user = $id_user";
                                                    $connect->exec($sql);
                                                }
                                                ?>
                                                <form action="" method="post">
                                                    <button name="delete-product" onclick="return confirm('chắc chưa')">X</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                        $tong = $tong + $li['price_product'] * $li['sl'];
                                    }
                                } else {
                                    if (isset($_SESSION['product'])) {
                                        $tong = 0;
                                        $i = 1;
                                        foreach ($_SESSION['product'] as $li) {
                                            $id_product = $li['id_product'];
                                            $sql = "select * from product where id_product = $id_product";
                                            $product = $connect->query($sql)->fetch();
                                        ?>
                                            <tr>
                                                <td class="w-[calc(100%/7)]"><img src="../upload/<?= $product['img'] ?>" alt=""></td>
                                                <td class="w-[calc(100%/7)]">
                                                    <p><?= $product['name_product'] ?></p>
                                                </td>
                                                <td class="w-[calc(100%/7)]"><img src="https://pubcdn2.ivymoda.com/images/color/012.png" alt=""></td>
                                                <td class="w-[calc(100%/7)]">
                                                    <p>L</p>
                                                </td>
                                                <td class="w-[calc(100%/7)]">
                                                    <p><?= $li['number_product'] ?></p>
                                                </td>
                                                <td class="w-[calc(100%/7)]"><?= $product['price_product'] * $li['number_product'] ?><sup>đ</sup></td>
                                                <td class="w-[calc(100%/7)]">
                                                    <?php
                                                    if (isset($_POST['delete-product'])) {
                                                        array_splice($_SESSION['product'], $i, 1);
                                                    }
                                                    ?>
                                                    <form action="" method="post">
                                                        <button name="delete-product" onclick="return confirm('chắc chưa')">X</button>
                                                    </form>
                                                </td>
                                            </tr>
                                <?php
                                            $tong = $tong + $product['price_product'] * $li['number_product'];
                                            $i++;
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <div class="cart-content-right">
                            <table>
                                <tr>
                                    <th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
                                </tr>
                                <tr>
                                    <td>TỔNG SẢN PHẨM</td>
                                    <td><?php if (isset($_SESSION['user'])) {
                                            echo count($listProduct);
                                        } else if (isset($_SESSION['product'])) {
                                            echo count($_SESSION['product']);
                                        } else {
                                            echo 0;
                                        } ?></td>
                                </tr>
                                <tr>
                                    <td>TỔNG TIỀN HÀNG</td>
                                    <td><?= $tong ?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td>TẠM TÍNH</td>
                                    <td>
                                        <p style="color: black;font-weight: bold;"><?= $tong ?><sup>đ</sup></p>
                                    </td>
                                </tr>
                            </table>
                            <div class="cart-content-right-text <?php if ($tong >= 2000000) echo "hidden" ?>">
                                <p>Miễn phí ship đơn hàng có tổng gía trị trên 2.000.000VND</p>
                                <p style="color: red;font-weight: bold;">Mua thêm <span style="font-style: 15px;"><?= number_format(2000000 - $tong) ?></span> để được miễn phí SHIP</p>
                            </div>
                            <div class="cart-content-right-button">
                                <button>TIẾP TỤC MUA SẮM</button>
                                <button>THANH TOÁN</button>
                            </div>
                            <div class="cart-content-right-dangnhap">
                                <p>TÀI KHOÀN IVY</p>
                                <p>Hãy <a href="">Đăng nhập</a> Kim với số đăng ký kinh doanh</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- -------------------------------------------------------------------------- -->
        <footer class="mt-[120px]">
            <?php require "./layout/footer.php" ?>
        </footer>
        <script>
            let minus = document.querySelector(".minus");
            let value = document.querySelector(".value");
            let plus = document.querySelector(".plus");
            minus.addEventListener("click", function() {
                if (Number(value.value) == 1) {
                    value.value = 1
                } else {
                    value.value = Number(value.value) - 1
                }
            })
            plus.addEventListener("click", function() {
                value.value = Number(value.value) + 1
            })
            let desall = document.querySelectorAll(".content-right-suppost");
            let check = document.querySelectorAll(".fa-chevron-down");
            desall.forEach((item, index) => {
                return item.addEventListener("click", function() {
                    check[index].classList.toggle("rotate");
                    item.classList.toggle("toggle");
                });
            });
        </script>
</body>

</html>