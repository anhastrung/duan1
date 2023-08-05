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
                                    <th>Sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Màu </th>
                                    <th>Size</th>
                                    <th>SL</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa</th>
                                </tr>
                                <tr>
                                    <td><img src="https://pubcdn.ivymoda.com/files/product/thumab/400/2022/05/27/1b751da0513d24200158440a2f9513b4.JPG" alt=""></td>
                                    <td>
                                        <p>Áo Thun In Hình</p>
                                    </td>
                                    <td><img src="https://pubcdn2.ivymoda.com/images/color/012.png" alt=""></td>
                                    <td>
                                        <p>L</p>
                                    </td>
                                    <td><input type="number" value="1" min="1"></td>
                                    <td>490.000<sup>đ</sup></td>
                                    <td>
                                        <span>X</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://pubcdn.ivymoda.com/files/product/thumab/1400/2022/08/18/eb570a75a91e54af791507df19c488e4.JPG" alt=""></td>
                                    <td>
                                        <p>Áo Thun In Hình</p>
                                    </td>
                                    <td><img src="https://pubcdn2.ivymoda.com/images/color/009.png" alt=""></td>
                                    <td>
                                        <p>L</p>
                                    </td>
                                    <td><input type="number" value="1" min="1"></td>
                                    <td>490.000<sup>đ</sup></td>
                                    <td>
                                        <span>X</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="cart-content-right">
                            <table>
                                <tr>
                                    <th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
                                </tr>
                                <tr>
                                    <td>TỔNG SẢN PHẨM</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>TỔNG TIỀN HÀNG</td>
                                    <td>490.000<sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td>TẠM TÍNH</td>
                                    <td>
                                        <p style="color: black;font-weight: bold;">490.000<sup>đ</sup></p>
                                    </td>
                                </tr>
                            </table>
                            <div class="cart-content-right-text">
                                <p>Miễn phí ship đơn hàng có tổng gía trị trên 2.000.000VND</p>
                                <p style="color: red;font-weight: bold;">Mua thêm <span style="font-style: 15px;">1.610.000đ</span> để được miễn phí SHIP</p>
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