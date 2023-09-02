<nav class="flex justify-between">
    <div class="menu flex justify-between items-center ">
        <ul class="mr-4 uppercase"><a href="?site=home">Trang chủ</a></ul>
        <?php
        $listCate = $connect->query("select * from category limit 5")->fetchAll();
        foreach ($listCate as $li) { ?>
            <ul class="mx-4 uppercase"><a href="?site=category&id=<?= $li['id_category'] ?>"><?= $li['name_category'] ?></a></ul>
        <?php } ?>
        <ul class="mx-4 uppercase"><a href="?site=category">BỘ SƯU TẬP</a></ul>
        <ul class="ml-4 uppercase"><a href="">VỀ CHÚNG TÔI</a></ul>
    </div>
    <div class="icon flex justify-between items-center">
        <form action="" method="get" class="px-3 py-2">
            <input type="text" placeholder="Từ khoá tìm kiếm" name="search" class="focus:outline-none" onchange="submit()">
            <i class="mr-2 fa-solid fa-magnifying-glass"></i>
        </form>
        <div class="user relative inline-block dropdown cursor-pointer">
            <i class="mx-2 fa-regular fa-circle-user"></i>
            <form method="post" class="dropdown-content hidden absolute bg-[#f9f9f9] left-[-60px]">
                <?php if (isset($_SESSION['user'])) { ?>
                    <?php if ($role == "1") { ?>
                        <a class="block text-black my-2 hover:text-red-500 text-center min-w-[160px] hover:bg-[#f1f1f1] active:text-green-300" href="../admin/">Quản lý trang web</a>
                    <?php } ?>
                    <a class="block text-black my-2 hover:text-red-500 text-center min-w-[160px] hover:bg-[#f1f1f1] active:text-green-300" href="?site=update">Cập nhật tài khoản</a>
                    <a class="block text-black my-2 hover:text-red-500 text-center min-w-[160px] hover:bg-[#f1f1f1] active:text-green-300" href="?site=userbill">Hóa đơn</a>
                    <button class="block text-black my-2 hover:text-red-500 text-center min-w-[160px] hover:bg-[#f1f1f1] active:text-green-300" name="log-out">Thoát</button>
                <?php } else { ?>
                    <a class="block text-black my-2 hover:text-red-500 text-center min-w-[160px] hover:bg-[#f1f1f1] active:text-green-300" href="?site=login">Đăng nhập</a>
                    <a class="block text-black my-2 hover:text-red-500 text-center min-w-[160px] hover:bg-[#f1f1f1] active:text-green-300" href="?site=register">Đăng ký</a>
                <?php } ?>
            </form>
        </div>
        <?php
        if (isset($_SESSION['user'])) {
            $sql = "select img, name_product, number, cart.id_product, number_product, price_product, id_cart from cart inner join product on product.id_product = cart.id_product where id_user = $id_user";
            $listProduct = $connect->query($sql)->fetchAll();
            $tong = 0;
            foreach ($listProduct as $li) {
                $tong = $tong + $li['price_product'] * $li['number'];
            }
        }
        ?>
        <a href="?site=cart">
            <i class="fa fa-shopping-cart relative">
                <div class="absolute bottom-2 left-4 text-[16px] text-red-400"><?php if (isset($_SESSION['user'])) echo count($listProduct) ?></div>
            </i>
        </a>
    </div>
</nav>