<?php

class Application_Model_Blog {
    protected $_id;
    protected $_title;
    protected $_description;
    protected $_user_name;
    protected $_date_created;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid blog property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid blog property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setDescription($text)
    {
        $this->_description = (string) $text;
        return $this;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setTitle($title)
    {
        $this->_title = (string) $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function setDateCreated($ts)
    {
        $this->_date_created = $ts;
        return $this;
    }

    public function getDateCreated()
    {
        return $this->_date_created;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setUsername($username) {
        $this->_user_name = $username;
        return $this;
    }

    public function getUsername() {
        return $this->_user_name;
    }
}