<?php
session_start();
require "../connect.php";
$email_dn = $_SESSION['email'];
try {
    $sql = "SELECT * from user where email='$email_dn'";
    $run = $connect->prepare($sql);
    $run->execute();
    $data = $run->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi hệ thống";
}


if (isset($_POST['sua'])) {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $ngaysinh = $_POST['ngaysinh'];
    $sex = $_POST['sex'];
    $location = $_POST['location'];
    $password = $_POST['password'];
    $error = [];
    if (empty($fullname)) {
        $error['fullname'] = "Vui lòng nhập họ và tên";
    }
    if (empty($phone)) {
        $error['phone'] = "Vui lòng nhập số điện thoại";
    }
    if ($_FILES['img']['size'] > 0) {
        $duoianh = ['jpg', 'png', 'jpeg', 'gif'];
        $duoi = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        if (!in_array($duoi, $duoianh)) {
            $error['img'] = "File không phải là ảnh";
        } else {
            $img = $_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], "../upload/" . $img);
        }
    } else {
        if (empty($_POST['anh'])) {
            $img = '';
        } else {
            $img = $_POST['anh'];
            move_uploaded_file($_FILES['img']['tmp_name'], "../upload/" . $img);
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
    if (empty($error)) {
        try {
            $sql = "UPDATE user SET `fullname`='$fullname', `password`='$password', `phone`='$phone', `img`='$img', `birthday`='$ngaysinh', `sex`='$sex', `location`='$location'   WHERE email='$email_dn'";
            $run = $connect->prepare($sql);
            $run->execute();
            header("location:./index.php");
        } catch (PDOException $e) {
            echo "Lỗi hệ thống";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật tài khoản</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

</body>

</html>
<form method="post" action="" class="grid grid-cols-1 gap-[20px] w-[80%] m-auto" enctype="multipart/form-data">
    <h3 class="my-[40px] font-bold text-[29px] text-center">CẬP NHẬT TÀI KHOẢN</h3>
    <div class="form-group">
        <label class=" font-normal sm:font-medium md:semibold text-[16px]">Họ và tên</label>
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['fullname']) : ($data['fullname']) ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="text" id="lname" name="fullname" placeholder="Họ và tên">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['fullname'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <label class=" font-normal sm:font-medium md:semibold text-[16px]">Email</label>
        <input value="<?= $data['email'] ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="email" id="fname" name="email" placeholder="Email" disabled>
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['email'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <label class=" font-normal sm:font-medium md:semibold text-[16px]">Số điện thoại</label>
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['phone']) : ($data['phone']) ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="text" id="lname" name="phone" placeholder="Điện thoại">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['phone'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <label class=" font-normal sm:font-medium md:semibold text-[16px]">Ảnh</label>
        <?php if (!empty($data['img'])) { ?>
            <img src="../upload/<?php if (isset($_POST['sua'])) {
                                    if ($_FILES['img']['size'] > 0) {
                                        $duoianh = ['jpg', 'png', 'jpeg', 'gif'];
                                        $duoi = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                                        if (!in_array($duoi, $duoianh)) {
                                            $error['img'] = "File không phải là ảnh";
                                            echo $data['img'];
                                        } else {
                                            echo $_FILES['img']['name'];
                                        }
                                    } else {
                                        echo $_POST['anh'];
                                    }
                                } else {
                                    echo $data['img'];
                                } ?>" alt="" class="h-[100px] w-[100px]">
        <?php } ?>
        <input type="hidden" name="anh" value="<?= $data['img'] ?>">
        <input class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="file" id="lname" name="img">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['img'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <label class=" font-normal sm:font-medium md:semibold text-[16px]">Ngày sinh</label>
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['ngaysinh']) : ($data['birthday']) ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="date" id="fname" name="ngaysinh" placeholder="Ngày sinh">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['ngaysinh'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <label class=" font-normal sm:font-medium md:semibold text-[16px]">Giới tính</label>
        <select class="w-full border-solid border-[1px] border-black p-[10px]" name="sex" id="">
            <option class="" value="Nam" <?php if (isset($_POST['sua'])) {
                                                if ($_POST['sex'] == "Nam") {
                                                    echo "selected";
                                                } else {

                                                    echo "";
                                                }
                                            } else {
                                                if ($data['sex'] == "Nam") {
                                                    echo "selected";
                                                } else {
                                                    echo "";
                                                }
                                            } ?>>Nam</option>
            <option class="" value="Nữ" <?php if (isset($_POST['sua'])) {
                                            if ($_POST['sex'] == "Nữ") {
                                                echo "selected";
                                            } else {

                                                echo "";
                                            }
                                        } else {
                                            if ($data['sex'] == "Nữ") {
                                                echo "selected";
                                            } else {
                                                echo "";
                                            }
                                        } ?>>Nữ</option>
        </select>
    </div>
    <div class="form-group">
        <label class=" font-normal sm:font-medium md:semibold text-[16px]">Địa chỉ</label>
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['location']) : ($data['location']) ?>" class="pt-[8px] pb-[8px]  border border-[grey] pl-[16px] w-[100%]" type="text" id="fname" name="location" placeholder="Nhập địa chỉ">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['location'] ?? "" ?></span>
    </div>

    <div class="form-group">
        <label class=" font-normal sm:font-medium md:semibold text-[16px]">Mật khẩu</label>
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['password']) : ($data['password']) ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px] w-[100%]" type="password" id="lname" name="password" placeholder="Mật khẩu">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['password'] ?? "" ?></span>
    </div>
    <input name="sua" class=" font-bold w-[100%] h-[48px] bg-[black] pt-[8px] pb-[8px] pl-[16px] pr-[16px] text-white rounded-[10px]" type="submit" value="SỬA">
</form>