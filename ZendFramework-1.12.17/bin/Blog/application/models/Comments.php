<?php

class Application_Model_Comments {
    protected $_id;
    protected $_user_name;
    protected $_description;
    protected $_date_created;
    protected $_prim_id;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid comment property!');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid comment property');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setUsername($username) {
        $this->_user_name = $username;
        return $this;
    }

    public function getUsername() {
        return $this->_user_name;
    }

    public function setDescription($description) {
        $this->_description = $description;
        return $this;
    }

    public function getDescription() {
        return $this->_description;
    }

    public function setDateCreated($ts) {
        $this->_date_created = $ts;
        return $this;
    }

    public function getDateCreated() {
        return $this->_date_created;
    }

    public function setId($id) {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId() {
        return $this->_id;
    }

    public function setPrimId($id) {
        $this->_prim_id = (int) $id;
        return $this;
    }

    public function getPrimId() {
        return $this->_prim_id;
    }
}