<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    protected function initialize()
    {//tagはPhalcon\Tagのやつ。デフォルトで使える？
        $this->tag->prependTitle('INVO | ');
        $this->view->setTemplateAfter('main');
    }
}
