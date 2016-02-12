<?php
class Application_Form_Blog extends Zend_Form {
    public function init() {
        //Set the method for the display form to POST
        $this->setMethod('post');

        //Add a title for your post.
        $this->addElement('text', 'title', array(
            'label'      => 'Blog title',
            'required'   => true,
            'filters'    => array('StringTrim')
        ));

        //Add an username element
        $this->addElement('text', 'username', array(
            'label'      => 'Your username',
            'required'   => true,
            'filters'    => array('StringTrim')
        ));

        //Add the comment element
        $this->addElement('textarea', 'description', array(
            'label'      => 'Please describe your post',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array (0, 30000))
            )
        ));

        //Seems outdated captcha, not useful.
       /* $this->addElement('captcha', 'captcha', array(
            'label'     => 'Please enter the 5 letters displayed below: ',
            'required'  => true,
            'captcha'   => array(
                'captcha' => 'Figlet',
                'wordLen' => 150,
                'timeout' => 300
            )
        ));*/

        //Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'    => true,
            'label'     => 'Create Post'
        ));

        //Lastly, add some CSRF protection
        /*$this->addElement('hash', 'csrf', array(
            'ignore'    => true
        ));*/
    }

    public function editBlog() {
        //Set the method for the display form to POST
        $this->setMethod('post');

        //Add a title for your post.
        $this->addElement('text', 'title', array(
            'label'      => 'Blog title',
            'required'   => true,
            'filters'    => array('StringTrim')
        ));

        //Add an username element
        $this->addElement('text', 'username', array(
            'label'      => 'Your username',
            'required'   => true,
            'filters'    => array('StringTrim')
        ));

        //Add the comment element
        $this->addElement('textarea', 'description', array(
            'label'      => 'Please describe your post',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array (0, 30000))
            )
        ));

        //Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'    => true,
            'label'     => 'Save Edit'
        ));
    }

    public function comment() {
        //Set the method for the display form to POST
        $this->setMethod('post');

        //Add a title for your post.
        $this->addElement('text', 'username', array(
            'label'      => 'Post your username',
            'required'   => true,
            'filters'    => array('StringTrim')
        ));

        //Add the comment element
        $this->addElement('textarea', 'description', array(
            'label'      => 'Comment on the post!',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array (0, 30000))
            )
        ));

        //Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'    => true,
            'label'     => 'Submit Comment'
        ));
    }
}