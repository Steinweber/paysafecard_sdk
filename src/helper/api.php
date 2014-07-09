<?php
class Api{
    protected $_data = array();
    protected $_registry;
    protected $_settings = array();
    public $client=NULL;
    public $result;
    public $error;
    
    public function __construct($_registry)
    {
        $this->_registry = $_registry;        
        
    }
    
    public function newClient($reinit=false)
	{
	   if($this->client && $reinit==false)
       {
        return true;
       }
		$this->soapInit();
		try
		{
			$this->client = new SoapClient( $this->_registry->config->get('Mode') == 'test' ? $this->_registry->config->get('ApiWsdlSandbox') : $this->_registry->config->get('ApiWsdlProductive'), $this->_settings );
            return true;
		}
		catch ( SoapFault $e )
		{
			$this->error = $e->getMessage();
            return false;
		}
	}
    
    public function action($action,$parameter)
    {
        try
		{
			$this->result = $this->client->{$action}($parameter);
            return true;
		}
		catch ( SoapFault $e )
		{
			$this->error = $e->getMessage();
            return false;
		}        
    }
    
    private function soapInit()
	{
		#prüft ob die Soap-funktion aktiviert ist
		if ( !class_exists( "SOAPClient" ) )
		{
			die( 'ERROR: SOAPClient isn´t enabled' );
		}
		#lädt die Parameter für die Verbindung
		$this->_settings = array(
			'encoding' => 'utf-8',
			'connection_timeout' => 15,
			'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
			'compression' => SOAP_COMPRESSION_GZIP );
		#angepasste Parameter für Tests
		if ( $this->_registry->config->get('Mode') == 'test' )
		{
			ini_set( "soap.wsdl_cache_enabled", '0' );
			ini_set( "soap.wsdl_cache_ttl", '0' );
			$wsdl = array(
				'user_agent' => 'paysafecard payment class(testmode) v1.0',
				'trace' => true,
				'exceptions' => true,
				'cache_wsdl' => WSDL_CACHE_NONE );
		}
		else
		{
			$wsdl = array(
				'user_agent' => 'paysafecard payment class v1.0',
				'trace' => false,
				'exceptions' => false );
		}
		$this->_settings = array_merge( $this->_settings, $wsdl );
	}
    
}