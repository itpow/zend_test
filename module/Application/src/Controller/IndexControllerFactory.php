<?php
namespace Application\Controller;

// This is the container 
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{
       public function __invoke(ContainerInterface $container, $requestedName, array $options = NULL)
       {   
           $serviceManager = $container->get('ServiceManager');
           return new IndexController($serviceManager);
       }    
}