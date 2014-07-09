<?php

 class paymentValidate
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
 			    echo $key.'<br />';
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
 			case 'shopId':
 				if (empty($value))
 				{
 					if (strlen($value) > 60)
 					{
 						$this->addLog('shopid_oversize', $value);
 						return false;
 					}
 					elseif (strlen($value) < 1)
 					{
 						$this->addLog('shopid_undersize', $value);
 						return false;
 					}
 					else
 					{
 						$this->addLog('shopid_invalid', $value);
 						return false;
 					}
 				}
 				else
 				{
 					return true;
 				}
 				break;
 			case 'shopLabel':
 				if (empty($value))
 				{
 					if (strlen($value) > 60)
 					{
 						$this->addLog('shoplabel_oversize', $value);
 						return false;
 					}
 					elseif (strlen($value) < 1)
 					{
 						$this->addLog('shoplabel_undersize', $value);
 						return false;
 					}
 					else
 					{
 						$this->addLog('shoplabel_invalid', $value);
 						return false;
 					}
 				}
 				else
 				{
 					return true;
 				}
 				break;
 			case 'mtid':
 				if (empty($value))
 				{
 					if (strlen($value) > 60)
 					{
 						$this->addLog('mtid_oversize', $value);
 						return false;
 					}
 					elseif (strlen($value) < 1)
 					{
 						$this->addLog('mtid_undersize', $value);
 						return false;
 					}
 					else
 					{
 						$this->addLog('mtid_invalid', $value);
 						return false;
 					}
 				}
 				else
 				{
 					return true;
 				}
 				break;
 			case 'subId':
 				return true;
 				break;
 			case 'close':
 				if ($value != '1' and $value != '0')
 				{
 					$this->addLog('invalid_close', $value, '');
 					return false;
 				}
 				else
 				{
 					return true;
 				}
 				break;
 			case 'nokUrl':
 				if (empty($value) or strlen($value) < 10)
 				{
 					$this->addLog('invalid_nok_url', 'validate_nokUrl', $value);
 					return false;
 				}
 				else
 				{
 					return true;
 				}
 				break;
 			case 'okUrl':
 				if (empty($value) or strlen($value) < 10)
 				{
 					$this->addLog('invalid_ok_url', 'validate_okUrl', $value);
 					return false;
 				}
 				else
 				{
 					return true;
 				}
 				break;
 			case 'pnUrl':
 				if (empty($value) or strlen($value) < 10)
 				{
 					$this->addLog('invalid_pn_url', 'validate_pnUrl', $value);
 					return false;
 				}
 				else
 				{
 					return true;
 				}
 				break;
 			case 'minAge':
 				if (preg_match('/^ \b[0-9]{1,2}\b$/', $value) != 1)
 				{
 					$this->addLog('min_age_invalide', 'validate_minAge', $value);
 					return false;
 				}
 				else
 				{
 					return true;
 				}
 				break;
 			case 'MinKycLevel':
 				if (!in_array($value, $this->MinKycLevel))
 				{
 					$this->addLog('min_kyc_level_invalide', 'validate_MinKycLevel', $value);
 					return false;
 				}
 				else
 				{
 					return true;
 				}
 				break;
 			case 'restricedCountry':
 				if (strlen($value) != 2)
 				{
 					$this->addLog('restricted_country_invalide', 'validate_restricedCountry', $value);
 					return false;
 				}
 				elseif (preg_match('/^[A-Z]{2}$/', $value) != 1)
 				{
 					$this->addLog('restricted_country_case', 'validate_restricedCountry', $value);
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

 	public function checkPaymentParameter($parameter)
 	{
 	  $return = array();
 		$required = array(
            'username',
            'password',
 			'amount',
 			'currency',
 			'mtid',
 			'merchantClientId',
 			'okUrl',
 			'nokUrl',
 			'pnUrl');
 		foreach ($required as $key)
 		{
 			if (!key_exists($key, $parameter))
 			{
 				$this->error = sprintf($this->_registry->language->get('create_disposition_missing_parameter'), $key);
 				return false;
 			}
 			elseif (empty($parameter[$key]))
 			{
 				$this->error = sprintf($this->_registry->language->get('create_disposition_missing_parameter'), $key);
 				return false;
 			}
            $return[$key] = $parameter[$key];
 		}

 		$optional = array(
 			'subId',
 			'clientIp',
 			'dispositionrestrictions',
 			'shopId',
 			'shoplabel');
        foreach ($optional as $key)
 		{
 			$return[$key] = isset($parameter[$key])?$parameter[$key]:'';
 		}
            
 		return $return;
 	}
    public function checkExecuteParameter($parameter)
 	{
 	  $return = array();
 		$required = array(
            'username',
            'password',
 			'amount',
 			'currency',
 			'mtid',
            'close'
            );
 		foreach ($required as $key)
 		{
 			if (!key_exists($key, $parameter))
 			{
 				$this->error = sprintf($this->_registry->language->get('create_disposition_missing_parameter'), $key);
 				return false;
 			}
 			elseif (empty($parameter[$key]))
 			{
 				$this->error = sprintf($this->_registry->language->get('create_disposition_missing_parameter'), $key);
 				return false;
 			}
            $return[$key] = $parameter[$key];
 		}

 		$optional = array(
 			'subId'
             );
        foreach ($optional as $key)
 		{
 			$return[$key] = isset($parameter[$key])?$parameter[$key]:'';
 		}
            
 		return $return;
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
 }
