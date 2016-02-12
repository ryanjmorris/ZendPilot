<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $comments = new Application_Model_CommentsMapper();
        $this->view->entries = $comments->fetchAll();

        $request = $this->getRequest();
        $form    = new Application_Form_Blog();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Comments($form->getValues());
                $mapper  = new Application_Model_CommentsMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }

    public function commentsAction() {

    }

}

