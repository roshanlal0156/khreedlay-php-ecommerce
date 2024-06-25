<?php
// Delete the 'jwt' cookie by setting its expiration date in the past
if (isset($_COOKIE['jwt'])) {
    setcookie('jwt', '', time() - 3600, '/'); // Note: Path must match the original path
    unset($_COOKIE['jwt']); // Optional: Unset it from the current request
}
header("Location: http://localhost/khreedlay-php-ecommerce/index.php");
exit();
?>
