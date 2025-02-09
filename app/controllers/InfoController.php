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

        #ログインした時のusernameを元にレコードを取り出す
        $users = Users::find("username = '$username'");
        
        $this->view->users = $users;
        
        
    }
    public function editNameAction($id)
    {
        if (!$this->request->isPost()) {

            $users = Users::findFirstById($id);
            if (!$users) {
                $this->flash->error("User to edit was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "info",
                        "action"     => "error",
                    ]
                );
            }

            $this->view->form = new EditNameForm($users, ['edit' => true]);
            $this->session->set("user", $users);
        }
    }
    public function saveAction(){
        if ($this->request->isPost()){
            $name = $this->request->getPost("name");
            $user = $this->session->get("user");
            if ($user->name == $name){
                $this->flash->error("Same name input as you have registered before");
                return $this->dispatcher->forward(
                    [
                        "controller" => "info",
                        "action"     => "error",
                    ]
                    );
            }
            $user->name = $name;

            if ($user->save() == false){
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            }else{
                $this->flash->success('Your Name was updated!');
    
                return $this->dispatcher->forward(
                    [
                            "controller" => "info",
                            "action"     => "special",
                    ]
                );
            }
        }
    }
    public function deleteAction($id){
        $users = Users::findFirstById($id);
        if (!$users) {
            $this->flash->error("User was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "info",
                    "action"     => "error",
                ]
            );
        }

        if (!$users->delete()) {
            foreach ($users->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "info",
                    "action"     => "error",
                ]
            );
        }

        $this->flash->success("User was deleted");

        return $this->dispatcher->forward(
            [
                "controller" => "info",
                "action"     => "index",
            ]
        );
    }
    public function errorAction(){

    }

    
    
}