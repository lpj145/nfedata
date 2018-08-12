<?php
namespace NfeData;

class SpedData
{
    private $data;

    public function __construct($data)
    {
        $this->setData($data);
    }

    // Macro executes
    public function transform()
    {

    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * @param $key
     * @return SpedData
     */
    public function take($key)
    {
        return new static($this->get($key));
    }

    public function match(string $regexp, $assoc = false)
    {
        preg_match_all($regexp, $this, $matches, PREG_PATTERN_ORDER);

        return $assoc ? $matches : $matches[0];
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function get($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if (is_string($this->data)) {
            return $this->data;
        }

        return json_encode($this->data, true);
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    protected function setData($data)
    {
        if (is_string($data)) {
            $this->data = $data;
            return;
        }

        array_map(function($value, $key){
            $this->data[$key] = $value;
        }, (array)$data, array_keys($data));
    }
}
