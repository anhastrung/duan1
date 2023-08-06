<?php
session_start();
require_once "../connect.php";
if (isset($_POST['dang-ky'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
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
        $sql = "INSERT INTO `user` (`fullname`, `email`, `password`, `phone`, `birthday`, `sex`, `location`) VALUES ('$fullname', '$email', '$password', '$phone', '$ngaysinh', '$sex', '$location')";
        $run = $connect->prepare($sql);
        $run->execute();
        echo "thêm rồi";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>
    <link rel="stylesheet" href="signup.js">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .sex {
            border: 1px solid #808080;
            width: 100%;
            padding-top: 8px;
            padding-bottom: 8px;
            padding-left: 10px;
        }
    </style>


</head>

<body>

    <div class="">
        <header class="mb-[32px]">
            <?php require "./layout/header.php" ?>
        </header>

        <div class="content ">
            <div class="tittal text-center">
                <h3 class="mb-[32px]">Trang chủ > Đăng ký</h3>

                <h3 class="font-bold text-[29px]">TẠO TÀI KHOẢN MỚI</h3>
                <p class="mt-[22px] mb-[22px]">Tạo tài khoản để theo dõi đơn đặt hàng, quản lý danh sách yêu thích và lưu thông tin thanh toán của bạn để thanh toán nhanh hơn. <br> Nếu bạn đã có tài khoản <a class="hover" href="#">Bấm vào đây</a> để đăng nhập.</p>
            </div>
            <div class="new-content flex justify-center ">
                <div class="items w-[70%] h-[550px] mr-[20px]">

                    <form method="post" action="" class="grid grid-cols-2 gap-[20px]">
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
                            <input value="<?= $_POST['ngaysinh'] ?? "" ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="date" id="fname" name="ngaysinh" placeholder="Ngày sinh">
                            <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['ngaysinh'] ?? "" ?></span>
                        </div>
                        <div class="form-group">
                            <select class="h-[50px] w-full border-solid border-[1px] p-[10px]" name="sex" id="">
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
                        <input name="dang-ky" class="col-start-1 col-span-2 font-bold w-[100%] h-[48px] bg-[black] pt-[8px] pb-[8px] pl-[16px] pr-[16px] text-white rounded-[10px]" type="submit" value="Đăng Ký">
                    </form>
                </div>
            </div>
            <footer class="mt-[120px]">
                <div class="flex justify-between">
                    <div class="w-[350px]">
                        <div class="img flex">
                            <img class="w-[175px] h-[25px]" src="img/logo-black.png" alt="">
                            <img class="w-[107px] h-[40px]" src="img/img-congthuong.png" alt="">
                        </div>
                        <p class=" mt-[16px] mb-[16px] text-[12px]">Công ty TNHH Dự Tài</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]"><span class="font-bold">Địa chỉ đăng ký: </span>Lô L3, Khu công nghiệp dệt may Phố Nối B, Phường Dị Sử, Thị xã Mỹ Hào, Tỉnh Hưng Yên, Việt Nam</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]"><span class="font-bold"> Số điện thoại:</span> 031724102485101</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]"><span class="font-bold">Ngày cấp: </span> 22/03/2019</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]"><span class="font-bold">Nơi cấp:</span> Phòng Đăng kí kinh doanh - Sở kế hoạch đầu tư tỉnh Hưng Yên</p>
                        <div class="mt-[16px] mb-[16px] text-[12px]  flex">
                            <img class=" w-[30px] h-[30px]" src="img/facebook.png" alt="">
                            <img class=" ml-[16px] w-[30px] h-[30px]" src="img/tiktok.png" alt="">
                            <img class=" ml-[16px] w-[30px] h-[30px]" src="img/intagram.jpg" alt="">
                        </div>
                        <div class="mt-[16px] mb-[16px] text-[12px]   ">
                            <p class="font-bold pl-[32px] bg-[black] w-[228px] h-[40px] pl-[10px] pt-[10px] text-[#F7F8F9]">HOTLINE: <span class=" ml-[8px]">0348481132999</span></p>
                        </div>
                    </div>
                    <div class="w-[140px] ml-[16px]">
                        <h3 class=" mb-[30px]  font-bold">GIỚI THIỆU</h3>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Về Metagent</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Tuyển dụng</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Hệ thống cửa hàng</p>
                    </div>
                    <div class="w-[80px] ml-[16px]">
                        <h3 class="mb-[30px] font-bold">LIÊN HỆ</h3>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Hotline</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Email</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Email</p>
                    </div>
                    <div class="w-[340px] ml-[16px]">
                        <h3 class="mb-[30px] font-bold">DỊCH VỤ KHÁCH HÀNG</h3>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Tra cứu đơn hàng</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Chính sách thẻ thành viên</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Chính sách bảo hành</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Chính sách đổi trả</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Chính sách giao nhận vận chuyển</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Quyền và nghĩa vụ khách hàng</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Bảo vệ thông tin cá nhân của người tiêu dùng</p>
                        <p class="mt-[16px] mb-[16px] text-[12px]">Chính sách thanh toán</p>
                    </div>
                    <div class="w-[300px] ">
                        <h3 class="mb-[30px] font-bold">ĐĂNG KÝ NHẬN THÔNG TIN</h3>
                        <button class="border border-[black]"><input class="m-[10px]" type="text" placeholder="Nhập Email "> <i class="m-[10px] fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>

                <div class="text-center">
                    <hr>
                    <p class=" p-[24px]">All rights Reserved <i class="m-[10px] fa-regular fa-copyright"></i><span class="font-bold">Metagent 2022</span></p>
                </div>
            </footer>

        </div>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./signup.js"></script>



</html>