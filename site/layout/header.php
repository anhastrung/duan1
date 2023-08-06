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
        <div class="user relative inline-block dropdown cursor-pointer">
            <div class="dropbtn flex justify-start items-center gap-1">
                <a href="<?php if(!isset($_SESSION['user'])) echo "./login.php" ?>">
                <i class="mx-2 fa-regular fa-circle-user"></i>
                </a>
            </div>
            <?php
            if (isset($_SESSION['user'])) {
            ?>
                <form method="post" class="dropdown-content hidden absolute bg-[#f9f9f9] left-[-60px]">
                    <a class="block text-black my-2 hover:text-red-500 text-center min-w-[160px] hover:bg-[#f1f1f1] active:text-green-300" href="?site=update">Cập nhật tài khoản</a>
                    <?php if ($role == "admin") { ?>
                        <a class="block text-black my-2 hover:text-red-500 text-center min-w-[160px] hover:bg-[#f1f1f1] active:text-green-300" href="../admin/">Quản lý trang web</a>
                    <?php } ?>
                    <button class="block text-black my-2 hover:text-red-500 text-center min-w-[160px] hover:bg-[#f1f1f1] active:text-green-300" name="log-out">Thoát</button>
                </form>
            <?php
            }
            ?>
        </div>
        <a href="cart.php"><i class="ml-2 fa-solid fa-bag-shopping"></i></a>
    </div>
</div>