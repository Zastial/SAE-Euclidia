<?php
require_once("PaymentInterface.php");
class PaymentBankTransfer implements PaymentInterface {

    public function verifyPayment(): bool {
        return true;
    }

}


?>