<?php
if (!isset($_SESSION['user'])) {
    header("location:?site=home");
}
$id = $id_user;
$sql = "select * from user where id_user = $id";
$user = $connect->query($sql)->fetch();
if (isset($_POST['btn-add'])) {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    if (empty(trim($_POST['address']))) {
        $address = $user['address'];
    }
    $anh = $user['img'];
    if (!$_FILES['anh']['name'] == "") {
        if (!in_array($_FILES['anh']['type'], $accept)) {
            $mess = "Chỉ được upload ảnh";
        } else {
            if ($_FILES['anh']['size'] > 2 * 1024 * 1024) {
                $mess = "Ảnh phải bé hơn 2mb";
            } else {
                $tmp = explode('.', $_FILES['anh']["name"]);
                $anh = md5(rand()) . "." . end($tmp);
                move_uploaded_file($_FILES['anh']["tmp_name"], "../upload/" . $anh);
            }
        }
    }
    if (empty(trim($_POST['phone']))) {
        $phone = $user['phone'];
    }
    if (empty(trim($_POST['password']))) {
        $password = $user['password'];
    }
    if (empty(trim($_POST['name']))) {
        $name = $user['name'];
    }
    if (empty($mess)) {
        $sql = "UPDATE user SET password = '$password', name = '$name', img = '$anh', address = '$address', phone = '$phone' WHERE user.id_user = $id";
        $connect->exec($sql);
        header("location:?site=home");
    }
}
?>
<div class="text-left font-bold text-3xl my-8">Sửa user</div>
<p class="bg-[#fef7e4] py-2 px-3 text-yellow-800 text-lg rounded-[5px] <?php if (empty($mess)) echo "hidden" ?>"><?= $mess ?></p>
<form action="" method="post" class="grid grid-cols-3 gap-x-8" enctype="multipart/form-data">
    <div>
        <label class="font-bold block mb-2 mt-4">Username</label>
        <input type="text" class="py-[5px] px-2 border-[1px] w-full border-gray-300" name="username" value="<?= $user['username'] ?>" disabled>
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Name</label>
        <input type="text" class="py-[5px] px-2 border-[1px] w-full border-gray-300" name="name" required value="<?= $user['name'] ?>">
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Password</label>
        <input type="password" class="py-[5px] px-2 border-[1px] w-full border-gray-300" name="password" required value="<?= $user['password'] ?>">
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Số điện thoại</label>
        <input type="text" class="py-[5px] px-2 border-[1px] w-full border-gray-300" name="phone" required value="<?= $user['phone'] ?>">
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Hình ảnh</label>
        <input type="file" class="border-[1px] w-full border-gray-300 bg-white custom-file-input" name="anh">
        <img src="../upload/<?= $user['img'] ?>" alt="">
    </div>
    <div>
        <label class="font-bold block mb-2 mt-4">Vai trò</label>
        <select name="role" id="" class="py-1.5 px-2 border-[1px] w-full border-gray-300" disabled>
            <option value="0">Người dùng</option>
            <option value="1" <?php if ($user['role'] == 1) echo "selected" ?>>Nhân viên</option>
        </select>
    </div>
    <div class="col-span-3">
        <label class="font-bold block mb-2 mt-4">Địa chỉ</label>
        <textarea name="address" rows="3" class="p-3 border-[1px] w-full border-gray-300" required><?= $user['address'] ?></textarea>
    </div>
    <div class="mt-3 col-span-3">
        <button name="btn-add" class="px-2 py-2 border-[1px] border-gray-300 hover:bg-red-300 active:bg-green-300">Sửa thông tin</button>
    </div>
</form>