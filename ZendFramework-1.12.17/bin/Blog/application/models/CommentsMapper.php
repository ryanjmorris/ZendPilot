<?php

class Application_Model_CommentsMapper {

    public $_dbTable;

    public function setDbTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided.');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Comments');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Comments $comments) {
        $data = array(
            'user_name'    => $comments->getUsername(),
            'description' => $comments->getDescription(),
            'date_created' => date('Y-m-d H:i:s')
        );

        if (null === ($id = $comments->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Comments $comments) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $comments->setId($row->id)
                ->setUsername($row->user_name)
                ->setDescription($row->description)
                ->setDateCreated($row->date_created)
                ->setPrimId($row->prim_id);
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();

        foreach ($resultSet as $row) {
            $entries = new Application_Model_Comments();
            $entries->setId($row->id)
                ->setUsername($row->user_name)
                ->setDescription($row->description)
                ->setDateCreated($row->date_created)
                ->setPrimId($row->prim_id);
            $entries[] = $entries;
        }
        return $entries;
    }
}