<?php

use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaSecondaryNavbar', 1, function (MenuItem $secondaryNavbar)
{
    $cartCount = count($_SESSION["cart"]["products"])+count($_SESSION["cart"]["domains"]);
    $secondaryNavbar->addChild('View Cart', array(
                'label' => '<i class="fa fa-shopping-cart fa-lg"></i> <sup style="font-size: small"><b>' . $cartCount . '</b></sup>',
                'uri' => 'cart.php?a=view',
                'order' => '99',
            ));
});
