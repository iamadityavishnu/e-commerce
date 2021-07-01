<?php

$cart = [];

setcookie('cart', serialize($cart), time() - (86400 * 30), "/");
echo "COOKIE CLEARED"

?>