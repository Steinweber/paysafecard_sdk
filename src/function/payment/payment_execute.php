<?php
class paymentExecute extends paysafecard_base
{         
    public $dispositionState;
    
    public function __construct($mode=false)
    {
        parent::loadConfig('payment');
        if($mode)
        {
            $this->setMode($mode);
        }   
    }
    
    public function execute($parameter)
    {
        $validate = new paymentValidate($this->registry);
        if(!isset($parameter['username']) OR !isset($parameter['password']))
        {
            $parameter['username'] = $this->registry->config->get('Merchant')['username'];
            $parameter['password'] = $this->registry->config->get('Merchant')['password'];
        }
        if(!$validate->validate($parameter))
        {
            $this->_customerInfo = $this->registry->language->get('msg_execute_debit');
            $this->setError($validate->error);
            return false;
        }
        $parameter = $validate->checkExecuteParameter($parameter);
        if(!$parameter)
        {
            $this->_customerInfo = $this->registry->language->get('msg_execute_debit');
            $this->setError($validate->error);
            return false;
        }
        return $this->getSerialNumbers($parameter);
    }
    
    private function getSerialNumbers($parameter)
    {
        $params = array('username'=>$parameter['username'], 
                        'password'=>$parameter['password'],
                        'mtid'=>$parameter['mtid'],
                        'subId'=>$parameter['subId'],
                        'currency'=>$parameter['currency']
                       );
        if(!$this->registry->api->newClient())
        {
            $this->_customerInfo = $this->registry->language->get('msg_execute_debit');
            $this->setError($this->registry->api->error);
            return false;
        }
        if(!$this->registry->api->action('getSerialNumbers',$parameter))
        {
            $this->_customerInfo = $this->registry->language->get('msg_execute_debit');
            $this->setError($this->registry->api->error);
            return false;
        }       
        if($this->registry->api->result->getSerialNumbersReturn->resultCode === 0 AND $this->registry->api->result->getSerialNumbersReturn->errorCode === 0)
        {
            $this->dispositionState = $this->registry->api->result->getSerialNumbersReturn->dispositionState;
            if($this->dispositionState == 'S' OR $this->dispositionState == 'E')
            { 
                return $this->executeDebit($parameter);
            }
            elseif($this->dispositionState == 'O')
            {
                $this->_customerInfo = $this->registry->language->get('payment_done');
                return true;
            }
            else
            {
                
                if($this->dispositionState === 'R')
                {
                    $this->_customerInfo = $this->registry->language->get('payment_invalide');
                }
                elseif($this->dispositionState === 'L')
                {
                    $this->_customerInfo = $this->registry->language->get('payment_cancelled');
                }
                elseif($this->dispositionState === 'X')
                {
                    $this->_customerInfo = $this->registry->language->get('payment_expired');
                }
                else
                {
                    $this->_customerInfo = $this->registry->language->get('msg_execute_debit');
                }                
                return false;
            }
            
        }
        else
        {
            $this->_customerInfo = $this->registry->language->get('msg_execute_debit');
            $this->setError(
                sprintf(
                    $this->registry->language->get('get_serial_number_error'),
                    $this->registry->api->result->getSerialNumbersReturn->resultCode,
                    $this->registry->api->result->getSerialNumbersReturn->errorCode
                    )
            );
            return false;
        }
    }
    
    private function executeDebit($parameter)
    {
        if(!$this->registry->api->action('executeDebit',$parameter))
        {
            $this->_customerInfo = $this->registry->language->get('msg_execute_debit');
            $this->setError($this->registry->api->error);
            return false;
        } 
        if($this->registry->api->result->executeDebitReturn->resultCode === 0 AND $this->registry->api->result->executeDebitReturn->errorCode === 0)
        { 
			$this->_customerInfo = $this->registry->language->get('payment_done');
			return true;
		}
        else
        {
            $this->_customerInfo = $this->registry->language->get('msg_execute_debit');
            $this->setError(
                sprintf(
                    $this->registry->language->get('execute_debit_error'),
                    $this->registry->api->result->executeDebitReturn->resultCode,
                    $this->registry->api->result->executeDebitReturn->errorCode
                    )
            );
            return false;
        }
    }
}