<?php
session_start();
require_once "../connect.php";
if (isset($_POST['dang-nhap'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error = [];
    if (empty($password)) {
        $error['password'] = "Vui lòng nhập mật khẩu";
    }
    if (empty($email)) {
        $error['email'] = "Vui lòng nhập tên email";
    } else {
        try {
            $sql = "SELECT * FROM user where email = '$email'";
            $run = $connect->prepare($sql);
            $run->execute();
            $data = $run->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error['email'] = "Lỗi hệ thống" . $e->getMessage();
        }
        if ($data) {
            if ($password == $data['password']) {
                if ($data['role'] == 'admin') {
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['role'] = $data['role'];
                    header("location:../admin");
                    die;
                } else {
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['role'] = $data['role'];
                    header("location:./index.php");
                    die;
                }
            } else {
                $error['password'] = "Password không đúng";
            }
        } else {
            $error['email'] = "Email không tồn tại";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" />
</head>

<body>
    <div class="container w-[1440x] m-auto">
        <header class="mb-[32px]">
            <?php require "./layout/header.php" ?>
        </header>

        <div class="content ">
            <h3 class="mb-[32px]">Trang chủ > Đăng nhập</h3>
            <h3 class="font-bold mt-[32px] mb-[32px] text-[30px]">Tài khoản của tôi</h3>

            <div class="login-register  flex justify-center ">
                <div class="login w-[444px] h-[380]">
                    <h3 class="font-bold">BẠN ĐÃ CÓ TÀI KHOẢN METAGENT ?</h3>
                    <p class="mt-[16px] mb-[16px]">Nếu bạn đã có tài khoản, hãy đăng nhập để tích lũy điểm thành viên và nhận được những ưu đãi tốt hơn!</p>
                    <form action="" method="post">
                        <input class="pt-[8px] pb-[8px] border border-[grey] pl-[16px] pr-[220px]" type="text" id="fname" name="email" value="<?= $_POST['email'] ?? "" ?>" placeholder="Email"><br>
                        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['email'] ?? "" ?></span>
                        <input class="pt-[8px] pb-[8px] border border-[grey] pl-[16px] pr-[220px]" type="password" id="lname" name="password" value="<?= $_POST['password'] ?? "" ?>" placeholder="Mật khẩu"><br>
                        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['password'] ?? "" ?></span>
                        <p><input type="radio"> Ghi nhớ Đăng Nhập</p>
                        <div class="flex justify-between items-center">
                            <p><a href="#">Quên mật khẩu?</a></p>
                            <input class="font-bold w-[160px] h-[48px] mr-[26px] border border-[grey] pt-[8px] pb-[8px] pl-[16px] pr-[16px] bg-black text-white rounded-[5px]" name="dang-nhap" type="submit" value="Đăng Nhập">
                        </div>
                    </form>

                </div>
                <div class="register w-[390] h-[380] p-[30px] bg-[black] ml-[28px] ">
                    <h3 class="text-[white] font-bold">TẠO TÀI KHOẢN MỚI</h3>
                    <p class="text-[white] mt-[16px]">Trở thành thành viên METAGENT để nhận được</p>
                    <p class="text-[white] mt-[16px] "><i class="fa-solid fa-circle-check mr-[7px] "></i>Tích điểm tự động</p>
                    <p class="text-[white] mt-[16px] "><i class="fa-solid fa-circle-check mr-[7px] "></i>Nhiều ưu đãi đặc biệt</p>
                    <p class="text-[white] mt-[16px] "><i class="fa-solid fa-circle-check mr-[7px] "></i>Thông tin mới nhất</p>
                    <a href="./signup.php"><input class="font-bold w-[160px] h-[48px]  mt-[45px] mr-[26px] bg-[white] pt-[8px] pb-[8px] pl-[16px] pr-[16px] ml-[220px] rounded-[5px]" type="submit" value="Đăng Ký"></a>
                </div>

            </div>
            <div class="posts">
                <p class="p-[32px]">Thông tin cá nhân thu thập được sẽ chỉ được sử dụng với mục đích đã công bố tại <a href="#">Chính sách bảo vệ thông tin cá nhân <br> của người tiêu dùng</a>. METAGENT cam kết không bán, chia sẻ hay trao đổi thông tin cá nhân của khách
                    hàng thu thập <br> trên trang web cho một bên thứ ba nào khác trái quy định pháp luật.

                </p>
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

</html>