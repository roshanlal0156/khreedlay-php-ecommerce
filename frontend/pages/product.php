<?php
require '../../backend/auth.php';
include './components/header.php';

$product_id = $_GET['id'];
$product = fetch_product_by_id($product_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/style.css?v=jjkh">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/header.css?v=jjkh">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/product.css?v=fdgsftdrgsr">
    <title>Product Page</title>
</head>
<body>
    <div class="container product">
    <?php echo "<img class='product__image product__grid' src='" . $product['image_url'] . "' alt='" . $product['title'] . "' />" ?>
    <?php echo "<div class='product__details product__grid'>"
    . "<div class='product__details-title'>" . $product['title'] . "</div>"
    . "<div class='product__details-name'>" . $product['name'] . "</div>"
    . "<div class='product__details-description'>" . $product['description'] . "</div>"
    . "<div class='product__details-price'>" . $product['price'] . "₹</div>"
    . "<div class='product__details-btn'>Add To Cart</div>"
    . "</div>"; ?>
    </div>
</body>
</html>