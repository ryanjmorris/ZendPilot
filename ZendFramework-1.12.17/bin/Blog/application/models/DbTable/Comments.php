<?php

class Application_Model_DbTable_Comments extends Zend_Db_Table_Abstract {

    protected $_name = 'comments';

    public function fetchAll() {
        $row = $this->select('*');

        return $row;
    }

    public function getComments($id) {
        $id = (int)$id;
        $row = $this->fetchRow('id = '.$id);
        if (!$row) {
            throw new Exception('Could not find row '.$id);
        }
        return $row->toArray();
    }

    public function addComment($id, $user_name, $description) {
        $data = array(
            'id' => (int)$id,
            'user_name' => $user_name,
            'description' => $description,
            'date_created' => date('Y-m-d H:i:s')
        );
        $this->insert($data);
    }

}
