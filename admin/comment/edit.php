<?php
$id = $_GET['id'];
try {
    $sql = "select u.fullname, p.name_product, c.noidung_comment,c.traloi_comment,c.ngay_bl,c.id_comment from comment c join user u on c.id_user=u.id_user join product p on c.id_product=p.id_product;";
    $run = $connect->prepare($sql);
    $run->execute();
    $data = $run->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi hệ thống";
}
if (isset($_POST['sua'])) {
    $traloi_comment = $_POST['comment_tl'];
    $ngay_tl = date('Y/m/d');
    try {
        $sql = "UPDATE comment SET `traloi_comment`='$traloi_comment', `ngay_tl`='$ngay_tl' WHERE id_comment=$id";
        $run = $connect->prepare($sql);
        $run->execute();
        header("location:?site=list");
    } catch (PDOException $e) {
        echo "Lỗi hệ thống";
    }
}
?>

<form method="post" action="" class="grid grid-cols-1 gap-[20px] w-[80%] m-auto" enctype="multipart/form-data">
    <h3 class="my-[40px] font-bold text-[29px]">SỬA COMMENT</h3>
    <div class="form-group">
        <input value="<?= $data['fullname'] ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="text" id="fname" disabled>
    </div>
    <div class="form-group">
        <input value="<?= $data['name_product'] ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="text" id="lname" disabled>
    </div>
    <div class="form-group">
        <input value="<?= $data['ngay_bl'] ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="date" id="lname" name="ngay_bl" disabled>
    </div>
    <div class="form-group">
        <input value="<?= $data['noidung_comment'] ?>" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]" type="text" id="lname" disabled>
        <span class=" font-normal sm:font-medium md:semibold text-[16px] text-red-600"><?= $error['fullname'] ?? "" ?></span>
    </div>
    <div class="form-group">
        <textarea name="comment_tl" id="" cols="30" rows="3" class="pt-[8px] pb-[8px] border border-[grey] pl-[16px]  w-[100%]"><?= ($data['traloi_comment']) ?? "" ?></textarea>
    </div>
    <input name="sua" class=" font-bold w-[100%] h-[48px] bg-[black] pt-[8px] pb-[8px] pl-[16px] pr-[16px] text-white rounded-[10px]" type="submit" value="SỬA">
</form>