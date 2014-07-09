<?php
class payment extends paysafecard_base
{    
    public $mid;
        
    public function __construct($mode=false)
    {
        parent::loadConfig('payment');
        if($mode)
        {
            $this->setMode($mode);
        }   
        $this->registry->debug->_debug('asd');
    }
    
    public function newPayment($parameter)
    {
        $validate = new paymentValidate($this->registry);
        if(!isset($parameter['username']) OR !isset($parameter['password']))
        {
            $parameter['username'] = $this->registry->config->get('Merchant')['username'];
            $parameter['password'] = $this->registry->config->get('Merchant')['password'];
        }
        if(!$validate->validate($parameter))
        {
            $this->_customerInfo = $this->registry->language->get('msg_create_disposition');
            $this->setError($this->registry->api->error);
            return false;
        }
        $parameter = $validate->checkPaymentParameter($parameter);
        if(!$parameter)
        {
            $this->_customerInfo = $this->registry->language->get('msg_create_disposition');
            $this->setError($this->registry->api->error);
            return false;
        }

        return $this->createDisposition($parameter);
        return true;      
    }
    
    private function createDisposition($parameter)
    {
    
        if(!$this->registry->api->newClient())
        {
            $this->_customerInfo = $this->registry->language->get('msg_create_disposition');
            $this->_error = $this->registry->api->error;
            return false;
        }
        if(!$this->registry->api->action('createDisposition',$parameter))
        {
            $this->_customerInfo = $this->registry->language->get('msg_create_disposition');
            $this->_error = $this->registry->api->error;
            return false;
        }
        if($this->registry->api->result->createDispositionReturn->resultCode === 0 OR $this->registry->api->result->createDispositionReturn->errorCode === 0)
        {
            $this->mid = $this->registry->api->result->createDispositionReturn->mid;
            return $this->getCustomerPanel($parameter);
        }
        else
        {
            $this->mid = NULL;
            $this->_customerInfo = $this->registry->language->get('msg_create_disposition');
            $this->setError(
                sprintf(
                    $this->registry->language->get('create_disposition_error'),
                    $this->registry->api->result->createDispositionReturn->resultCode,
                    $this->registry->api->result->createDispositionReturn->errorCode
                    )
            );
            return false;
        }
    }
    
    private function getCustomerPanel($parameter)
    {
        $url = $this->registry->config->get('Mode') == 'test' ? $this->registry->config->get('PaymentPanelSandbox') : $this->registry->config->get('PaymentPanelProductive');
        $url .= '?currency='.$parameter['currency'];
        $url .= '&mtid='.$parameter['mtid'];
        $url .= '&amount='.$parameter['amount'];
        $url .= '&mid='.$this->mid;        
        return $url;
    }
}