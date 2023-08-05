<?php
require "../connect.php";
?>
<div class="logo-menu-icon flex justify-between">
    <div class="logo">
        <a href="index.php"><img src="img/logo-black.png"></a>
    </div>
    <div class="menu flex justify-between items-center ">
        <ul class="mr-4 uppercase"><a href="index.php">ICE COTTON</a></ul>
        <?php
        $listCate = $connect -> query ("select * from category limit 5") -> fetchAll();
        foreach($listCate as $li) { ?>
        <ul class="mx-4 uppercase"><a href="./loaihang.php?id=<?=$li['id_category']?>"><?=$li['name_category']?></a></ul>
        <?php } ?>
        <ul class="mx-4 uppercase"><a href="loaihang.php">BỘ SƯU TẬP</a></ul>
        <ul class="ml-4 uppercase"><a href="">VỀ CHÚNG TÔI</a></ul>
    </div>
    <div class="icon flex justify-between items-center">
        <i class="mr-2 fa-solid fa-magnifying-glass"></i>
        <a href="../admin/"><i class="mx-2 fa-regular fa-circle-user"></i></a>
        <a href="cart.php"><i class="ml-2 fa-solid fa-bag-shopping"></i></a>
    </div>
</div>