<?php
 
use WHMCS\View\Menu\Item as MenuItem;
 
add_hook('ClientAreaPrimaryNavbar', 1, function (MenuItem $primaryNavbar)
{
    if (!is_null($primaryNavbar->getChild('Primary_Navbar-Home'))) {
        $primaryNavbar->getChild('Primary_Navbar-Home')
            ->addChild('Web Ana Sayfa', array(
                'label' => Lang::trans('webhomepage'),
                'uri' => 'https://4-bit.net',
                'order' => '100',
            ));
    }
});
