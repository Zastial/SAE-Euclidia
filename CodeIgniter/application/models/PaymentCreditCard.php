<?php
require_once("PaymentInterface.php");
class PaymentCreditCard implements PaymentInterface {

    public function verifyPayment(): bool {
        return true;
    }

}
?>