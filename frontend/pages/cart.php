<?php
require '../../backend/auth.php';

$user_data = is_authenticated();
$user_id;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!$user_data) {
        echo header("Location: http://localhost/khreedlay-php-ecommerce/frontend/pages/login.php");
        exit();
    }
    
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!$user_data) {
        echo json_encode(["redirect" => "http://localhost/khreedlay-php-ecommerce/frontend/pages/login.php"]);
        exit();
    }
    $user_id = $user_data['user_id'];
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (!isset($data['product_id'])) {
        echo json_encode(['error' => 'Product ID is required']);
        exit();
    }
    $product_id = $data['product_id'];
    create_cart($user_id, $product_id);
    echo json_encode(["message" => "Item added to cart."]);
    exit();
}

$user_id = $user_data['user_id'];
$cart_items = get_cart_by_user_id($user_id);
include('./components/header.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/style.css?v=jjkh">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/header.css?v=refer">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/cart.css?v=ergerg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
</head>

<body>
    <div class="container">
        <div class="cart__items">
            <?php
            $no_items = true;
            foreach ($cart_items as $cart_item) {
                $no_items = false;
                echo "<div class='cart__item-wrapper'>";
                echo "<div class='cart__item'>";
                echo "<div class='cart__img-container'><img class='cart__item-img' src=" . $cart_item['image_url'] . " alt='some image'><div class='cart__img-overlay'></div></div>";
                echo "<div class='cart__item-details'>";
                echo "<div class='cart__item-name'>" .  ucwords($cart_item['name']) . "</div>";
                echo "<div class='cart__item-price'>" . $cart_item['price'] . "₹</div>";
                echo "</div>";
                echo "<div class='cart__item-qty'>";
                echo "<label for='qty'>qty</label>";
                echo "<input name='qty' type='number' value='1'>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            if($no_items) {
                echo "<div class='cart__no-items'>!no items added</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>