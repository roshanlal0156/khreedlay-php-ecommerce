<?php
require '../../backend/auth.php';

$products;
$search = isset($_GET['search']) ? $_GET['search'] : null;
$category_id = isset($_GET['category']) ? $_GET['category'] : null;
$price_range = isset($_GET['price']) ? $_GET['price'] : null;
if ($price_range) {
    list($min_price, $max_price) = explode('-', $price_range);
    $products = fetch_products_by_filters($search, $category_id, $min_price, $max_price);
} else {
    $products = fetch_products_by_filters($search, $category_id);
}
$categories = fetch_all_categories();

include('./components/header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/style.css?v=jjkh">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/header.css?v=dfrgd">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/products.css?v=regrgfe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
</head>

<body>
    <div class="container products">
        <div class="products__filters">
            <form id="products__filters-form" method="get">
                <input id="products__form-input" style="display: none;" <?php if (!isset($search)) echo "disabled" ?> type="text" name="search" value="<?php if (isset($search)) echo $search ?>">
                <label for="category">Category</label>
                <select name="category" id="category">
                    <option selected disabled value="none">Select</option>
                    <?php
                    foreach ($categories as $category) {
                        echo "<option value='" . $category['id'] . "'>" . ucfirst($category['name']) . "</option>";
                    }
                    ?>
                </select>
                <label for="price">Price</label>
                <select name="price" id="price">
                    <option selected disabled value="none">Select</option>
                    <option value="1000-2000">1000-2000</option>
                    <option value="2000-3000">2000-3000</option>
                    <option value="3000-4000">3000-4000</option>
                    <option value="4000-5000">4000-5000</option>
                    <option value="5000-6000">5000-6000</option>
                    <option value="6000-7000">6000-7000</option>
                </select>
                <button id="apply" class="apply" type="submit">Apply</button>
            </form>
        </div>

        <div class="products__list-wrapper">
            <div class="products__list">
                <?php
                $no_items = true;
                foreach ($products as $product) {
                    $no_items = false;
                    echo "<div class='products__list-item'>";
                    echo "<img src='" . $product['image_url'] . "' alt='" . $product['title'] . "'>";
                    echo "<div class='products__item-details'>";
                    echo "<div class='product__item-title'>" . $product['title'] . "</div>";
                    echo "<div class='product__item-name'>" . $product['name'] . "</div>";
                    echo "<div class='product__item-description'>" . $product['description'] . "</div>";
                    echo "<div class='product__cnp-wrapper'>";
                    echo "<div class='product__item-price'>" . $product['price'] . "₹</div>";
                    echo "<div id='product__cart-btn' class='product__cart-btn' onclick=" . "additemToCart(" . $product['id'] . ")" . ">Add to Cart</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                if ($no_items) echo "<div class='products__no-items'>!search item not available</div>";
                ?>
            </div>
        </div>
    </div>
</body>
<script>
    // $productCartBtn = document.querySelector('#product__cart-btn');
    // $productCartBtn.addEventListener((e) => {
    //     console.log('hi ou');
    // })
    url = 'http://localhost/khreedlay-php-ecommerce/frontend/pages/cart.php';

    async function additemToCart(id) {
        console.log('okokok');
        res = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({'product_id': id})
        });
        data = await res.json();

        if(data["redirect"]) {
            window.location.href = data.redirect;
        } else {
            console.log(data["message"]);
        }
        // data = res.json();
        
    }
</script>

</html>