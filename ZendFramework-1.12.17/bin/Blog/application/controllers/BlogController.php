<?php

class BlogController extends Zend_Controller_Action
{
    /**
     * Specifically for Blog actions.
     */
    public function indexAction()
    {
        $blog = new Application_Model_BlogMapper();
        $this->view->entries = $blog->fetchAll();

        $comments = new Application_Model_CommentsMapper();
        $this->view->centries = $comments->fetchAll();

        $request = $this->getRequest();
        $form    = new Application_Form_Blog();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $blog = new Application_Model_Blog($form->getValues());
                $mapper  = new Application_Model_BlogMapper();
                $mapper->save($blog);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;

       /* $comments = new Application_Model_CommentsMapper();
        $this->view->comments = $comments->fetchAll();

        $request = $this->getRequest();
        $form    = new Application_Form_Comments();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Comments($form->getValues());
                $mapper  = new Application_Model_CommentsMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;*/

    }

    public function editAction() {
        if ($this->getRequest()->isPost()) {
            $edit = $this->getRequest()->getPost('edit');
            if ($edit == "Edit Post") {
                $id = (int)$this->getRequest()->getPost('id');
                $title = $this->getRequest()->getPost('title');
                $user_name = $this->getRequest()->getPost('user_name');
                $description = $this->getRequest()->getPost('description');

                $blog = new Application_Model_DbTable_Blog();
                $blog->editBlogPost($id, $title, $user_name, $description);

                /*echo 'id = ' . $id . ' title = ' . $title . ' username = ' . $user_name . ' description = ' . $description;*/
                return $this->_helper->redirector('index');
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $blogs = new Application_Model_DbTable_Blog();
                $this->view->blog = $blogs->getBlog($id);
            }
        }
    }

    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Delete Post') {
                $id = $this->getRequest()->getPost('id');
                $blog = new Application_Model_DbTable_Blog();
                $blog->deleteBlog($id);
            }
            return $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $blogs = new Application_Model_DbTable_Blog();
            $this->view->blog = $blogs->getBlog($id);
        }
    }


    /**
     * Specifically for Comments actions.
     *
     * @return mixed
     * @throws Exception
     */
    public function commentAction() {
        if ($this->getRequest()->isPost()) {
            $comment = $this->getRequest()->getPost('pcomment');
            if ($comment == "Post Comment") {
                $id = (int)$this->getRequest()->getPost('id');
                $user_name = $this->getRequest()->getPost('user_name');
                $description = $this->getRequest()->getPost('description');

                $comments = new Application_Model_DbTable_Comments();
                $comments->addComment($id, $user_name, $description);

                return $this->_helper->redirector('index');
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $comments = new Application_Model_DbTable_Comments();
                    $this->view->comment = $comments->getComments($id);
                }
            }
        }
    }

    /*public function getCommentsAction() {
        $comments = new Application_Model_CommentsMapper();
        $this->view->entries = $comments->fetchAll();

        $request = $this->getRequest();
        $form    = new Application_Form_Comments();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Comments($form->getValues());
                $mapper  = new Application_Model_CommentsMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }*/
}