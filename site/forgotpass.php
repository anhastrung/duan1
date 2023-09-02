<?php
if (isset($_SESSION['user'])) {
    header("location:?site=home");
}
if (isset($_POST['forgor-pass'])) {
    foreach (["username", "phone"] as $li) {
        $$li = trim($_POST[$li]);
    }
    $sql = "select * from user where username = '$username' and phone = '$phone'";
    $query = $connect->query($sql)->fetch();
    if (empty($query)) {
        $mess = "User hoặc phone không đúng";
    }
    if (empty($mess)) {
        $_SESSION['forgorPass'] = $query;
    }
}
if (isset($_SESSION['forgorPass'])) {
    extract($_SESSION['forgorPass']);
}
if (isset($_POST['re-pass'])) {
    if (empty($_POST['password'])) {
        $mess = "Mật khẩu trống";
    } else {
        if ($_POST['password'] != $_POST['re-password']) {
            $mess = "Mật khẩu không trùng khớp";
        }
    }
    if (empty($mess)) {
        $password = $_POST['password'];
        $sql = "UPDATE user SET password = '$password' WHERE id_user = $id_user";
        $connect->exec($sql);
        $mess = "Thay đổi password thành công";
        unset($_SESSION['forgorPass']);
    }
}
?>
<div class="<?php if (!isset($_SESSION['forgorPass'])) echo 'hidden' ?>">
    <div class="text-left font-bold text-3xl my-8">Đặt lại mật khẩu</div>
    <h3 class="uppercase text-3xl bg-red-100 w-full p-4 text-red-800 rounded-[5px]">đặt lại mật khẩu</h3>
    <h3 class="bg-[#fef7e4] w-full p-4 text-yellow-800 text-xl mt-6 rounded-[5px] <?php if (empty($mess)) echo "hidden" ?> ?>"><?= $mess ?></h3>
    <form action="" method="post" class="py-4">
        <label class="block mb-1">Tên đăng nhập</label>
        <input class="block w-full py-2 px-2 text-sm border-gray-300 border-[1px] rounded-[5px]" type="text" name="user" disabled value="<?= $username ?>">
        <label class="block mb-1 mt-4">Mật khẩu</label>
        <input class="block w-full py-2 px-2 text-sm border-gray-300 border-[1px] rounded-[5px]" type="password" name="password" autocomplete="new-password">
        <label class="block mb-1 mt-4">Xác nhận mật khẩu</label>
        <input class="block w-full py-2 px-2 text-sm border-gray-300 border-[1px] rounded-[5px]" type="password" name="re-password">
        <button class="block border-gray-300 border-[1px] px-3 py-2 rounded-[5px] hover:bg-red-300 active:bg-green-300 mt-4" name="re-pass">Thay đổi mật khẩu</button>
    </form>
</div>
<div class="<?php if (isset($_SESSION['forgorPass'])) echo 'hidden' ?>">
    <div class="text-left font-bold text-3xl my-8">Quên mật khẩu</div>
    <h3 class="bg-[#fef7e4] w-full p-4 text-yellow-800 text-xl mt-6 rounded-[5px] <?php if (empty($mess)) echo "hidden" ?> ?>"><?= $mess ?></h3>
    <form action="" method="post" class="py-4">
        <label class="block mb-1">Tên đăng nhập</label>
        <input class="block w-full py-2 px-2 text-sm border-gray-300 border-[1px] rounded-[5px]" type="text" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>">
        <label class="block mb-1 mt-4">Số điện thoại</label>
        <input class="block w-full py-2 px-2 text-sm border-gray-300 border-[1px] rounded-[5px]" type="text" name="phone" value="<?php if (isset($_POST['phone'])) echo $_POST['phone'] ?>">
        <button class="block border-gray-300 border-[1px] px-3 py-2 rounded-[5px] hover:bg-red-300 active:bg-green-300 mt-4" name="forgor-pass">Tìm lại mật khẩu</button>
    </form>
</div>