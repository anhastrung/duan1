<?php
session_start();
if (isset($_SESSION['user'])) {
    extract($_SESSION['user']);
}
require "../connect.php";
if (isset($_SESSION['role'])) {
    $email_dn = $_SESSION['email'];
    try {
        $sql = "SELECT * FROM user where email = '$email_dn'";
        $run = $connect->prepare($sql);
        $run->execute();
        $data = $run->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trangChu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" />
    <style>
        * {
            box-sizing: border-box
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        .tns-outer {
            position: relative;
        }

        .tns-controls {
            width: 104%;
            position: absolute;
            top: 39%;
            left: -2.4%;
            z-index: 10;
            display: flex;
            justify-content: space-between;
        }

        .tns-controls button {
            width: 30px;
            height: 30px;
            border: none;
            border-radius: 50%;
            box-shadow: 0 0 20px blue;
            background-color: #bbb;
            color: white;
        }

        .tns-nav {
            display: none;
        }

        .box-image {
            width: 500px;
            height: 550px;
            background-image: url("./img/anh-bgImage.jpg");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box-image-flex h3 {
            text-align: center;
        }

        .about-prod--title {
            box-shadow: 0 0 20px blue;
        }
    </style>
</head>

<body>
    <div class="container w-[1440x] m-auto">
        <header class="mb-[32px]">
            <?php require "./layout/header.php" ?>
        </header>
        <div class="content ">
            <div class="slide-baner">
                <!-- Slideshow container -->
                <div class="slideshow-container">
                    <!-- Full-width images with number and caption text -->
                    <div class="mySlides fade">
                        <div class="numbertext">1 / 3</div>
                        <img src="img/anh-baner-tc.jpg" style="width:100%">
                        <div class="text">Caption Text</div>
                    </div>
                    <div class="mySlides fade">
                        <div class="numbertext">2 / 3</div>
                        <img src="img/anh-baner-tc2.jpg" style="width:100%">
                        <div class="text">Caption Two</div>
                    </div>
                    <div class="mySlides fade">
                        <div class="numbertext">3 / 3</div>
                        <img src="img/anh-baner-tc3.jpg" style="width:100%">
                        <div class="text">Caption Three</div>
                    </div>
                    <div class="mySlides fade">
                        <div class="numbertext">3 / 3</div>
                        <img src="img/anh-baner-tc4.jpg" style="width:100%">
                        <div class="text">Caption Three</div>
                    </div>
                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>
                <!-- The dots/circles -->
                <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
            <div class="item">
                <h1 class="mt-[16px] mb-[16px] font-bold text-center text-[30px]">NEW ARRIVAL</h1>
            </div>
            <div class="my-slider" style="display: flex; gap: 15px">
                <?php
                $listProduct = $connect->query("select * from product order by id_product desc limit 10");
                foreach ($listProduct as $li) { ?>
                    <div class="col mb-4">
                        <div class="card">
                            <a href="detaiproduct.php?id=<?= $li['id_product'] ?>"><img src="<?= "../upload/" . $li['img'] ?>" class="card-img-top w-full"></a>
                            <div class="main-product-sale">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title h-50 text-center">
                                    <?= $li['name_product'] ?>
                                </h5>
                                <p class="text-center font-bold  "><?= number_format($li['price_product']) ?> <i class="fa-solid fa-cart-arrow-down ml-[10px]"></i></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="news-content flex justify-between mt-[56px]">
                <div class="override  flex justify-between">
                    <div class="box-image">
                        <div class="box-image-flex">
                            <h3 class="about-prod--title font-bold text-[30px]">Simple <br> Pleasure<br> Collection</h3>
                            <button class="btn btn-buy-now text-center border border-[#000000] p-[10px] font-bold bg-[#000000] text-white mt-[32px]">Khám
                                phá ngay</button>
                        </div>
                    </div>
                </div>
                <div class="img-content flex justify-between p-[40px]">
                    <div class="">
                        <img class="w-[300px] h-[350px]" src="img/img-content.jpg" alt="">
                        <p class="text-center">Áo sơ mi Regular cổ đức MS 16E3893</p>
                        <p class="text-center">990.000</p>
                        <div class="input1 ml-[95px]">
                            <input class="mt-[3px] mb-[3px] mr-[5px] ml-[5px]" type="radio">
                        </div>
                    </div>
                    <div class="">
                        <img class="w-[300px] h-[350px] ml-[16px]" src="img/img-content2.jpg" alt="">
                        <p class="text-center">Quần sooc vải Wrapstreme MS 20E3983</p>
                        <p class="text-center">790.000</p>
                        <div class="input ml-[90px]">
                            <input class=" mt-[3px] mb-[3px] mr-[5px] ml-[5px] " type="radio">
                            <input class=" mt-[3px] mb-[3px] mr-[5px] ml-[5px]" type="radio">
                        </div>
                    </div>
                </div>
            </div>
            <footer class="mt-[120px]">
                <?php require "./layout/footer.php" ?>
            </footer>
        </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<script>
    document.getElementById('user').onclick = function() {
        var menuMobile = document.getElementById('Navbaruser').classList;
        menuMobile.toggle('hidden');
    }
    let slideIndex = 1;
    showSlides(slideIndex);
    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }
    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
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

</html>