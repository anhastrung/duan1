<?php
$id = $_GET['id'];
$sql = "select * from category where id_category = $id";
$loai = $connect->query($sql)->fetch();
if (isset($_POST['btn-update'])) {
    $tenloai = $_POST['name_category'];
    if (empty($tenloai)) {
        header("location:?site=list");
    } else {
        $connect->exec("UPDATE category SET name_category = '$tenloai' WHERE id_category = $id");
        header("location:?site=list");
    }
}
?>
<div class="text-left font-bold text-3xl my-8">Sửa danh mục</div>
<form action="" method="post" class="w-[15%]">
    <p class="bg-[#fef7e4] py-2 px-3 text-yellow-800 text-lg rounded-[5px] <?php if (empty($mess)) echo "hidden" ?>"><?= $mess ?></p>
    <label class="font-bold block mb-2 mt-4">Tên danh mục</label>
    <input type="text" class="w-full py-2 px-3 border-[1px] border-gray-300" name="name_category" autofocus required value="<?= $loai['name_category'] ?>">
    <button name="btn-update" class="font-bold text-xl bg-red-300 p-2 hover:bg-blue-300 active:bg-green-300 w-full mt-2">Update</button>
</form>