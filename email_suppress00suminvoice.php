<?php

if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

// use WHMCS (Laravel) db functions
use Illuminate\Database\Capsule\Manager as Capsule;

function db_invoice_total($invoice_id)
{
    return Capsule::table('tblinvoiceitems')->where('invoiceid', $invoice)
                                            ->sum('amount');
}

function suppress_00_invoice($vars)
{
    $merge_fields = array();
    $email_template = $vars['messagename'];
    $invoice_id = $vars['relid'];

    if ($email_template == 'Invoice Created' || $email_template == 'Invoice Payment Confirmation')
    {
        $invoice_total = db_invoice_total($invoice_id);
        if (isset($invoice_total) && $invoice_total == '0.00')
        {
            $merge_fields['abortsend'] = true;
        }

    }

    return $merge_fields;
}

add_hook('EmailPreSend', 1, "suppress_00_invoice");
