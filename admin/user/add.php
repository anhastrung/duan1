<?php
if (isset($_POST['them'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $img = $_FILES['img'];
    $ngaysinh = $_POST['ngaysinh'];
    $sex = $_POST['sex'];
    $location = $_POST['location'];
    $password = $_POST['password'];
    $password_ans = $_POST['answe-password'];
    $error = [];
    if (empty($fullname)) {
        $error['fullname'] = "Vui lòng nhập họ và tên";
    }
    if (empty($email)) {
        $error['email'] = "Vui lòng nhập email";
    } else {
        try {
            $sql = "SELECT * from user where email='$email'";
            $run = $connect->prepare($sql);
            $run->execute();
            $data_email = $run->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi hệ thống";
        }
        if ($data_email) {
            $error['email'] = "Email này đã tồn tại";
        }
    }
    if (empty($phone)) {
        $error['phone'] = "Vui lòng nhập số điện thoại";
    } else {
        try {
            $sql = "SELECT * from user where phone='$phone'";
            $run = $connect->prepare($sql);
            $run->execute();
            $data_phone = $run->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi hệ thống";
        }
        if ($data_phone) {
            $error['phone'] = "Số điện thoại này đã tồn tại";
        }
    }
    if ($img['size'] <= 0) {
        $error['img'] = "Bạn chưa tải ảnh";
    } else {
        $img_arr = ['jpg', 'png', 'jpeg', 'gif'];
        $duoi = pathinfo($img['name'], PATHINFO_EXTENSION);
        if (!in_array($duoi, $img_arr)) {
            $error['img'] = "File không phải ảnh";
        } else {
            $anh = $img['name'];
        }
    }
    if (empty($ngaysinh)) {
        $error['ngaysinh'] = "Vui lòng chọn ngày sinh";
    }
    if (empty($location)) {
        $error['location'] = "Vui lòng nhập địa chỉ";
    }
    if (empty($password)) {
        $error['password'] = "Vui lòng nhập mật khẩu";
    }
    if (empty($password_ans)) {
        $error['password_ans'] = "Vui lòng nhập lại mật khẩu";
    } else {
        if ($password_ans != $password) {
            $error['password_ans'] = "Mật khẩu không khớp";
        }
    }
    if (empty($error)) {
        try {
            $sql = "INSERT INTO `user` (`fullname`, `email`, `password`, `phone`, `img`, `birthday`, `sex`, `location`) VALUES ('$fullname', '$email', '$password', '$phone', '$anh', '$ngaysinh', '$sex', '$location')";
            $run = $connect->prepare($sql);
            $run->execute();
            move_uploaded_file( $img['tmp_name'], "../../upload/" . $anh);
            header("location:?site=list");
        } catch (PDOException $e) {
            echo "Lỗi hệ thống";
        }
    }
}
?>

<form method="post" action="" class="grid grid-cols-1 gap-[20px] w-[80%] m-auto" enctype="multipart/form-data">
    <h3 class="my-[40px] font-bold text-[29px]">Thêm tài khoản mới</h3>
    <div class="form-group">
        <input value="<?= $_POST['fullname'] ?? "" ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="text" id="lname" name="fullname" placeholder="Họ và tên">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['fullname'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <input value="<?= $_POST['email'] ?? "" ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="email" id="fname" name="email" placeholder="Email">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['email'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <input value="<?= $_POST['phone'] ?? "" ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="text" id="lname" name="phone" placeholder="Điện thoại">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['phone'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <input class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="file" id="lname" name="img">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['img'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <input value="<?= $_POST['ngaysinh'] ?? "" ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="date" id="fname" name="ngaysinh" placeholder="Ngày sinh">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['ngaysinh'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <select class="sex w-full" name="sex" id="">
            <option class="" value="Nam" <?= (isset($_POST['sex']) && ($_POST['sex'] == "Nam")) ? "selected" : "" ?>>Nam</option>
            <option class="" value="Nữ" <?= (isset($_POST['sex']) && ($_POST['sex'] == "Nữ")) ? "selected" : "" ?>>Nữ</option>
        </select>
    </div>
    <div class="form-group">
        <input value="<?= $_POST['location'] ?? "" ?>" class="pt-[8px] pb-[8px]  border border-[grey] pl-[16px] w-[100%]" type="text" id="fname" name="location" placeholder="Nhập địa chỉ">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['location'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <input value="<?= $_POST['password'] ?? "" ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px] w-[100%]" type="password" id="lname" name="password" placeholder="Mật khẩu">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['password'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <input value="<?= $_POST['answe-password'] ?? "" ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px] w-[100%]" type="password" id="fname" name="answe-password" placeholder="Nhập lại mật khẩu">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['password_ans'] ?? "" ?></span>
    </div>
    <input name="them" class=" font-bold w-[100%] h-[48px] bg-[black] pt-[8px] pb-[8px] pl-[16px] pr-[16px] text-white rounded-[10px]" type="submit" value="Đăng Ký">
</form>