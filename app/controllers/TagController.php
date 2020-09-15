<?php


use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TagController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Tag Page');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new TagForm;

    }
    public function searchAction(){
        $numberPage = 1;
        if ($this->request->isPost()) {
            #このTagはmodelの名前
            $query = Criteria::fromInput($this->di, "Tag", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $dataTag = Tag::find($parameters);
        if (count($dataTag) == 0) {
            $this->flash->notice("No data");

            return $this->dispatcher->forward(
                [
                    "controller" => "tag",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $dataTag,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->dataTag = $dataTag;
    }
    public function newAction()
    {
        $this->view->form = new TagForm(null, ['edit' => true]);
    }


    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $dataTag = Tag::findFirstById($id);
            if (!$dataTag) {
                $this->flash->error("No Data to edit");

                return $this->dispatcher->forward(
                    [
                        "controller" => "tag",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new TagForm($dataTag, ['edit' => true]);
        }
    }


    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "tag",
                    "action"     => "index",
                ]
            );
        }

        $form = new TagForm;
        $dataTag = new Tag();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $dataTag)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "tag",
                    "action"     => "new",
                ]
            );
        }

        if ($dataTag->save() == false) {
            foreach ($dataTag->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "tag",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Data was created successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "tag",
                "action"     => "index",
            ]
        );
    }

    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "tag",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");
        $dataTag = Tag::findFirstById($id);
        if (!$dataTag) {
            $this->flash->error("any data does not exist");
            return $this->dispatcher->forward(
                [
                    "controller" => "tag",
                    "action"     => "index",
                ]
            );
        }

        $form = new TagForm;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $dataTag)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "tag",
                    "action"     => "new",
                ]
            );
        }

        if ($dataTag->save() == false) {
            foreach ($dataTag->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "tag",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Data was updated successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "tag",
                "action"     => "index",
            ]
        );
    }


    public function deleteAction($id)
    {
        $dataTag = Tag::findFirstById($id);
        if (!$dataTag) {
            $this->flash->error("Product types was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "tag",
                    "action"     => "index",
                ]
            );
        }

        if (!$dataTag->delete()) {
            foreach ($dataTag->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "tag",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("data was deleted");

        return $this->dispatcher->forward(
            [
                "controller" => "tag",
                "action"     => "index",
            ]
        );
    }
}


