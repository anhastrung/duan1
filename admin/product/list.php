<?php
$sql = "select * from product left join category on category.id_category = product.id_category order by id_product desc";
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
    <div class="justify-end flex gap-2">
        <button name="check" value="all" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Chọn tất cả</button>
        <button name="check" value="none" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Bỏ chọn tất cả</button>
        <button name="delete-all" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300" onclick="return confirm('chắc chưa')">Xoá các mục đã chọn</button>
        <?php
        if (isset($_POST['delete-all'])) {
            if (!empty($_POST['checkbox'])) {
                $checkbox = $_POST['checkbox'];
                foreach ($checkbox as $li) {
                    $sql = "DELETE FROM product WHERE id_product = $li";
                    $connect->exec($sql);
                }
                header("location:?list");
            }
        }
        ?>
        <a href="?site=add" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Nhập thêm</a>
    </div>
    <table class="my-8 w-full">
        <thead>
            <tr>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left"></th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Tên sản phẩm</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Giá sản phẩm</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Số lượng sản phẩm</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Hình ảnh</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Ngày nhập hàng</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">Danh mục</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/8)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listLoai as $li) { ?>
                <tr>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]">
                        <label class="mcui-checkbox">
                            <input type="checkbox" id="indeterminate" <?php if (isset($_POST['check']) && $_POST['check'] == "all") {
                                                                            echo "checked";
                                                                        } ?> value="<?= $li['id_product'] ?>" name="checkbox[]">
                            <div>
                                <svg class="mcui-check" viewBox="-2 -2 35 35" aria-hidden="true">
                                    <title>checkmark-circle</title>
                                    <polyline id="polyline" points="7.57 15.87 12.62 21.07 23.43 9.93" />
                                </svg>
                            </div>
                            <div></div>
                        </label>
                    </td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px] <?= $li['id_category']==null? "text-red-500":"" ?>"><?= $li['name_product'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= number_format($li['price_product']) ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['number_product'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><img src="<?= "../../upload/".$li['img'] ?>" class="h-20"></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['date_product'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]"><?= $li['id_category']==null? "không có danh mục":$li['name_category'] ?></td>
                    <td class="w-[calc(100%/8)] p-4 border-gray-300 border-y-[1px]">
                        <a href="?site=delete&id=<?= $li['id_product'] ?>" class="p-2 border-gray-300 border-[1px] hover:bg-red-300 active:bg-green-300" onclick="return confirm('chắc chưa')">Xoá</a>
                        <a href="?site=edit&id=<?= $li['id_product'] ?>" class="p-2 border-gray-300 border-[1px] hover:bg-red-300 active:bg-green-300">Sửa</a>
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