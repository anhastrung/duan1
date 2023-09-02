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
                    <a href="?site=product&id=<?= $li['id_product'] ?>"><img src="<?= "../upload/" . $li['img'] ?>" class="card-img-top w-full hover:animate-pulse"></a>
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
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<script>
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