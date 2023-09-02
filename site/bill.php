<?php
if (isset($_POST['thanh-toan'])) {
    if (empty(trim($_POST['address']))) {
        $mess = "Thiếu địa chỉ";
    }
    if (empty(trim($_POST['phone']))) {
        $mess = "Thiếu số điện thoại";
    }
    if (empty(trim($_POST['name']))) {
        $mess = "Thiếu tên";
    }
    if (empty($mess)) {
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $date = date('Y-m-d');
        $price = $tong;
        $list = "";
        foreach ($listProduct as $li) {
            $id_product = $li['id_product'];
            $list = $list . "$id_product ";
        }
        $sql = "INSERT INTO bill (name, location, phone, price, date, status, product, id_user) VALUES ('$name', '$address', '$phone', '$price', '$date', b'0', '$list', $id_user)";
        $connect->exec($sql);
        $sql = "select * from cart where id_user = $id_user";
        $query = $connect->query($sql)->fetchAll();
        foreach ($query as $li) {
            $sql = "DELETE FROM cart WHERE id_user = $id_user";
            $connect->exec($sql);
        }
        $gmess = "Đặt hàng thành công";
    }
}
?>
<p class="bg-[#fef7e4] py-2 px-3 text-yellow-800 text-lg rounded-[5px] <?php if (empty($gmess)) echo "hidden" ?>"><?= $gmess ?></p>
<div class="content grid grid-cols-2 gap-8">
    <div class="bill w-full border-gray-300 border-[1px]">
        <div>
            <h2 class="bg-black text-white p-2 text-xl font-bold">Thông Tin Khách Hàng</h2>
        </div>
        <form action="" method="post" class="p-10">
            <p class="bg-[#fef7e4] py-2 px-3 text-yellow-800 text-lg rounded-[5px] <?php if (empty($mess)) echo "hidden" ?>"><?= $mess ?></p>
            <div class="mb-4">
                <label class="text-lg">Họ và tên</label>
                <input type="text" class="p-2 border-gray-300 border-[1px] w-full" name="name" value="<?= $name ?>">
            </div>
            <div class="mb-4">
                <label class="text-lg">Số điện thoại</label>
                <input type="text" class="p-2 border-gray-300 border-[1px] w-full" name="phone" value="<?= $phone ?>">
            </div>
            <div class="mb-8">
                <label class="text-lg">Địa chỉ</label>
                <input type="text" class="p-2 border-gray-300 border-[1px] w-full" name="address" value="<?= $address ?>">
            </div>
            <div class="grid grid-cols-2 gap-4 items-center">
                <button class="text-lg text-center bg-gray-100 border-gray-300 border-[1px] h-[120px]" name="thanh-toan">Thanh toán khi nhận hàng</button>
                <button class="text-lg text-center bg-gray-100 border-gray-300 border-[1px] h-[120px]" name="thanh-toan">Thanh toán khi nhận hàng</button>
            </div>
        </form>
    </div>
    <div class="cartt w-full border-gray-300 border-[1px] bg-gray-100">
        <h3 class="bg-black text-white p-2 text-xl font-bold">Thông Tin Đơn Hàng</h3>
        <div class="p-4">
            <?php if (empty($listProduct)) { ?>
                <p class="text-2xl text-red-500 font-bold">Giỏ hàng trống, vui lòng mua thêm hàng để thanh toán</p>
            <?php } else { ?>
                <table class="w-full mb-4">
                    <tr>
                        <th class="w-[calc(100%/4)]">Ảnh</th>
                        <th class="w-[calc(100%/4)]">Tên sản phẩm</th>
                        <th class="w-[calc(100%/4)]">Giá</th>
                        <th class="w-[calc(100%/4)]">Số lượng</th>
                    </tr>
                    <?php
                    foreach ($listProduct as $li) { ?>
                        <tr>
                            <td class="text-center p-2"><img src="../upload/<?= $li['img'] ?>" alt="" class="w-[50px] mx-auto"></td>
                            <td class="text-center p-2"><?= $li['name_product'] ?></td>
                            <td class="text-center p-2"><?= number_format($li['price_product']) ?><sup>đ</sup></td>
                            <td class="text-center p-2"><?= $li['number'] ?></td>
                        </tr>
                    <?php }
                    ?>
                </table>
                <div class="flex justify-between">
                    <span>Tổng tiền</span>
                    <p><?= number_format($tong) ?><sup>đ</sup></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>