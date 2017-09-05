<?php

add_hook('ClientAreaHeadOutput', 50, function($vars) {
    return <<<HTML
    <script src="{$vars['BASE_PATH_JS']}/jquery.card.js"></script>
HTML;
});

add_hook('ClientAreaFooterOutput', 50, function($vars) {
    $cardnum = $vars['cardnum'];
    $cardexp = $vars['cardexp'];
    $cardtype = $vars['cardtype'];

    $returnVal = <<<HTML
    <script>
    var cardjsTypeMap = {
        'mastercard': 'MasterCard',
        'visa': 'Visa',
        'discover': 'Discover',
        'amex': 'American Express',
        'jcb': 'JCB',
        'dinersclub': 'Diners Club'
    }

    var whmcsTypeMap = {
        'mastercard': 'mastercard',
        'visa': 'visa',
        'discover': 'discover',
        'american express': 'amex',
        'jcb': 'jcb',
        'diners club': 'dinersclub'
    }

    $('#frmNewCc').card({
        container: '#ccpanel',
        formSelectors: {
            numberInput: 'input[name="ccnumber"]',
            expiryInput: 'input[name="ccexpirymonth"], input[name="ccexpiryyear"]',
            cvcInput: 'input[name="cardcvv"]'
        },
        masks: {
            cardNumber: '•'
        },
        placeholders: {
            number: '{$cardnum}',
            name: '',
            expiry: '{$cardexp}'
        }
    });
    document.getElementById('inputCardNumber')
       .addEventListener('payment.cardType', function(event) {
           $('#inputCardType').val(cardjsTypeMap[event.detail]);
       });
   </script>
HTML;

   if ($cardtype != '')
   {
       $cardclass = strtolower($cardtype);
       $returnVal .= <<<HTML
       <script>
       $('.jp-card').removeClass('jp-card-unknown').addClass('jp-card-' + whmcsTypeMap['{$cardclass}']).addClass('jp-card-identified');
       </script>
HTML;
   }

   return $returnVal;
});
