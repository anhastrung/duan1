<?php
$sql = "select * from comment inner join user on user.id_user = comment.id_user inner join product on product.id_product = comment.id_product where status=1 order by id_comment desc";
$listKh = $connect->query($sql . " limit $productPage,$limitPage")->fetchAll();
$maxPage = count($connect->query($sql)->fetchAll());
if ($maxPage % $limitPage == 0) {
    $maxPage = $maxPage / $limitPage - 1;
} else {
    $maxPage = floor($maxPage / $limitPage);
}
if (isset($_POST['delete'])) {
    $idDelete = $_POST['delete'];
    $sql = "DELETE FROM comment WHERE comment.id_comment = $idDelete";
    $connect->exec($sql);
    header("location:?site=listconfirm");
}
?>
<div class="text-left font-bold text-3xl my-8">List bình luận</div>
<div class="justify-end flex gap-2">
    <a href="?site=list" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Duyệt bình luận</a>
</div>
<div>
    <table class="my-8 w-full">
        <thead>
            <tr>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">người dùng</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">sản phẩm</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">ngày bình luận</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">content</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listKh as $li) { ?>
                <tr>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= $li['name'] ?></td>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= $li['name_product'] ?></td>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= $li['date'] ?></td>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= $li['content'] ?></td>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]">
                        <form action="" method="post" class="inline-block">
                            <button class="border-gray-300 border-[1px] bg-white p-2 hover:text-green-300" name="delete" value="<?=$li['id_comment']?>" onclick="return confirm('chắc chưa')">Xóa</button>
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