<?php
class Debug{
    protected $_status;
    protected $_logFile;
    
    public function __construct($_registry)
    {
        $this->_status = $_registry->config->get('DebugStatus');
        $this->_logFile = __DIR__.'/../'.$_registry->config->get('LogFile');
    }
    
    public function _debug($message, $data = array())
    {
        if ($this->_status == true) {
            $time = date("[Y-m-d H:i:s] ");
            $message .= $data != array() ? " | " . serialize($data) : "";
            error_log($time . $message . "\n \r", 3, $this->_logFile);
        }
    }
}