<?php
$sql = "select * from product";
$site = "?site=category";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = $sql . " " . "where name_product like '%$search%'";
    $site = $site . "&search=$search";
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = $sql . " " . "where id_category = $id";
    $site = $site . "&id=$id";
}
if (isset($_GET['arrange'])) {
    if ($_GET['arrange'] == "old") {
        $sql = $sql . " " . "order by id_product asc";
    } else if ($_GET['arrange'] == "view") {
        $sql = $sql . " " . "order by luotxem desc";
    } else if ($_GET['arrange'] == "priceup") {
        $sql = $sql . " " . "order by price_product asc";
    } else if ($_GET['arrange'] == "pricedown") {
        $sql = $sql . " " . "order by price_product desc";
    } else {
        $sql = $sql . " " . "order by id_product desc";
    }
    $arrange = $_GET['arrange'];
    $site = $site . "&arrange=$arrange";
} else {
    $sql = $sql . " " . "order by id_product desc";
}
$limitPage = 8;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 0;
}
$productPage = $page * $limitPage;
$listProduct = $connect->query($sql . " limit $productPage,$limitPage")->fetchAll();
$maxPage = count($connect->query($sql)->fetchAll());
if ($maxPage % $limitPage == 0) {
    $maxPage = $maxPage / $limitPage - 1;
} else {
    $maxPage = floor($maxPage / $limitPage);
}
?>
<div class="content ">
    <h3 class="mb-[32px]">Trang chủ > Tất cả Sản Phẩm</h3>
    <div class="ilter-arrange flex">
        <form action="" method="get">
            <?php 
            if (isset($_GET['site'])) {
                echo "<input type='text' name='site' value='category' hidden>";
            }
            else if (isset($_GET['search'])) {
                echo "<input type='text' name='search' value='$search' hidden>";
            } else if (isset($_GET['id'])) {
                echo "<input type='text' name='id' value='$id' hidden>";
            } ?>
            <select class="border border-[grey] p-[6px] rounded-[5px]" name="arrange" id="" onchange="submit()">
                <option value="new" <?php if (isset($_GET['arrange']) && $arrange == "new") echo "selected" ?>>Mới nhất</option>
                <option value="old" <?php if (isset($_GET['arrange']) && $arrange == "old") echo "selected" ?>>Cũ nhất</option>
                <option value="view" <?php if (isset($_GET['arrange']) && $arrange == "view") echo "selected" ?>>Được xem nhiều nhất</option>
                <option value="priceup" <?php if (isset($_GET['arrange']) && $arrange == "priceup") echo "selected" ?>>Giá: từ Thấp - Cao</option>
                <option value="pricedown" <?php if (isset($_GET['arrange']) && $arrange == "pricedown") echo "selected" ?>>Giá: từ Cao - Thấp</option>
            </select>
        </form>
    </div>
    <div class="grid grid-cols-4 gap-4 mt-[30px]">
        <?php foreach ($listProduct as $li) { ?>
            <div>
                <a href="?site=product&id=<?= $li['id_product'] ?>"><img class="w-full hover:animate-pulse" src="../upload/<?= $li['img'] ?>"></a>
                <p class="text-center"><?= $li['name_product'] ?></p>
                <p class="text-center"><?= number_format($li['price_product']) ?>đ</p>
                <div class="input1 ml-[95px]">
                    <input class="mt-[3px] mb-[3px] mr-[5px] ml-[5px]" type="radio">
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="pagination text-center my-4">
        <a href="<?php if ($page > 0) echo "$site&page=" . $page - 1 ?>">&laquo;</a>
        <?php for ($i = 0; $i < $maxPage + 1; $i++) { ?>
            <a href="<?= $site ?>&page=<?= $i ?>" class="<?php if ($i == $page) echo "active" ?>"><?= $i + 1 ?></a>
        <?php } ?>
        <a href="<?php if ($page < $maxPage) echo "$site&page=" . $page + 1 ?>">&raquo;</a>
    </div>
    <h1 class="font-bold text-[32px] text-center m-[32px] uppercase">top LƯỢT XEM</h1>
    <div class="my-slider" style="display: flex; gap: 15px">
        <?php
        $listProduct = $connect->query("select * from product order by luotxem desc limit 10");
        foreach ($listProduct as $li) { ?>
            <div class="col mb-4">
                <div class="card">
                    <a href="?site=product&id=<?= $li['id_product'] ?>" class=" "><img src="<?= "../upload/" . $li['img'] ?>" class="card-img-top w-full hover:animate-pulse"></a>
                    <div class="main-product-sale">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title h-50 text-center">
                            <?= $li['name_product'] ?>
                        </h5>
                        <p class="text-center font-bold  "><?= number_format($li['price_product']) ?>đ <i class="fa-solid fa-cart-arrow-down ml-[10px]"></i></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<script>
    var slider = document.querySelector(".my-slider");
    var tns = tns({
        container: slider,
        loop: false,
        responsive: {
            350: {
                items: 2,
            },
            500: {
                items: 4,
            },
        },
        swipeAngle: false,
        speed: 400,
    });
    let next = document.querySelector(".tns-controls button:last-child");
    let prev = document.querySelector(".tns-controls button:first-child");
    next.innerHTML = "&#62;"
    prev.innerHTML = "&#60;"
</script>