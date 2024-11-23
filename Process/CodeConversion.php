<?php
function convertPaymentMethod($pm)
{
    $payment = '';
    if($pm == 1) $payment = 'Cash On Delivery';
    if($pm == 2) $payment = 'Gcash';
    if($pm == 3) $payment = 'Paymaya';
    return $payment;
}

function convertAvailability($code)
{
    $availability = '';

    if($code == 1)
    {
        $availability = 'Available';
    }
    elseif($code == 0)
    {
        $availability = 'Not Available';
    }

    return $availability;
}

?>