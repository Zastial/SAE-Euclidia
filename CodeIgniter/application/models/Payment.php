<?php
require_once("PaymentPayPal.php");
require_once("PaymentCreditCard.php");
require_once("PaymentBankTransfer.php");
/**
 * class to get an object to handle payment 
 */
class Payment {

    /**
     * get a payment method by its name
     * @param $name
     * @return ?PaymentInterface
     */
    public static function getPaymentMethod(string $name): PaymentInterface {
        switch ($name) {
            case "Paypal":
                return new PaymentPayPal();
            case "CB":
                return new PaymentCreditCard();
            case "Virement":
                return new PaymentBankTransfer();
            default:
                return null;
        }
    }
}

?>