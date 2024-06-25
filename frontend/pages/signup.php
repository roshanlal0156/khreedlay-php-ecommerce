<?php
require '../../backend/auth.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $jwt = sign_up($name, $email, $password);
    setcookie("jwt", $jwt, time() + (60 * 60 *24), "/", "", false, true);
    header('Location: http://localhost/khreedlay-php-ecommerce/index.php');
    die();
}

include './components/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/style.css?v=drfgr">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/header.css?v=drfgr">
    <link rel="stylesheet" href="http://localhost/khreedlay-php-ecommerce/frontend/styles/signup.css?v=dfgdf">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
    <div class="container signup">
        <div class="signup__wrapper">
            <div class="signup__heading">Sign up</div>
            <form action="" method="post">
                <input id="signup__name" type="text" placeholder="name" name="name" required/>
                <input id="signup__email" type="text" placeholder="email" name="email" required/>
                <input id="signup__password" type="password" placeholder="password" name="password" required/>
                <button type="submit">Sign up</button>
            </form>
            <div class="signup__existing-user">
                <span>Already have an account?</span><span><a href="http://localhost/khreedlay-php-ecommerce/frontend/pages/login.php">Login</a></span>
            </div>
        </div>
    </div>
</body>
</html>