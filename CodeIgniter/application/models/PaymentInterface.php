<?php

/**
 * defines what a payment strategy should do
 */
interface PaymentInterface {

    /**
     * function to process and verify the payment
     * @return bool
     * true if the payment succedeed or else false 
     */
    public function verifyPayment(): bool;
    
}
?>