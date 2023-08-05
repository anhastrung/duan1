<?php
$sql = "select u.fullname, p.name_product, c.noidung_comment,c.traloi_comment,c.ngay_bl,c.id_comment, c.ngay_tl from comment c join user u on c.id_user=u.id_user join product p on c.id_product=p.id_product";
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
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Họ tên người comment</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Tên sản phẩm comment</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Nội dung comment</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Trả lời comment</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Ngày comment</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Ngày trả lời</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listLoai as $li) { ?>
                <tr>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['fullname'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['name_product'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['noidung_comment'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['traloi_comment'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['ngay_bl'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['ngay_tl'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]">
                        <a href="?site=delete&id=<?= $li['id_comment'] ?>" class="p-2 border-gray-300 border-[1px] hover:bg-red-300 active:bg-green-300" onclick="return confirm('chắc chưa')">Xoá</a>
                        <a href="?site=edit&id=<?= $li['id_comment'] ?>" class="p-2 border-gray-300 border-[1px] hover:bg-red-300 active:bg-green-300">Trả lời</a>
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