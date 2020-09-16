<?php

class InfoController extends ControllerBase{

    public function initialize()
    {
        $this->tag->setTitle('Info');
        parent::initialize();
    }

    public function indexAction(){

        $this->view->form = new InfoForm;

        if (!$this->request->isPost()) {
            $this->tag->setDefault('username', 'demo');
            $this->tag->setDefault('password', 'phalcon');
        }
    }
    public function loginedAction(){

        if ($this->request->isPost()) {

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = Users::findFirst([
                "(username = :username:) AND password = :password:",
                'bind' => ['username' => $username, 'password' => sha1($password)]
            ]);
            if ($user != false) {

                $this->session->set("username", $username);

                return $this->dispatcher->forward(
                    [
                        "controller" => "info",
                        "action"     => "special",
                    ]
                );
            }

            $this->flash->error('Wrong username/password');
        }
    }

    public function specialAction(){
        $username = $this->session->get("username");
        $this->view->username = $username;
        
    }
    
}