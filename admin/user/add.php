<?php
if (isset($_POST['btn-add'])) {
    if (empty(trim($_POST['address']))) {
        $mess = "Thiếu địa chỉ";
    }
    if (!in_array($_FILES['anh']['type'], $accept)) {
        $mess = "Chỉ được upload ảnh";
    } else {
        if ($_FILES['anh']['size'] > 2 * 1024 * 1024) {
            $mess = "Ảnh phải bé hơn 2mb";
        }
    }
    if (empty(trim($_POST['phone']))) {
        $mess = "Thiếu số điện thoại";
    }
    if (empty(trim($_POST['password']))) {
        $mess = "Thiếu mật khẩu";
    }
    if (empty(trim($_POST['name']))) {
        $mess = "Thiếu tên";
    }
    if (empty(trim($_POST['username']))) {
        $mess = "Thiếu username";
    }
    if (empty($mess)) {
        $username = trim($_POST['username']);
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);
        $phone = trim($_POST['phone']);
        $tmp = explode('.', $_FILES['anh']["name"]);
        $anh = md5(rand()) . "." . end($tmp);
        move_uploaded_file($_FILES['anh']["tmp_name"], "../../upload/" . $anh);
        $role = $_POST['role'];
        $address = trim($_POST['address']);
        $sql = "INSERT INTO user (username, password, name, img, address, phone, role) VALUES ('$username', '$password', '$name', '$anh', '$address', '$phone', b'$role')";
        $connect->exec($sql);
        $mess = "Thêm user thành công";
        // $_POST = [];
    }
}
?>
<div class="text-left font-bold text-3xl my-8">Thêm user</div>
<p class="bg-[#fef7e4] py-2 px-3 text-yellow-800 text-lg rounded-[5px] <?php if (empty($mess)) echo "hidden" ?>"><?= $mess ?></p>
<form action="" method="post" class="grid grid-cols-3 gap-x-8" enctype="multipart/form-data">
    <div>
        <label class="font-bold block mb-2 mt-4">Username</label>
        <input type="text" class="py-[5px] px-2 border-[1px] w-full border-gray-300" name="username" required value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>">
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Name</label>
        <input type="text" class="py-[5px] px-2 border-[1px] w-full border-gray-300" name="name" required value="<?php if (isset($_POST['name'])) echo $_POST['name'] ?>">
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Password</label>
        <input type="password" class="py-[5px] px-2 border-[1px] w-full border-gray-300" name="password" required value="<?php if (isset($_POST['password'])) echo $_POST['password'] ?>">
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Số điện thoại</label>
        <input type="text" class="py-[5px] px-2 border-[1px] w-full border-gray-300" name="phone" required value="<?php if (isset($_POST['phone'])) echo $_POST['phone'] ?>">
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Hình ảnh</label>
        <input type="file" class="border-[1px] w-full border-gray-300 bg-white custom-file-input" name="anh" required>
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Vai trò</label>
        <select name="role" id="" class="py-1.5 px-2 border-[1px] w-full border-gray-300">
            <option value="0">Người dùng</option>
            <option value="1" <?php if (isset($_POST['role'])&&$_POST['role'] == 1) echo "selected" ?>>Nhân viên</option>
        </select>
    </div>
    <div class="col-span-3">
        <label class="font-bold block mb-2 mt-4">Địa chỉ</label>
        <textarea name="address" rows="3" class="p-3 border-[1px] w-full border-gray-300" required><?php if (isset($_POST['address'])) echo $_POST['address'] ?></textarea>
    </div>
    <div class="mt-3 col-span-3">
        <button name="btn-add" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Thêm user</button>
        <input type="reset" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300" value="Nhập lại">
        <a href="?site=list" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Danh sách</a>
    </div>
</form>