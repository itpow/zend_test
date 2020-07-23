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
                // $objectManager = $this->em->getRepository('\News\Entity\News');

                $news = new \News\Entity\News();

                $news->exchangeArray($form->getData());

                $date = new \DateTime('NOW');

                $news->setTimeCreate($date);
                $news->setTimeUpdate($date);

                $this->em->persist($news);
                $this->em->flush();

                // $message = 'Blogpost succesfully saved!';
                // $this->flashMessenger()->addMessage($message);

                // Redirect to list of blogposts
                return $this->redirect()->toRoute('news');
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
        // Create form.
        $form = new \News\Form\NewsForm();
        $form->get('submit')->setValue('Save');

        $request = $this->getRequest();
        if (!$request->isPost()) {
            // Check if id and blogpost exists.
            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                // $this->flashMessenger()->addErrorMessage('Blogpost id doesn\'t set');
                return $this->redirect()->toRoute('news');
            }

            // $objectManager = $this->em->getRepository('\News\Entity\News');

            $post = $this->em->getRepository('\News\Entity\News')
                ->findOneBy(array('id' => $id));

            if (!$post) {
                // $this->flashMessenger()->addErrorMessage(sprintf('Blogpost with id %s doesn\'t exists', $id));
                return $this->redirect()->toRoute('news');
            }


            // Fill form data.
            $form->bind($post);
            return array('form' => $form);
        }
        else {
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $data = $form->getData();
                $id = $data['id'];

                try {
                    $news = $this->em->getRepository('\News\Entity\News')
                            ->findOneBy(array('id' => $id));
                }
                catch (\Exception $ex) {
                    return $this->redirect()->toRoute('news', array(
                        'action' => 'list'
                    ));
                }

                $news->exchangeArray($form->getData());

                $date = new \DateTime('NOW');

                $news->setTimeUpdate($date);


                $this->em->persist($news);
                $this->em->flush();

                // $message = 'Blogpost succesfully saved!';
                // $this->flashMessenger()->addMessage($message);

                // Redirect to list of blogposts
                return $this->redirect()->toRoute('news', array('action' => 'list'));
            }
            else {
                return $this->redirect()->toRoute('news', array('action' => 'list'));
                // $message = 'Error while saving blogpost';
                // $this->flashMessenger()->addErrorMessage($message);
            }
        }
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
            // $this->flashMessenger()->addErrorMessage(sprintf('Blogpost with id %s doesn\'t exists', $id));
            return $this->redirect()->toRoute('news');
        }

        $this->em->remove($post);
        $this->em->flush();

        $this->redirect()->toRoute('news');
    }
}