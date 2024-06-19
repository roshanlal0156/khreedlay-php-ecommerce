<?php
include('./frontend/pages/components/header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="http://localhost/sample-e-com/frontend/styles/style.css?v=jjkh">
    <link rel="stylesheet" href="http://localhost/sample-e-com/frontend/styles/header.css?v=drfgr">
    <link rel="stylesheet" href="http://localhost/sample-e-com/frontend/styles/index.css?v=ftght">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container hero">
        <div class="hero__welcome">Welcome! to Khreed Lay..We Offer</div>
        <h1 class="hero__slogun">Quality Products On Best Prices</h1>
        <input class="hero__search" type="text" placeholder="search" />
    </div>

    <div class="container categories">
        <div class="categories__heading">Categories</div>
        <div class="categories__scroll-list-wrapper">
            <button class="categories__scroll-button categories__left" id="categories__scrollLeft">&lt;</button>
            <div class="categories__cat-list">
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
                <div class="categories__item">
                </div>
            </div>
            <button class="categories__scroll-button categories__right" id="categories__scrollRight">&gt;</button>
        </div>
    </div>

    <div class="container products">
        <div class="products__heading">Top Products</div>
        <div class="products__grid-list">
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
            <div class="products__item"></div>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const scrollContainer = document.querySelector('.categories__cat-list');
    const scrollLeft = document.getElementById('categories__scrollLeft');
    const scrollRight = document.getElementById('categories__scrollRight');

    scrollLeft.addEventListener('click', () => {
        scrollContainer.scrollBy({ left: -350, behavior: 'smooth' });
    });

    scrollRight.addEventListener('click', () => {
        scrollContainer.scrollBy({ left: 350, behavior: 'smooth' });
    });
    function updateScrollButtons() {
        scrollLeft.disabled = scrollContainer.scrollLeft === 0;
        scrollRight.disabled = scrollContainer.scrollWidth - scrollContainer.scrollLeft === scrollContainer.clientWidth;
    }

    updateScrollButtons();

    scrollContainer.addEventListener('scroll', updateScrollButtons);

});
</script>

</html>