<?php
require 'db.con.php';

function fetch_all_categories() {
    global $mysqli;
    $q = "select * from categories;";
    return mysqli_query($mysqli, $q);
}

function fetch_all_products() {
    global $mysqli;
    $q = "select * from products;";
    return mysqli_query($mysqli, $q);
}

function fetch_products_by_filters($search = null, int|null $category_id = null, int|null $min_price = null, int|null $max_price = null) {
    global $mysqli;
    $q = "select * from products where 1";
    if($search) {
        $q = $q . " and description like '%$search%'";
    }
    if($category_id) {
        $q = $q . " and category_id = $category_id";
    }
    if($min_price) {
        $q = $q . " and price > $min_price";
    }
    if($max_price) {
        $q = $q . " and price < $max_price";
    }
    return mysqli_query($mysqli, $q);
}

function fetch_product_by_id(int $id) {
    global $mysqli;
    $q = "select * from products where id = $id limit 1;";
    $result = mysqli_query($mysqli, $q);
    return mysqli_fetch_assoc($result);
}

function create_user($name, $email, $password, $role_id = 1) {
    global $mysqli;
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $mysqli->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $hashed_password, $role_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}
function create_cart(int $user_id, int $product_id) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $product_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function get_cart_by_user_id(int $user_id) {
    global $mysqli;
    $q = "select * from cart join products on products.id = cart.product_id where cart.user_id = '$user_id';";
    return mysqli_query($mysqli, $q);
}

function get_user_by_email($email) {
    global $mysqli;
    $q = "select * from USERS where EMAIL = '$email' limit 1;";
    $result = mysqli_query($mysqli, $q);
    return mysqli_fetch_assoc($result);
}

function get_user_by_id($id) {
    global $mysqli;
    $q = "select * from USERS where EMAIL = '$id' limit 1;";
    $result = mysqli_query($mysqli, $q);
    return mysqli_fetch_assoc($result);
}
?>