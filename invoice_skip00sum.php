<?php

if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

function db_invoice_total($invoice_id)
{
    $invoice_total = '0.00';
    return $invoice_total;
}

function delete_invoice($invoice_id)
{
    return true;
}

function update_next_invoice($invoice_id)
{
    return true;
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

        delete_invoice($invoice_id);
        update_next_invoice($invoice_id);
    }

    return $merge_fields;
}

add_hook('EmailPreSend', 1, "suppress_00_invoice");
