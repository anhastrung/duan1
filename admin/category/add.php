<?php
if (isset($_POST['btn-add'])) {
    if (empty(trim($_POST['name_category']))) {
        $mess = "Điền tên danh mục";
    } else {
        $sql = "select * from category";
        $danhmuc = $connect->query($sql)->fetchAll();
        foreach ($danhmuc as $li) {
            if ($_POST['name_category'] == $li['name_category']) {
                $mess = "Đã tồn tại danh mục";
                break;
            }
        }
    }
    if (empty($mess)) {
        $tenDanhMuc = trim($_POST['name_category']);
        $sql = "INSERT INTO category (name_category) VALUES ('$tenDanhMuc')";
        $connect->exec($sql);
        $mess = "Thêm danh mục thành công";
    }
}
?>
<div class="text-left font-bold text-3xl my-8">Thêm danh mục</div>
<form action="" method="post" class="w-[22%]">
    <p class="bg-[#fef7e4] py-2 px-3 text-yellow-800 text-lg rounded-[5px] w-full <?php if (empty($mess)) echo "hidden" ?>"><?= $mess ?></p>
    <label class="font-bold block mb-2 mt-4">Tên danh mục</label>
    <input type="text" class="w-full py-2 px-3 border-[1px] border-gray-300" name="name_category" autofocus required>
    <div class="mt-3">
        <button name="btn-add" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Thêm danh mục</button>
        <input type="reset" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300" value="Nhập lại">
        <a href="?site=list" class="px-2 py-2 border-[1px] inline-block border-gray-300 hover:bg-red-300 active:bg-green-300">Danh sách</a>
    </div>
</form>