<?php
require_once("PaymentInterface.php");
class PaymentPaypal implements PaymentInterface {

    public function verifyPayment(): bool {
        return true;
    }

}


?>