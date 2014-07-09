<?php
class Language{
    public $language;
    protected $_data = array();
    protected $_registry;
    protected $_dir;
    
    public function __construct($_registry)
    {
        $this->_registry = $_registry;    
        $this->_dir = __DIR__.'/../function/'.$this->_registry->config->get('LoadedClass').'/language/';
        $languages = glob($this->_dir.'*', GLOB_ONLYDIR);
        $allowedLanguages = array();
        foreach($languages as $language)
        {
           $allowedLanguages[] = str_replace($this->_dir,'',$language);           
        }
        $this->_registry->config->set('AllowedLanguages',$allowedLanguages);
        $this->load();
    }
    
    public function get($key) {
		return (isset($this->_data[$key]) ? $this->_data[$key] : $key);
	}
    
    public function load($filename=false) {
        $filename = $filename?$filename:$this->_registry->config->get('Language');
		$file = $this->_dir.$this->_registry->config->get('Language') .'/'. $filename . '.php';
		if (file_exists($file)) {
			$_ = array();

			require($file);

			$this->_data = array_merge($this->_data, $_);

			return $this->_data;
		}
        else 
        {
			trigger_error('Error: Could not load language ' . $filename . '!');
		}
	}
}