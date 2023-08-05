<?php
if (isset($_POST['btn-add'])) {
    if (empty(trim($_POST['detail_product']))) {
        $mess = "Thiếu mô tả";
    }
    if (!in_array($_FILES['anh']['type'], $accept)) {
        $mess = "Chỉ được upload ảnh";
    } else {
        if ($_FILES['anh']['size'] > 2 * 1024 * 1024) {
            $mess = "Ảnh phải bé hơn 2mb";
        }
    }
    if (empty(trim($_POST['name_product']))) {
        $mess = "Điền tên sản phẩm";
    }
    if (empty($mess)) {
        $name_product = trim($_POST['name_product']);
        $price_product = $_POST['price_product'];
        $sale_product = $_POST['sale_product'];
        $number_product = $_POST['number_product'];
        $tmp = explode('.', $_FILES['anh']["name"]);
        $anh = md5(rand()) . "." . end($tmp);
        move_uploaded_file($_FILES['anh']["tmp_name"], "../../upload/" . $anh);
        $detail_product = trim($_POST['detail_product']);
        $date = date('Y-m-d');
        $name_category = $_POST['name_category'];
        $sql = "INSERT INTO product (name_product, price_product, sale_product, number_product, img, luotxem, detail_product, date_product, id_category) VALUES ('$name_product', '$price_product', '$sale_product', '$number_product', '$anh', '0', '$detail_product', '$date', '$name_category')";
        $connect->exec($sql);
        $mess = "Thêm sản phẩm thành công";
        $_POST = [];
    }
}
?>
<div class="text-left font-bold text-3xl my-8">Thêm sản phẩm</div>
<p class="bg-[#fef7e4] py-2 px-3 text-yellow-800 text-lg rounded-[5px] <?php if (empty($mess)) echo "hidden" ?>"><?= $mess ?></p>
<form action="" method="post" class="grid grid-cols-3 gap-x-8" enctype="multipart/form-data">
    <div>
        <label class="font-bold block mb-2 mt-4">Tên sản phẩm</label>
        <input type="text" class="py-[5px] px-2 border-[1px] w-full border-gray-300" name="name_product" required value="<?php if (isset($_POST['name_product'])) echo $_POST['name_product'] ?>">
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Giá sản phẩm</label>
        <input type="number" min="0" max="999999999" class="py-[5px] px-2 border-[1px] w-full border-gray-300" name="price_product" required value="<?php if (isset($_POST['price_product'])) echo $_POST['price_product'] ?>">
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Giảm giá</label>
        <select name="sale_product" id="" class="py-1.5 px-2 border-[1px] w-full border-gray-300">
            <option value="0">Chọn</option>
            <?php for ($i = 1; $i <= 100; $i++) { ?>
                <option <?php if(isset($_POST['sale_product'])&&$_POST['sale_product']==$i) echo "selected" ?> value="<?= $i ?>"><?= $i ?>%</option>
            <?php } ?>
        </select>
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Số lượng sản phẩm</label>
        <input type="number" min="0" max="1000" class="py-[5px] px-2 border-[1px] w-full border-gray-300" name="number_product" required value="<?php if (isset($_POST["number_product"])) echo $_POST['number_product'] ?>">
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Hình ảnh</label>
        <input type="file" class="border-[1px] w-full border-gray-300 bg-white custom-file-input" name="anh" required>
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Danh mục</label>
        <select name="name_category" id="" required class="py-1.5 px-2 border-[1px] w-full border-gray-300">
            <option value="">Chọn</option>
            <?php
            $listDanhMuc = $connect->query("select * from category");
            foreach ($listDanhMuc as $li) {
            ?>
                <option <?php if(isset($_POST['name_category'])&&$_POST['name_category']==$li['id_category']) echo "selected" ?> value="<?= $li['id_category'] ?>"><?= $li['name_category'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-span-3">
        <label class="font-bold block mb-2 mt-4">Mô tả</label>
        <textarea name="detail_product" rows="3" class="p-3 border-[1px] w-full border-gray-300" required><?php if (isset($_POST['detail_product'])) echo $_POST['detail_product'] ?></textarea>
    </div>
    <div class="mt-3 col-span-3">
        <button name="btn-add" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Thêm sản phẩm</button>
        <input type="reset" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300" value="Nhập lại">
        <a href="?site=list" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Danh sách</a>
    </div>
</form>