<form>
    <h2 class="bg-green-100 w-full p-4 text-green-800 text-3xl uppercase rounded-[5px]">thống kê hàng hoá từng loại</h2>
    <table class="my-8 w-full">
        <thead>
            <tr>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">loại hàng</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">số lượng</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">giá cao nhất</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">giá thấp nhất</th>
                <th class="uppercase font-bold text-green-800 w-[calc(100%/5)] border-gray-300 border-y-[1px] p-2 bg-green-100 text-left">giá trung bình</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listTK as $li) { ?>
                <tr>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= $li['name_category'] ?></td>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]"><?= number_format($li['soluong']) ?></td>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]">$<?= number_format($li['caonhat']) ?></td>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]">$<?= number_format($li['thapnhat']) ?></td>
                    <td class="w-[calc(100%/5)] p-4 border-gray-300 border-y-[1px]">$<?= number_format($li['trungbinh']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="mt-6">
        <a href="?site=bieudo" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Xem biểu đồ</a>
    </div>
</form>