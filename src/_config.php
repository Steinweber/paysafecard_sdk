<?php
class Config{
    protected $data = array(
        //Domains
        'ApiWsdlSandbox' => 'https://soatest.paysafecard.com/psc/services/PscService?wsdl',
        'PaymentPanelSandbox' => 'https://customer.test.at.paysafecard.com/psccustomer/GetCustomerPanelServlet',
        'ApiWsdlProductive' => 'https://soa.paysafecard.com/psc/services/PscService?wsdl',
        'PaymentPanelProductive' => 'https://customer.cc.at.paysafecard.com/psccustomer/GetCustomerPanelServlet',        
        //File
        'LogFile' => 'log/log.txt',
        //Settings
        'DebugStatus' => true, 
        'Language' => 'de',
        'Mode' => 'test',
        //Access
        'Merchant' => array('username'=>'xxx','password'=>'xxx'),
    );
    
    public function get($key)
    {
        return $this->data[$key];
    }    
    
    public function has($key)
    {
        return isset($this->data[$key]);
    }
    
    public function set($key,$value)
    {
        $this->data[$key] = $value;
    }
}