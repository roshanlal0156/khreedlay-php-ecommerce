<?php
require '../../backend/auth.php';
include './components/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $jwt = login($email, $password);
    if ($jwt) {
        setcookie("jwt", $jwt, time() + (60 * 60 * 24), "/", "", false, true);
        header('Location: http://localhost/khreedlay-php-ecommerce/index.php');
        die();
    } else {
        // TODO:: display the error in login div
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/style.css?v=drfgr">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/header.css?v=drfgr">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/login.css?v=dfgdf">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>

<body>
    <div class="container login">
        <div class="login__wrapper">
            <div class="login__heading">Login</div>
            <form action="" method="post">
                <input id="login__email" type="text" placeholder="email" name="email" required />
                <input id="login__password" type="password" placeholder="password" name="password" required />
                <button type="submit">Login</button>
            </form>
            <div class="login__new-user">
                <span>Don't have an account?</span><span><a href="http://localhost/khreedlay-php-ecommerce/frontend/pages/signup.php">Register</a></span>
            </div>
        </div>
    </div>
</body>

</html>