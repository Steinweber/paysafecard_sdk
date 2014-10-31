<?php
class paysafecard_base
{    
    public $registry; 
    protected $_error;
    protected $_customerInfo;
    
    public function setDebug($status=false, $logFile=false)
    {
        $this->registry->config->set('DebugStatus',$status);
        if($logFile)
        {
            $this->registry->config->set('LogFile',$logFile);
        }
    }
    
    public function setLanguage($language = 'de')
    {
        if (in_array($language, $this->registry->config->get('AllowedLanguages'))) {
            $this->registry->config->set('Language',$language);
        } else {
            $this->registry->config->set('Language',$this->registry->config->get('AllowedLanguages')[0]);
        }
        $this->registry->config->set('LanguageFolder',$this->registry->config->get('DirLanguage').$this->language.'/');
        $this->load($this->registry->config->get('Language'));
    }
    
    public function setMerchant($username,$password)
    {
        $this->registry->config->set('merchant',array('username'=>$username,'password' => $password));
    }
    
    public function setMode($mode)
    {
        $this->registry->config->set('Mode',$mode);
    }
    
    public function getError()
    {
        return $this->_error;
    }
    
    protected function setError($error)
    {
        $this->_error = $error;
        $this->registry->debug->_debug($error);
    }
    
    public function getCustomerInfo()
    {
        return $this->_customerInfo;
    }
    
    protected function loadConfig($loadedClass)
    {
        $this->registry = new Registry();
        $this->registry->config = new Config();
        $this->registry->config->set('LoadedClass',$loadedClass);
        $this->registry->config->load($loadedClass);
        $this->registry->language = new Language($this->registry);
        $this->registry->debug = new Debug($this->registry);
        $this->registry->api = new Api($this->registry);
    }
}