<?php
$sql = "select * from user";
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
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Họ và tên</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Email</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Số điện thoại</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Hình ảnh</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Ngày sinh</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Giới tính</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Kích hoạt</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Địa chỉ</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Quyền truy cập</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left"><a href="?site=add" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Nhập thêm</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listLoai as $li) { ?>
                <tr>

                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['fullname'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['email'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['phone'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><img src="<?= "../../upload/" . $li['img'] ?>" class="h-20 w-[100px]"></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['birthday'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['sex'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= (strcasecmp($li['role'], 'admin') == 0) ? ('<span style="color: red;">admin</span>') : (($li['kichhoat'] == 0) ? '<span style="color: #0ef;">Đang dùng</span>' : '<span style="color: red;">Đã hủy</span>') ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['location'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['role'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]">
                        <?php
                        if (strcasecmp($li['role'], 'admin') != 0) {
                            echo '<a href="?site=delete&id=' . $li['id_user'] . '" class="p-2 border-gray-300 border-[1px] hover:bg-red-300 active:bg-green-300" onclick="return confirm(', "'chắc chưa'", ')">Xoá</a>';
                        } else {
                            echo '';
                        } ?>
                        <a href="?site=edit&id=<?= $li['id_user'] ?>" class="p-2 border-gray-300 border-[1px] hover:bg-red-300 active:bg-green-300">Sửa</a>
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