<?php
final class Registry {
	private $data = array();
    public $language;
    public $debug;
    public $config;
    public $api;

	public function get($key) {
		return (isset($this->data[$key]) ? $this->data[$key] : null);
	}

	public function set($key, $value) {
		$this->data[$key] = $value;
	}

	public function has($key) {
		return isset($this->data[$key]);
	}
}
?>