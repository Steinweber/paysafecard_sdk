<?php
class paymentCancel extends paysafecard_base
{             
    public function __construct($lang=false)
    {
        parent::loadConfig('payment');
        if($lang)
        {
            $this->setLanguage($lang);
        }
        $this->_customerInfo = $this->registry->language->get('payment_cancelled');          
    }
}