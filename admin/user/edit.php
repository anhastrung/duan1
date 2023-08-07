<?php
$id = $_GET['id'];
try {
    $sql = "SELECT * from user where id_user=$id";
    $run = $connect->prepare($sql);
    $run->execute();
    $data = $run->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi hệ thống";
}


if (isset($_POST['sua'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $anh = $_POST['anh'];
    $ngaysinh = $_POST['ngaysinh'];
    $sex = $_POST['sex'];
    $kichhoat = $_POST['kich-hoat'];
    $location = $_POST['location'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $password_ans = $_POST['answe-password'];
    $error = [];
    if (empty($fullname)) {
        $error['fullname'] = "Vui lòng nhập họ và tên";
    }
    if (empty($email)) {
        $error['email'] = "Vui lòng nhập email";
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
    if (empty($password_ans)) {
        $error['password_ans'] = "Vui lòng nhập lại mật khẩu";
    } else {
        if ($password_ans != $password) {
            $error['password_ans'] = "Mật khẩu không khớp";
        }
    }
    if (empty($error)) {
        try {
            $sql = "UPDATE user SET `fullname`='$fullname', `email`='$email', `password`='$password', `phone`='$phone', `img`='$img', `birthday`='$ngaysinh', `sex`='$sex', kichhoat=$kichhoat, `location`='$location',  `role`='$role' WHERE id_user=$id";
            $run = $connect->prepare($sql);
            $run->execute();
            move_uploaded_file($_FILES['img']['tmp_name'], "../../upload/" . $img);
            header("location:?site=list");
        } catch (PDOException $e) {
            echo "Lỗi hệ thống";
        }
    }
}
?>

<form method="post" action="" class="grid grid-cols-1 gap-[20px] w-[80%] m-auto" enctype="multipart/form-data">
    <h3 class="my-[40px] font-bold text-[29px]">SỬA TÀI KHOẢN</h3>
    <div class="form-group">
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['fullname']) : ($data['fullname']) ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="text" id="lname" name="fullname" placeholder="Họ và tên">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['fullname'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['email']) : ($data['email']) ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="email" id="fname" name="email" placeholder="Email">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['email'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['phone']) : ($data['phone']) ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="text" id="lname" name="phone" placeholder="Điện thoại">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['phone'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <?php if (!empty($data['img'])) { ?>
            <img src="../../upload/<?php if (isset($_POST['sua'])) {
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
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['ngaysinh']) : ($data['birthday']) ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="date" id="fname" name="ngaysinh" placeholder="Ngày sinh">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['ngaysinh'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <select class="h-[50px] w-full border-solid border-[1px] p-[10px]" name="sex" id="">
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
        <select class="h-[50px] w-full border-solid border-[1px] p-[10px]" name="kich-hoat" id="">
            <option class="" value="0" <?php if (isset($_POST['sua'])) {
                                            if ($_POST['kich-hoat'] == "0") {
                                                echo "selected";
                                            } else {

                                                echo "";
                                            }
                                        } else {
                                            if ($data['kichhoat'] == "0") {
                                                echo "selected";
                                            } else {
                                                echo "";
                                            }
                                        } ?>>Cho dùng</option>
            <option class="" value="1" <?php if (isset($_POST['sua'])) {
                                            if ($_POST['kich-hoat'] == "1") {
                                                echo "selected";
                                            } else {

                                                echo "";
                                            }
                                        } else {
                                            if ($data['kichhoat'] == "1") {
                                                echo "selected";
                                            } else {
                                                echo "";
                                            }
                                        } ?>>Tắt hoạt động</option>
        </select>
    </div>
    <div class="form-group">
        <select class="h-[50px] w-full border-solid border-[1px] p-[10px]" name="role" id="">
            <option class="" value="user" <?php if (isset($_POST['sua'])) {
                                                if ($_POST['role'] == "user") {
                                                    echo "selected";
                                                } else {

                                                    echo "";
                                                }
                                            } else {
                                                if ($data['role'] == "0") {
                                                    echo "selected";
                                                } else {
                                                    echo "";
                                                }
                                            } ?>>Người dùng</option>
            <option class="" value="admin" <?php if (isset($_POST['sua'])) {
                                                if ($_POST['role'] == "admin") {
                                                    echo "selected";
                                                } else {

                                                    echo "";
                                                }
                                            } else {
                                                if ($data['role'] == "admin") {
                                                    echo "selected";
                                                } else {
                                                    echo "";
                                                }
                                            } ?>>Quản trị viên</option>
        </select>
    </div>
    <div class="form-group">
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['location']) : ($data['location']) ?>" class="pt-[8px] pb-[8px]  border border-[grey] pl-[16px] w-[100%]" type="text" id="fname" name="location" placeholder="Nhập địa chỉ">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['location'] ?? "" ?></span>
    </div>

    <div class="form-group">
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['password']) : ($data['password']) ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px] w-[100%]" type="password" id="lname" name="password" placeholder="Mật khẩu">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['password'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <input value="<?= (isset($_POST['sua'])) ? ($_POST['answe-password']) : ($data['password']) ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px] w-[100%]" type="password" id="fname" name="answe-password" placeholder="Nhập lại mật khẩu">
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['password_ans'] ?? "" ?></span>
    </div>
    <input name="sua" class=" font-bold w-[100%] h-[48px] bg-[black] pt-[8px] pb-[8px] pl-[16px] pr-[16px] text-white rounded-[10px]" type="submit" value="SỬA">
</form>