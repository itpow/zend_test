<?php

namespace News\Controller;

// use News\Entity\Test;
// use News\Model\News;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;

class NewsController extends AbstractActionController
{

     // Add this property:
    private $table;

    // Add this constructor:
    // public function __construct(News $table)
    // {
    //     $this->table = $table;
    // }

   protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function indexAction()
    {
        // return new ViewModel();
        
      
        $data = $em->getRepository('Entity\News')->findAll();

        var_dump($data);
        

        // foreach($data as $key=>$row)
        // {
        //     echo $row->getAlbum()->getArtist().' :: '.$row->getTrackTitle();
        //     echo '<br />';
        // }

        // return new ViewModel([
        //         'news' => $this->table->fetchAll(),
        // ]);
    }

    public function addAction()
    {   
        echo 2;
    }

    public function viewAction(){


        
        $repo = $this->em->getRepository('News\Entity\Test');
        var_dump($repo);
        die();
        
        // $id = (int) $this->params()->fromRoute('id', 0);

        // if (!$id) {
        //     $this->flashMessenger()->addErrorMessage('Blogpost id doesn\'t set');
        //     return $this->redirect()->toRoute('news');
        // }


        // $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        

        // $post = $objectManager
        //     ->getRepository('\MyBlog\Entity\News')
        //     ->findOneBy(array('id' => $id));

        // if (!$post) {
        //     $this->flashMessenger()->addErrorMessage(sprintf('Blogpost with id %s doesn\'t exists', $id));
        //     return $this->redirect()->toRoute('blog');
        // }

        // $view = new ViewModel(array(
        //     'post' => $post->getArrayCopy(),
        // ));

        // return $view;

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