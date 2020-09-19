<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;

class InfoForm extends Form{
    public function Initialize(){

        $name = new Text('username');
        $name->setLabel('Username');
        $name->setFilters(['alpha']);
        $name->addValidators([
            new PresenceOf([
                'message' => 'Please enter your desired user name'
            ])
        ]);
        $this->add($name);

        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidators([
            new PresenceOf([
                'message' => 'Password is required'
            ])
        ]);
        $this->add($password);


    }
}