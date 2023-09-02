<?php
if (isset($_GET['search'])) {
    if (!$_GET['site'] == "category") {
        $search = $_GET['search'];
        header("location:?site=category&search=$search");
    }
}
$accept = [
    "image/png",
    "image/jpeg",
    "image/jpg",
    "image/gif",
];
require "../connect.php";
if (isset($_POST['log-out'])) {
    unset($_SESSION['user']);
}
$url = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $VIEW_NAME ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style.css">
</head>

<body class="px-28">
    <div class="container m-auto">
        <header class="mb-[32px]">
            <?php require "./layout/header.php" ?>
        </header>
        <main>
            <?php require $VIEW_NAME . ".php" ?>
        </main>
        <footer class="mt-[120px]">
            <?php require "./layout/footer.php" ?>
        </footer>
    </div>
    <script>
        let minus = document.querySelectorAll(".minus");
        let value = document.querySelectorAll(".value");
        let plus = document.querySelectorAll(".plus");
        for (let index = 0; index < minus.length; index++) {
            minus[index].addEventListener("click", function() {
                if (Number(value[index].value) == 1) {
                    value[index].value = 1
                } else {
                    value[index].value = Number(value[index].value) - 1
                }
            })
            plus[index].addEventListener("click", function() {
                value[index].value = Number(value[index].value) + 1
            })
        }
        let desall = document.querySelectorAll(".content-right-suppost");
        let check = document.querySelectorAll(".fa-chevron-down");
        desall.forEach((item, index) => {
            return item.addEventListener("click", function() {
                check[index].classList.toggle("rotate");
                item.classList.toggle("toggle");
            });
        });
    </script>
</body>

</html>