<?php
ob_start();
$id = $_GET['id'];
if (isset($_POST['delete'])) {
    $idDelete = $_POST['id_bl'];
    $queryBinhLuan = $connect->query("select * from comment where id_comment = $idDelete")->fetch();
    if ($queryBinhLuan['id_user'] == $id_user) {
        $sql = "DELETE FROM comment WHERE id_comment = $idDelete";
        $connect->exec($sql);
        header("?site=product&id=$id");
    }
}
if (isset($_POST['add-binhluan'])) {
    $id = $_GET['id'];
    $binhluan = trim($_POST['binhluan']);
    $ngaybl = date("Y-m-d");
    if (!empty($binhluan)) {
        $sql = "INSERT INTO comment (id_user, id_product, status, content, date) VALUES ('$id_user', '$id', b'0', '$binhluan', '$ngaybl')";
        $connect->exec($sql);
        $messages = "Bình luận đang chờ duyệt! Vui lòng chờ trong ít phút";
    }
}
?>
<div class="content">
    <h3 class="mb-[32px]">Trang chủ > Sản Phẩm</h3>
    <div class="flex justify-between">
        <?php
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
            <p class="font-bold mt-[30px] mb-[30px]"><?= number_format($product['price_product']) ?>đ</p>
            <hr class="mb-[20px]">
            <p class="font-bold">Màu sắc: Xanh tím than</p>
            <div class="input mt-[16px] mb-[16px]">
                <button type="button" class="border boder-[grey] border-[#000000] bg-[#000000] text-[white] pr-[5px]"><input class="mt-[3px] mb-[3px] mr-[5px] ml-[5px]" type="radio">Đen</button>
                <button type="button" class="border boder-[grey] border-[#000000] ml-[16px] bg-[#777777] text-[white] pr-[5px]"><input class="mt-[3px] mb-[3px] mr-[5px] ml-[5px] " type="radio">Sám</button>
                <button type="button" class="border boder-[grey] border-[#000000] bg-[#FFFFFF] pr-[5px] ml-[16px]"><input class="mt-[3px] mb-[3px] mr-[5px] ml-[5px]" type="radio">Trắng</button>
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
                    <button type="button" class="minus pr-[8px] h-[100%] border-r-[1px] border-[grey]">-</button>
                    <input class="value w-[20px] ml-[10px]" type="number" min="1" max="<?= $product['number_product'] ?>" value="1" name="number_product">
                    <button type="button" class="plus pl-[5px] h-[100%] border-l-[1px] border-[grey]">+</button>
                </div>
            </li>
            <div class="item">
                <?php
                if (isset($_POST['add-to-cart'])) {
                    if (isset($_SESSION['user'])) {
                        $sql = "select * from cart where id_user = '$id_user' and id_product = '$id'";
                        $query = $connect->query($sql)->fetch();
                        if (empty($query)) {
                            $number = $_POST['number_product'];
                            $sql = "INSERT INTO cart (id_user, id_product, number) VALUES ('$id_user', '$id', '$number')";
                        } else {
                            $number = $query['number'] + $_POST['number_product'];
                            $queryId = $query['id_cart'];
                            $sql = "UPDATE cart SET number = '$number' WHERE cart.id_cart = $queryId";
                        }
                        $connect->exec($sql);
                        header("Refresh:0");
                    } else {
                        $mess = "Đăng nhập để thêm vào giỏ hàng";
                    }
                }
                ?>
                <button class="w-[190px] h-[56px] border border-[grey] p-[16px] bg-[#000000] text-[white] font-bold" name="add-to-cart">Thêm
                    Vào Giỏ Hàng</button>
                <p class="bg-[#fef7e4] py-2 px-3 text-yellow-800 text-lg rounded-[5px] <?php if (empty($mess)) echo "hidden" ?>"><?= $mess ?></p>
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
                        <p class="mt-[16px] text-[12px]">- <?= $product['detail_product'] ?>.</p>
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
    <div class="comment my-8 border-gray-300 border-[1px]">
        <p class="bg-[#fef7e4] py-2 px-3 text-yellow-800 text-lg rounded-[5px] <?php if (empty($messages)) echo "hidden" ?>"><?= $messages ?></p>
        <h3 class="uppercase bg-[#f5f4f6] p-3 text-lg border-gray-300 border-[1px]">bình luận</h3>
        <div>
            <ul class="list-disc ml-10 my-4">
                <?php
                $sql = "select * from comment inner join user on comment.id_user = user.id_user where id_product=$id and status = 1 order by id_comment desc limit 10";
                $listBinhLuan = $connect->query($sql)->fetchAll();
                if (empty($listBinhLuan)) {
                ?>
                    <li>hiện chưa có bình luận về sản phẩm này</li>
                    <?php
                } else {
                    foreach ($listBinhLuan as $li) {
                    ?>
                        <li class="flex justify-between">
                            <p><?= $li['name'] ?>: <?= $li['content'] ?></p>
                            <?php
                            if (isset($_SESSION['user'])) {
                                $idBinhLuan = $li['id_comment'];
                                $queryBinhLuan = $connect->query("select * from comment where id_comment = $idBinhLuan")->fetch();
                                if ($queryBinhLuan['id_user'] == $id_user) {
                            ?>
                                    <form action="" method="post">
                                        <input type="text" value="<?= $idBinhLuan ?>" hidden name="id_bl">
                                        <button name="delete" class="text-red-300 mr-4" onclick="return confirm('chắc chưa')">xoá</button>
                                    </form>
                            <?php }
                            } ?>
                        </li>
                <?php }
                } ?>
            </ul>
            <?php if (isset($_SESSION['user'])) {
            ?>
                <form action="" method="post" class="border-gray-300 border-[1px] bg-[#f5f4f6] p-3 text-lg grid grid-cols-[1fr,12%] gap-8">
                    <input type="text" class="bg-white border-gray-300 border-[1px] p-2" name="binhluan">
                    <button class="bg-white border-gray-300 border-[1px]" name="add-binhluan">Gửi</button>
                </form>
            <?php } else { ?>
                <p class="border-gray-300 border-[1px] text-red-700 font-bold bg-[#f5f4f6] p-3 text-lg">Đăng nhập để bình luận về sản phẩm này</p>
            <?php } ?>
        </div>
    </div>
</div>
<?php
ob_end_flush();
?>