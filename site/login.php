<?php
if (isset($_POST['login'])) {
    $user = trim($_POST['user']);
    $password = trim($_POST['password']);
    $sql = "select * from user where username = '$user' and password = '$password'";
    $query = $connect->query($sql)->fetch();
    if (empty($query)) {
        $mess = "Tài khoản hoặc mật khẩu không đúng";
    }
    if (empty($mess)) {
        $_SESSION['user'] = $query;
        header("location:?site=home");
    }
}

if (isset($_SESSION['user'])) {
    header("location:?site=home");
}
?>
<div class="content ">
    <h3 class="mb-[32px]">Trang chủ > Đăng nhập</h3>
    <h3 class="font-bold mt-[32px] mb-[32px] text-[30px]">Tài khoản của tôi</h3>
    <div class="login-register  flex justify-center ">
        <div class="login w-[444px] h-[380]">
            <h3 class="font-bold">BẠN ĐÃ CÓ TÀI KHOẢN METAGENT ?</h3>
            <p class="mt-[16px] mb-[16px]">Nếu bạn đã có tài khoản, hãy đăng nhập để tích lũy điểm thành viên và nhận được những ưu đãi tốt hơn!</p>
            <form action="" method="post">
                <p class="bg-[#fef7e4] py-2 px-3 text-yellow-800 text-lg rounded-[5px] <?php if (empty($mess)) echo "hidden" ?>"><?= $mess ?></p>
                <input class="pt-[8px] pb-[8px] border border-[grey] pl-[16px] pr-[220px]" type="text" id="fname" name="user" value="<?php if (isset($_POST['user'])) echo $_POST['user'] ?>" placeholder="Username"><br>
                <br>
                <input class="pt-[8px] pb-[8px] border border-[grey] pl-[16px] pr-[220px]" type="password" id="lname" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password'] ?>" placeholder="Password"><br>
                <br>
                <p><input type="radio"> Ghi nhớ Đăng Nhập</p>
                <div class="flex justify-between items-center">
                    <p><a href="?site=forgotpass">Quên mật khẩu?</a></p>
                    <input class="font-bold w-[160px] h-[48px] mr-[26px] border border-[grey] pt-[8px] pb-[8px] pl-[16px] pr-[16px] bg-black text-white rounded-[5px]" name="login" type="submit" value="Đăng Nhập">
                </div>
            </form>
        </div>
        <div class="register w-[390] h-[380] p-[30px] bg-[black] ml-[28px] ">
            <h3 class="text-[white] font-bold">TẠO TÀI KHOẢN MỚI</h3>
            <p class="text-[white] mt-[16px]">Trở thành thành viên METAGENT để nhận được</p>
            <p class="text-[white] mt-[16px] "><i class="fa-solid fa-circle-check mr-[7px] "></i>Tích điểm tự động</p>
            <p class="text-[white] mt-[16px] "><i class="fa-solid fa-circle-check mr-[7px] "></i>Nhiều ưu đãi đặc biệt</p>
            <p class="text-[white] mt-[16px] "><i class="fa-solid fa-circle-check mr-[7px] "></i>Thông tin mới nhất</p>
            <a href="?site=register"><input class="font-bold w-[160px] h-[48px]  mt-[45px] mr-[26px] bg-[white] pt-[8px] pb-[8px] pl-[16px] pr-[16px] ml-[220px] rounded-[5px]" type="submit" value="Đăng Ký"></a>
        </div>
    </div>
    <div class="posts">
        <p class="p-[32px]">Thông tin cá nhân thu thập được sẽ chỉ được sử dụng với mục đích đã công bố tại <a href="#">Chính sách bảo vệ thông tin cá nhân <br> của người tiêu dùng</a>. METAGENT cam kết không bán, chia sẻ hay trao đổi thông tin cá nhân của khách
            hàng thu thập <br> trên trang web cho một bên thứ ba nào khác trái quy định pháp luật.
        </p>
    </div>
</div>