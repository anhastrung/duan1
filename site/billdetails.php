<?php
$id = $_GET['id'];
$sql = "select * from bill where id_bill = $id";
$bill = $connect->query($sql)->fetch();
?>
<div class="text-left font-bold text-3xl my-8">Hóa đơn chi tiết</div>
<div>
    <div class="text-lg inline-block font-bold my-1 capitalize">mã hóa đơn: </div>
    <p class="text-lg inline-block"><?= $bill['id_bill'] ?></p><br>
    <div class="text-lg inline-block font-bold my-1 capitalize">tên người nhận: </div>
    <p class="text-lg inline-block"><?= $bill['name'] ?></p><br>
    <div class="text-lg inline-block font-bold my-1 capitalize">địa chỉ: </div>
    <p class="text-lg inline-block"><?= $bill['location'] ?></p><br>
    <div class="text-lg inline-block font-bold my-1 capitalize">số điện thoại: </div>
    <p class="text-lg inline-block"><?= $bill['phone'] ?></p><br>
    <div class="text-lg inline-block font-bold my-1 capitalize">tổng tiền:</div>
    <p class="text-lg inline-block"><?= $bill['price'] ?></p><br>
    <div class="text-lg inline-block font-bold my-1 capitalize">ngày đặt hàng: </div>
    <p class="text-lg inline-block"><?= $bill['date'] ?></p><br>
    <div class="text-lg inline-block font-bold my-1 capitalize">trạng thái: </div>
    <p class="text-lg inline-block"><?= $bill['status']==0?"Đang giao hàng":"Đã giao hàng" ?></p><br>
</div>
<a href="?site=userbill" class="border-gray-300 border-[1px] p-2 inline-block my-2">Danh sách</a>