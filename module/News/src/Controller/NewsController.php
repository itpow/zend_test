<?php

namespace News\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class NewsController extends AbstractActionController
{
    public function indexAction()
    {
        echo 1;
    }

    public function addAction()
    {
        echo 2;
    }

    public function editAction()
    {
        echo 3;
    }

    public function deleteAction()
    {
        echo 4;
    }
}