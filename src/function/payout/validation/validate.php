<?php

class payoutValidate
{

    public $error = array();
    protected $_registry;
    protected $_debug = false;
    protected $_language;

    public function __construct($_registry)
    {
        $this->_registry = $_registry;
    }

    public function validate($parameter)
    {
        foreach ($parameter as $key => $value)
        {
            if (!$this->validation($key, $value))
            {
                return false;
            }
        }
        return true;
    }

    private function validation($type = '', $value)
    {

        if ($type == '' && empty($value))
        {
            $this->addLog('error_validation','>>empty<<');
            return false;
        }
        switch ($type)
        {
            case 'username':
                if (empty($value))
                {
                    $this->addLog('username_empty', $value);
                    return false;
                }
                elseif (strlen($value) <= '3')
                {
                    $this->addLog('username_length', $value);
                    return false;
                }
                else
                {
                    return true;
                }
                break;
            case 'password':
                if (empty($value))
                {
                    $this->addLog('password_empty', $value);
                    return false;
                }
                elseif (strlen($value) <= '5')
                {
                    $this->addLog('passwor_length', $value);
                    return false;
                }
                else
                {
                    return true;
                }
                break;
            case 'amount':
                if ($value == '')
                {
                    $this->addLog('empty_amount');
                    return false;
                }
                elseif (strlen($value) <= '3')
                {
                    $this->addLog('wrong_amount', $value);
                    return false;
                }
                elseif ((strpos($value, ',') !== false) or (strpos($value, '.') === false))
                {
                    $this->addLog('dot_amount', $value);
                    return false;
                }
                else
                {
                    $amountParts = explode('.', $value);
                    if (!isset($amountParts[1]) or strlen($amountParts[1]) != 2)
                    {
                        $this->addLog('wrong_amount', $value);
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                break;
            case 'ptid':
                if (strlen($value) > 60)
                {
                    $this->addLog('ptid_oversize', $value);
                    return false;
                }
                elseif (strlen($value) < 1)
                {
                    $this->addLog('ptid_undersize', $value);
                    return false;
                }
                return true;
                break;
            case 'customerIdType':
                if (empty($value))
                {
                    $this->addLog('empty_customer_id_type', $value);
                    return false;
                }
                $allowedTypes = array('ACCOUNT','PHONE','E-MAIL');
                if(!in_array($value,$allowedTypes))
                {
                    $this->addLog('invalide_customer_id_type', $value);
                    return false;
                }
                return true;
                break;
            case 'customerId':
                if (strlen($value) > 90)
                {
                    $this->addLog('customer_id_oversize', $value);
                    return false;
                }
                elseif (strlen($value) < 5)
                {
                    $this->addLog('customer_id_undersize', $value);
                    return false;
                }
                return true;
                break;
            case 'merchantClientId':
                if (empty($value))
                {
                    $this->addLog('invalid_client_id', $value);
                    return false;
                }
                else
                {
                    return true;
                }
                break;
            case 'currency':
                if (strlen($value) != '3')
                {
                    $this->addLog('wrong_currency', $value);
                    return false;
                }
                elseif (preg_match('/^[A-Z]{3}$/', $value) != 1)
                {
                    $this->addLog('wrong_currency_case', $value);
                    return false;
                }
                else
                {
                    return true;
                }
                break;
            default:
                if ($type == '')
                {
                    $this->addLog('error_validation_type');
                    return false;
                }
                else
                {
                    $this->addLog('error_validation');
                    return false;
                }
        }
    }

    private function addLog($key, $data = '')
    {
        if (!$this->_debug)
        {
            $this->_debug = new debug($this->_registry);
            $this->_language = $this->_registry->language;
        }
        $msg = $this->_language->get($key);
        $this->error = $msg;
        $this->_debug->_debug($msg, $data);
    }

    public function checkPayoutParameter($parameter)
    {
        $return = array();
        $required = array(
            'username',
            'password',
            'amount',
            'currency',
            'ptid',
            'merchantClientId',
            'customerIdType',
            'customerId',
            'validationOnly',
            'utcOffset',
            );
        foreach ($required as $key)
        {
            if (!array_key_exists($key, $parameter))
            {
                $this->error = sprintf($this->_registry->language->get('create_payout_missing_parameter'), $key);
                return false;
            }
            elseif (empty($parameter[$key]))
            {
                $this->error = sprintf($this->_registry->language->get('create_payout_missing_parameter'), $key);
                return false;
            }
            $return[$key] = $parameter[$key];
        }
        return $return;
    }
}
