<?php
require "../connect.php";
if (isset($_POST['log-out'])) {
    unset($_SESSION['user']);
}
?>
<style>
    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
<div class="logo-menu-icon flex justify-between">
    <div class="logo">
        <a href="index.php"><img src="img/logo-black.png"></a>
    </div>
    <div class="menu flex justify-between items-center ">
        <ul class="mr-4 uppercase"><a href="index.php">ICE COTTON</a></ul>
        <?php
        $listCate = $connect->query("select * from category limit 5")->fetchAll();
        foreach ($listCate as $li) { ?>
            <ul class="mx-4 uppercase"><a href="./loaihang.php?id=<?= $li['id_category'] ?>"><?= $li['name_category'] ?></a></ul>
        <?php } ?>
        <ul class="mx-4 uppercase"><a href="loaihang.php">BỘ SƯU TẬP</a></ul>
        <ul class="ml-4 uppercase"><a href="">VỀ CHÚNG TÔI</a></ul>
    </div>
    <form action="" method="get" class="px-3 py-2">
        <input type="text" placeholder="Từ khoá tìm kiếm" name="search" class="focus:outline-none" onchange="submit()">
        <i class="mr-2 fa-solid fa-magnifying-glass"></i>
    </form>
    <div class="icon flex justify-between items-center">
        <?php if (!isset($_SESSION['user'])) {
            echo '<a href="./login.php"><i class="mx-2 fa-regular fa-circle-user"></i></a>';
        } else { ?>
            <span class="relative cursor-pointer" id="user">Hello <?= $fullname ?></span>
            <form method="post" class="hidden absolute top-[60px] border-x-2 border-b-2 border-solid border-[#0ef] rounded-bl-[10px] rounded-br-[10px]" id="Navbaruser">
                <a class="text-[20px] font-semibold  hover:text-red-600 text-center" href="./cn-user.php">Cập nhật tài khoản</a>
                <?php if (strcasecmp($role, "admin") == 0) { ?>
                    <a class="text-[20px] font-semibold hover:text-red-600 flex justify-center" href="../admin/">Admin</a>
                <?php } ?>
                <button class="flex justify-center text-[20px] font-semibold hover:text-red-600  text-center m-auto" name="log-out">Thoát</button>
            </form>
        <?php } ?>
        <a href="cart.php">
            <i class="fa fa-shopping-cart ml-2 relative">
                <div class="absolute bottom-2.5 left-3 text-[10px] text-red-400 bg-white p-1 rounded-[30px] border-red-500 border-[1px]">1</div>
            </i>
        </a>
    </div>
</div>
<script>
    document.getElementById('user').onclick = function() {
        var menuMobile = document.getElementById('Navbaruser').classList;
        menuMobile.toggle('hidden');
    }
</script>