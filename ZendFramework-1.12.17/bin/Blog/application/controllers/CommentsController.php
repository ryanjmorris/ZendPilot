<?php

class CommentsController extends Zend_Controller_Action {
    public function indexAction(){
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
    }

    public function commentsAction() {
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
    }
}