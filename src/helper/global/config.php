<?php

class Config
{
    protected $data = array();

    public function get($key)
    {
        return $this->data[$key];
    }

    public function has($key)
    {
        return isset($this->data[$key]);
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function load($function)
    {
        $file = DIR_FUNCTION . $function . '/config.php';
        if (file_exists($file)) {
            $_ = array();

            require($file);

            $this->data = array_merge($this->data, $_);
        } else {
            trigger_error('Error: Could not load config ' . $function . '!');
            exit();
        }
    }
}