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
        $form->get('submit')->setValue('Добавить');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $news = new \News\Entity\News();

                $news->exchangeArray($form->getData());

                $date = new \DateTime('NOW');

                $news->setTimeCreate($date);
                $news->setTimeUpdate($date);

                $this->em->persist($news);
                $this->em->flush();

                return $this->redirect()->toRoute('news', array('action' => 'list'));
            }
            else {
                return $this->redirect()->toRoute('news', array('action' => 'list'));
            }
        }

        return array('form' => $form);
    }

    public function detailAction(){      
        
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            return $this->redirect()->toRoute('news', array('action' => 'list'));
        }
        

        $post = $this->em->getRepository('\News\Entity\News')
            ->findOneBy(array('id' => $id));


        if (!$post) {
            return $this->redirect()->toRoute('news', array('action' => 'list'));
        }

        $view = new ViewModel(array(
            'news' => $post->getArrayCopy(),
        ));

        return $view;

    }

    public function editAction()
    {
        $form = new \News\Form\NewsForm();
        $form->get('submit')->setValue('Сохранить');

        $request = $this->getRequest();
        if (!$request->isPost()) {
            
            $id = (int) $this->params()->fromRoute('id', 0);

            if (!$id) {
                return $this->redirect()->toRoute('news', array('action' => 'list'));
            }

            $post = $this->em->getRepository('\News\Entity\News')
                ->findOneBy(array('id' => $id));

            if (!$post) {
                return $this->redirect()->toRoute('news', array('action' => 'list'));
            }


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

                return $this->redirect()->toRoute('news', array('action' => 'list'));
            }
            else {
                return $this->redirect()->toRoute('news', array('action' => 'list'));
            }
        }
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            return $this->redirect()->toRoute('news', array('action' => 'list'));
        }
        

        $post = $this->em->getRepository('\News\Entity\News')
            ->findOneBy(array('id' => $id));


        if (!$post) {
           return $this->redirect()->toRoute('news', array('action' => 'list'));
        }

        $this->em->remove($post);
        $this->em->flush();

        return $this->redirect()->toRoute('news', array('action' => 'list'));
    }
}