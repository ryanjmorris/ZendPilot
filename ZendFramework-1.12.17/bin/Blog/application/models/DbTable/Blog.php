<?php

class Application_Model_DbTable_Blog extends Zend_Db_Table_Abstract {

    protected $_name = 'blog';

    public function getBlog($id) {
        $id = (int)$id;
        $row = $this->fetchRow('id = '.$id);
        if (!$row) {
           throw new Exception('Could not find row '.$id);
        }
        return $row->toArray();
    }

    public function newBlogPost($title, $user_name, $description) {
        $data = array(
            'title' => $title,
            'user_name' => $user_name,
            'description' => $description,
            'date_created' => date('Y-m-d H:i:s')
        );

        $this->insert($data);
    }

    public function editBlogPost($id, $title, $user_name, $description) {
        $data = array(
            'title' => $title,
            'user_name' => $user_name,
            'description' => $description,
            'date_created' => date('Y-m-d H:i:s')
        );

        if (null === $data) {
            echo 'I HAVE NO VALUES';
        } else {
            $this->update($data, 'id = '.$id);
        }
    }

    public function deleteBlog($id) {
        $this->delete('id = '.(int)$id);
    }
}