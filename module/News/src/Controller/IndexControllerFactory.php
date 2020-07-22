<?php
namespace News\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use News\Controller\NewsController;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new NewsController($container->get('Doctrine\ORM\EntityManager'));
    }
}