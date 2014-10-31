<?php
class payout extends paysafecard_base{

    public function __construct($mode=false)
    {
        parent::loadConfig('payout');
        if($mode)
        {
            $this->setMode($mode);
        }
    }

    public function newPayout($parameter)
    {
        $validate = new payoutValidate($this->registry);
        if(!isset($parameter['username']) OR !isset($parameter['password']))
        {
            $parameter['username'] = $this->registry->config->get('Merchant')['username'];
            $parameter['password'] = $this->registry->config->get('Merchant')['password'];
        }
        if(!$validate->validate($parameter))
        {
            $this->setError($this->registry->api->error);
            return false;
        }
        $parameter = $validate->checkPayoutParameter($parameter);
        if(!$parameter)
        {
            $this->setError($this->registry->api->error);
            return false;
        }

        //return
    }

}