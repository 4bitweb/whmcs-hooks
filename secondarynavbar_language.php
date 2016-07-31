<?php

if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

use WHMCS\ClientArea;
use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaSecondaryNavbar', 2, function (MenuItem $secondaryNavbar) use ($vars)
{
    global $smarty;
    $vars = $smarty->tpl_vars;
    $langChange = $vars["languagechangeenabled"]->value;
    $locales = $vars["locales"]->value;
    $linkBack = $vars["currentpagelinkback"]->value;

    if ($langChange && count($locales) > 1)
    {
        $changeLang = $secondaryNavbar->addChild('change-lang', array(
            'label' => '<i class="fa fa-globe fa-lg"></i>',
            'order' => '99',
        ));

        foreach ($locales as $key => $locale) {
            $changeLang->addChild($locale["locale"], array(
                'label' => $locale["localisedName"],
                'order' => $key,
                'uri' => $linkBack . 'language=' . $locale["language"],
            ));
        }
    }
});
