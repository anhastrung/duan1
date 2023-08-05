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

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container w-[1440x] m-auto">
        <header class="mb-[32px]">
            <?php require "./layout/header.php" ?>
        </header>
        <!-- ------------------------------------------------------------------------- -->
        <div class="content ">
            <h3 class="mb-[32px]">Trang chủ > Tất cả Sản Phẩm</h3>
            <div class="flex justify-between">
                <?php
                $id = $_GET['id'];
                $sql = "select * from product where id_product = $id";
                $product = $connect->query($sql)->fetch();
                $luotxem = $product['luotxem'] + 1;
                $connect->exec("UPDATE product SET luotxem = '$luotxem' WHERE id_product = $id");
                ?>
                <div class="img-content w-[709px]">
                    <img class=" w-full" src="../upload/<?= $product['img'] ?>" alt="">
                </div>
                <form method="post" class="properties ml-[50px] w-[709px] border border-box border-none">
                    <h3 class="font-bold"><?= $product['name_product'] ?></h3>
                    <p class="font-bold mt-[30px] mb-[30px]"><?= number_format($product['price_product']) ?></p>
                    <hr class="mb-[20px]">
                    <p class="font-bold">Màu sắc: Xanh tím than</p>
                    <div class="input mt-[16px] mb-[16px]">
                        <button class="border boder-[grey] border-[#000000] bg-[#000000] text-[white] pr-[5px]"><input class="mt-[3px] mb-[3px] mr-[5px] ml-[5px]" type="radio">Đen</button>
                        <button class="border boder-[grey] border-[#000000] ml-[16px] bg-[#777777] text-[white] pr-[5px]"><input class="mt-[3px] mb-[3px] mr-[5px] ml-[5px] " type="radio">Sám</button>
                        <button class="border boder-[grey] border-[#000000] bg-[#FFFFFF] pr-[5px] ml-[16px]"><input class="mt-[3px] mb-[3px] mr-[5px] ml-[5px]" type="radio">Trắng</button>
                    </div>
                    <div class="size flex">
                        <p>S</p>
                        <p class="ml-[32px]">M</p>
                        <p class="ml-[32px]">L</p>
                        <p class="ml-[32px]">XL</p>
                        <p class="ml-[32px]">XXL</p>
                    </div>
                    <p class="mt-[16px] mb-[16px] text-[12px] text-[#221F20]"><i class="fa-regular fa-circle-check"></i>
                        Kiem tra size cua ban</p>
                    <hr>
                    <li class="number flex items-center mt-[16px] mb-[16px]">
                        <div class="p">
                            <p class="mr-[30px]">So Luong:</p>
                        </div>
                        <div class="h-[36px] w-[78px] border border-[grey] flex items-center justify-center">
                            <button class="minus pr-[8px] h-[100%] border-r-[1px] border-[grey]">-</button>
                            <input class="value w-[20px] ml-[10px]" type="number" min="1" max="1000" value="1">
                            <button class="plus pl-[5px] h-[100%] border-l-[1px] border-[grey]">+</button>
                        </div>
                    </li>
                    <div class="item">
                        <button class="w-[190px] h-[56px] border border-[grey] p-[16px] bg-[#000000] text-[white] font-bold">Thêm
                            Vào Giỏ Hàng</button>
                    </div>
                    <p class="mt-[16px] mb-[16px] text-[12px] text-[#221F20]"><i class="fa-regular fa-circle-check"></i>
                        Tim tai cua hang</p>
                    <hr>
                    <div class="suppost">
                        <div class="content-right-suppost mt-[16px]">
                            <div class="content-right-suppost-flex">
                                <p class="text-[16px]">Giới Thiệu</p>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="description">
                                <p class="mt-[16px] text-[12px]">- <?=$product['detail_product']?>.</p>
                                <p class="mt-[16px] mb-[16px] text-[12px]"><span class="text-[red]">Lưu ý:</span> Màu
                                    sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi
                                    chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.</p>
                            </div>
                        </div>
                        <div class="content-right-suppost mt-[16px]">
                            <div class="content-right-suppost-flex">
                                <p class="text-[16px]">Hướng Dẫn Bảo Quản</p>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="decription">
                                <h4 class="mt-[16px]">Chi tiết bảo quản sản phẩm :</h4>
                                <p class="text-[12px] mt-[16px]">* Vải dệt kim : sau khi giặt sản phẩm phải được phơi
                                    ngang tránh bai dãn.</p>
                                <p class="text-[12px] mt-[16px]">* Vải thô , tuytsy , kaki không có phối hay trang trí
                                    đá cườm thì có thể giặt máy.</p>
                                <p class="text-[12px] mt-[16px]"> * Đồ Jeans nên hạn chế giặt bằng máy giặt vì sẽ làm
                                    phai màu jeans.Nếu giặt thì nên lộn trái sản phẩm khi giặt , đóng khuy , kéo khóa,
                                    không nên giặt chung cùng đồ sáng màu , tránh dính màu vào các sản phẩm khác.</p>
                                <p class="text-[12px] mt-[16px]">* Các sản phẩm cần được giặt ngay không ngâm tránh bị
                                    loang màu , phân biệt màu và loại vải để tránh trường hợp vải phai. Không nên giặt
                                    sản phẩm với xà phòng có chất tẩy mạnh , nên giặt cùng xà phòng pha loãng.</p>
                                <p class="text-[12px] mt-[16px]">* Các sản phẩm có thể giặt bằng máy thì chỉ nên để chế
                                    độ giặt nhẹ , vắt mức trung bình và nên phân các loại sản phẩm cùng màu và cùng loại
                                    vải khi giặt.</p>
                                <p class="text-[12px] mt-[16px]">* Nên phơi sản phẩm tại chỗ thoáng mát , tránh ánh nắng
                                    trực tiếp sẽ dễ bị phai bạc màu , nên làm khô quần áo bằng cách phơi ở những điểm
                                    gió sẽ giữ màu vải tốt hơn.</p>
                                <p class="text-[12px] mt-[16px]">* Những chất vải 100% cotton , không nên phơi sản phẩm
                                    bằng mắc áo mà nên vắt ngang sản phẩm lên dây phơi để tránh tình trạng rạn vải.</p>
                                <p class="text-[12px] mt-[16px] mb-[16px]">* Khi ủi sản phẩm bằng bàn là và sử dụng chế
                                    độ hơi nước sẽ làm cho sản phẩm dễ ủi phẳng , mát và không bị cháy , giữ màu sản
                                    phẩm được đẹp và bền lâu hơn. Nhiệt độ của bàn là tùy theo từng loại vải.</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                </form>
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