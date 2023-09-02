<?php ob_start();
if (isset($_SESSION['user'])) { ?>
    <div class="content">
        <?php if (empty($listProduct)) { ?>
            <p class="text-2xl text-red-500 font-bold">Giỏ hàng trống, vui lòng mua thêm hàng để thanh toán</p>
        <?php } else { ?>
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
                                    <th class="w-[calc(100%/7)] text-left">Size</th>
                                    <th class="w-[calc(100%/7)] text-left">SL</th>
                                    <th class="w-[calc(100%/7)] text-left">Giá sản phẩm</th>
                                    <th class="w-[calc(100%/7)] text-left">Tổng tiền</th>
                                    <th class="w-[calc(100%/7)] text-left">Xóa</th>
                                </tr>
                                <?php
                                foreach ($listProduct as $li) { ?>
                                    <tr>
                                        <td class="w-[calc(100%/7)]"><img src="../upload/<?= $li['img'] ?>" alt=""></td>
                                        <td class="w-[calc(100%/7)]">
                                            <p><?= $li['name_product'] ?></p>
                                        </td>
                                        <td class="w-[calc(100%/7)]">
                                            <p>L</p>
                                        </td>
                                        <td class="w-[calc(100%/7)]">
                                            <?php
                                            if (isset($_POST['number_product'])) {
                                                $queryId = $_POST['id_cart'];
                                                $number = $_POST['number_product'];
                                                // echo $queryId." - ".$number;
                                                $sql = "UPDATE cart SET number = '$number' WHERE cart.id_cart = $queryId";
                                                $connect->exec($sql);
                                                header("location:?site=cart");
                                            }
                                            ?>
                                            <form action="" method="post" class="h-[36px] w-[78px] border border-[grey] flex items-center justify-center">
                                                <input type="text" name="id_cart" value="<?= $li['id_cart'] ?>" hidden>
                                                <button class="minus pr-[8px] h-[100%] border-r-[1px] border-[grey]">-</button>
                                                <input class="value w-[20px] ml-[10px]" type="number" value="<?= $li["number"] ?>" name="number_product" min="1" max="<?= $li['number_product'] ?>" onchange="submit()">
                                                <button class="plus pl-[5px] h-[100%] border-l-[1px] border-[grey]">+</button>
                                            </form>
                                        </td>
                                        <td class="w-[calc(100%/7)]"><?= number_format($li['price_product']) ?><sup>đ</sup></td>
                                        <td class="w-[calc(100%/7)]"><?= number_format($li['price_product'] * $li['number']) ?><sup>đ</sup></td>
                                        <td class="w-[calc(100%/7)]">
                                            <?php
                                            if (isset($_POST['delete-product'])) {
                                                $id_cart = $_POST['delete-product'];
                                                $sql = "DELETE FROM cart WHERE `cart`.`id_cart` = $id_cart";
                                                $connect->exec($sql);
                                                header("location:?site=cart");
                                            }
                                            ?>
                                            <form action="" method="post">
                                                <button name="delete-product" value="<?= $li['id_cart'] ?>" onclick="return confirm('chắc chưa')">X</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
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
                                <button><a href="?site=home">TIẾP TỤC MUA SẮM</a></button>
                                <button><a href="?site=bill">THANH TOÁN</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </section>
    </div>
<?php } else { ?>
    <h2 class="text-red-500 text-3xl">Vui lòng đăng nhập</h2>
<?php }
ob_end_flush(); ?>