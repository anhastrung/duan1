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
    <div class="icon flex justify-between items-center">
        <i class="mr-2 fa-solid fa-magnifying-glass"></i>
        <?php if (!isset($_SESSION['role'])) {
            echo '<a href="./login.php"><i class="mx-2 fa-regular fa-circle-user></i></a>';
        } else { ?>
            <span class="relative cursor-pointer" id="user">Hello <?= $data['fullname'] ?></span>
            <ul class="hidden absolute top-[60px] border-x-2 border-b-2 border-solid border-[#0ef] rounded-bl-[10px] rounded-br-[10px]" id="Navbaruser">
                <li class="block mx-3"><a class="text-[20px] font-semibold  hover:text-red-600 text-center" href="./cn-user.php">Cập nhật tài khoản</a></li>
                <?php if (strcasecmp($data['role'], "admin") == 0) { ?>
                    <li class="block mx-3"><a class="text-[20px] font-semibold hover:text-red-600 flex justify-center" href="#">Admin</a></li>
                <?php } ?>
                <a href="./logout.php"><button class="flex justify-center text-[20px] font-semibold hover:text-red-600  text-center m-auto">Thoát</button></a>
            </ul>
        <?php } ?>
        <a href="cart.php"><i class="ml-2 fa-solid fa-bag-shopping"></i></a>
    </div>
</div>