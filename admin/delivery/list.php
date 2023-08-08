<?php
$sql = "select * from hoadon";
$listLoai = $connect->query($sql . " limit $productPage,$limitPage")->fetchAll();
$maxPage = count($connect->query($sql)->fetchAll());
if ($maxPage % $limitPage == 0) {
    $maxPage = $maxPage / $limitPage - 1;
} else {
    $maxPage = floor($maxPage / $limitPage);
}
?>
<div class="text-left font-bold text-3xl my-8">Danh sách sản phẩm</div>
<form method="post">
    <table class="my-8 w-full">
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

                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left"><a href="?site=add" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Nhập thêm</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listLoai as $us) { ?>
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

                    <td>
                        <form action="" method="post">
                            <!-- <select name="role" id="" class="w-full h-[50px] border-solid border-[1px] border-[#37A9CD] rounded-[5px] p-[10px] text-[#0ef] focus:bg-black ">
                    <option value="user" <?= ($user['unit'] == "user") ? ("") : ("selected") ?>>Người dùng</option>
                    <option value="admin" <?= ($user['unit'] == "admin") ? ("") : ("selected") ?>>admin</option>
                </select> -->
                            <select name="cap-nhat" id="" class="w-full h-[30px] border-solid border-[1px] border-[#37A9CD] rounded-[5px] ">
                                <option value="0" <?= ($us['trang_thai'] == "0") ? ("") : ("selected") ?>>Đang chờ xác nhận</option>
                                <option value="1" <?= ($us['trang_thai'] == "0") ? ("") : ("selected") ?>>Đã xác nhận</option>
                                <option value="2" <?= ($us['trang_thai'] == "0") ? ("") : ("selected") ?>>Đang giao</option>
                                <option value="3" <?= ($us['trang_thai'] == "0") ? ("") : ("selected") ?>>Đã giao</option>
                            </select>
                    <td><a href="?site=sua&id=<?= $us['id_hoadon'] ?>&tt=<?= $_POST['cap-nhat'] ?>" class="p-2 border-gray-300 border-[1px] hover:bg-red-300 active:bg-green-300"><input type="submit" value="UPDATE" class="p-2 border-gray-300 border-[1px] hover:bg-red-300 active:bg-green-300"></a></td>
</form>
</td>

</tr>
<?php } ?>
</tbody>
</table>
<div class="text-center ?>">
    <div class="inline-block">
        <a <?php if ($page > 0) echo "href=?site=list&page=" . $page - 1 ?> class="text-black float-left px-4 py-2 border-[#ddd] border-[1px] mx-1 my-8 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300">&laquo;</a>
        <?php for ($i = 0; $i < $maxPage + 1; $i++) { ?>
            <a href="?site=list&page=<?= $i ?>" class=" <?= $i == $page ? "text-white bg-[#4CAF50] border-[#4CAF50]" : "text-black border-[#ddd] bg-[#ddd]" ?> float-left px-4 py-2 border-[1px] mx-1 my-8 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300"><?= $i + 1 ?></a>
        <?php } ?>
        <a <?php if ($page < $maxPage) echo "href=?site=list&page=" . $page + 1 ?> class="text-black float-left px-4 py-2 border-[#ddd] border-[1px] mx-1 my-8 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300">&raquo;</a>
    </div>
</div>
</form>