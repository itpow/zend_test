<?php

namespace News\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;
use News\Form\NewsForm;

class NewsController extends AbstractActionController
{

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function listAction()
    {
        $news = $this->em->getRepository('\News\Entity\News')->findBy(array(), array('time_create' => 'DESC'));

        $view = new ViewModel(array(
            'news' => $news,
        ));

        return $view;
    }

    public function addAction()
    {   
        $form = new \News\Form\NewsForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

                $blogpost = new \MyBlog\Entity\BlogPost();

                $blogpost->exchangeArray($form->getData());

                $blogpost->setCreated(time());
                $blogpost->setUserId(0);

                $objectManager->persist($blogpost);
                $objectManager->flush();

                $message = 'Blogpost succesfully saved!';
                $this->flashMessenger()->addMessage($message);

                // Redirect to list of blogposts
                return $this->redirect()->toRoute('blog');
            }
            else {
                $message = 'Error while saving blogpost';
                $this->flashMessenger()->addErrorMessage($message);
            }
        }

        return array('form' => $form);
    }

    public function detailAction(){      
        
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            $this->flashMessenger()->addErrorMessage('Blogpost id doesn\'t set');
            return $this->redirect()->toRoute('news');
        }
        

        $post = $this->em->getRepository('\News\Entity\News')
            ->findOneBy(array('id' => $id));


        if (!$post) {
            $this->flashMessenger()->addErrorMessage(sprintf('Blogpost with id %s doesn\'t exists', $id));
            return $this->redirect()->toRoute('news');
        }

        $view = new ViewModel(array(
            'news' => $post->getArrayCopy(),
        ));

        return $view;

    }

    public function editAction()
    {
        echo 3;
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            $this->flashMessenger()->addErrorMessage('Blogpost id doesn\'t set');
            return $this->redirect()->toRoute('news');
        }
        

        $post = $this->em->getRepository('\News\Entity\News')
            ->findOneBy(array('id' => $id));


        if (!$post) {
            $this->flashMessenger()->addErrorMessage(sprintf('Blogpost with id %s doesn\'t exists', $id));
            return $this->redirect()->toRoute('news');
        }

        $this->em->remove($post);
        $this->em->flush();

        $this->redirect()->toRoute('news/list');
    }
}