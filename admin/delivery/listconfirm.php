<?php
$sql = "select * from bill where status=1 order by id_bill desc";
$listKh = $connect->query($sql . " limit $productPage,$limitPage")->fetchAll();
$maxPage = count($connect->query($sql)->fetchAll());
if ($maxPage % $limitPage == 0) {
    $maxPage = $maxPage / $limitPage - 1;
} else {
    $maxPage = floor($maxPage / $limitPage);
}
if (isset($_POST['delivery'])) {
    $id_bill = $_POST['id_bill'];
    $status = $_POST['delivery'];
    $sql = "UPDATE bill SET status = b'$status' WHERE id_bill = $id_bill";
    $connect->exec($sql);
    header("location:?site=list");
}
?>
<div class="text-left font-bold text-3xl my-8">Danh sách hóa đơn</div>
<div class="justify-end flex gap-2">
    <a href="?site=list" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Hóa đơn chưa giao hàng</a>
</div>
<div>
    <table class="my-8 w-full">
        <thead>
            <tr>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">mã hóa đơn</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">name</th>
                <!-- <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">phone</th> -->
                <!-- <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">location</th> -->
                <!-- <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">price</th> -->
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">date</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">status</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listKh as $li) { ?>
                <tr>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= $li['id_bill'] ?></td>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= $li['name'] ?></td>
                    <!-- <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= $li['phone'] ?></td> -->
                    <!-- <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= $li['location'] ?></td> -->
                    <!-- <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= number_format($li['price']) ?></td> -->
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= $li['date'] ?></td>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]">
                        <form action="" method="post">
                            <input type="text" name="id_bill" value="<?= $li['id_bill'] ?>" hidden>
                            <select name="delivery" id="" onchange="submit()" class="<?php if ($li['status'] == 1) echo "bg-blue-200" ?>" <?php if ($li['status'] == 1) echo "disabled" ?>>
                                <option value="0">Đang giao hàng</option>
                                <option value="1" <?php if ($li['status'] == 1) echo "selected" ?>>Đã giao hàng</option>
                            </select>
                        </form>
                    </td>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><a class="border-gray-300 border-[1px] bg-white p-2 hover:text-green-300" href="?site=bill&id=<?=$li['id_bill']?>">Chi Tiết</a></td>
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