<?php
require './backend/auth.php';
include('./frontend/pages/components/header.php');
$categories = fetch_all_categories();
$products = fetch_all_products();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/style.css?v=jjkh">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/header.css?v=refer">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/index.css?v=ewfewrf">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container hero">
        <div class="hero__welcome">Welcome! to Khreed Lay..We Offer</div>
        <h1 class="hero__slogun">Quality Products On Best Prices</h1>
        <input id="hero__search" class="hero__search" type="text" placeholder="search" />
    </div>

    <div class="container categories">
        <div class="categories__heading">Categories</div>
        <div class="categories__scroll-list-wrapper">
            <button class="categories__scroll-button categories__left" id="categories__scrollLeft">&lt;</button>
            <div class="categories__cat-list">
                <?php
                foreach ($categories as $category) {
                    echo "<div class='categories__item'>" . ucwords($category['name']) . "</div>";
                }
                ?>
            </div>
            <button class="categories__scroll-button categories__right" id="categories__scrollRight">&gt;</button>
        </div>
    </div>

    <div class="container products">
        <div class="products__heading">Top Products</div>
        <div class="products__grid-list">
            <?php
            $i = 0;
            foreach ($products as $product) {
                $i++;
                echo "<div class='products__item' onclick='navigateToProductPage(" . $product['id'] . ")' product_id=" . $product['image_url'] . "><img src='" . $product['image_url'] . "'/>
                <div class='products__item-title'> ". $product['title'] . " </div>" .
                "<div class='products__item-name'> ". $product['name'] . " </div>" .
                "<div class='products__item-price'> ". $product['price'] . "₹ </div>" .
                "<div class='products__item-description'> ". $product['description'] . " </div>" .
                "<div class='products__item-add-to-cart-btn'>Add To Cart</div>" .
                "</div>";
                if($i == 8) break;
            }
            ?>
        </div>
    </div>
</body>
<script>
    function navigateToProductPage(productId) {
        window.location.href = `http://localhost/khreedlay-php-ecommerce/frontend/pages/product.php?id=${productId}`;
    }

    const heroSearch = document.querySelector("#hero__search");
    heroSearch.onkeydown = function(e) {
        if (e.keyCode == 13) {
            window.location.href = 'http://localhost/khreedlay-php-ecommerce/frontend/pages/products.php?search=' + heroSearch.value;
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        const scrollContainer = document.querySelector('.categories__cat-list');
        const scrollLeft = document.getElementById('categories__scrollLeft');
        const scrollRight = document.getElementById('categories__scrollRight');


        scrollLeft.addEventListener('click', () => {
            scrollContainer.scrollBy({
                left: -350,
                behavior: 'smooth'
            });
        });

        scrollRight.addEventListener('click', () => {
            scrollContainer.scrollBy({
                left: 350,
                behavior: 'smooth'
            });
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