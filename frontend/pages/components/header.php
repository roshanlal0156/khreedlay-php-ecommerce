<?php
$authenticated = is_authenticated();
?>
<div class="container header">
    <img class="header__logo" src="http://localhost/khreedlay-php-ecommerce/frontend/images/logo.png" alt="">
    <input type="text" id="header__search" class="header__search" placeholder="search" value="<?php if(isset($search)) echo $search ?>"/>
    <div class="header__nav">
        <a href="http://localhost/khreedlay-php-ecommerce/index.php">Home</a>
        <a href="http://localhost/khreedlay-php-ecommerce/frontend/pages/products.php">Products</a>
        <a href="http://localhost/khreedlay-php-ecommerce/frontend/pages/cart.php">Cart</a>
        <?php
        if (!$authenticated) {
            echo "<a href='http://localhost/khreedlay-php-ecommerce/frontend/pages/login.php'>Log in</a>";
            echo "<a href='http://localhost/khreedlay-php-ecommerce/frontend/pages/signup.php'>Sign up</a>";
        } else echo "<a href='http://localhost/khreedlay-php-ecommerce/frontend/pages/logout.php'>Log out</a>";
        ?>
    </div>
</div>
<script>
    const search = document.querySelector("#header__search");
    search.onkeydown = function(e) {
        if (e.keyCode == 13) {
            window.location.href = 'http://localhost/khreedlay-php-ecommerce/frontend/pages/products.php?search=' + search.value;
        }
    };
</script>