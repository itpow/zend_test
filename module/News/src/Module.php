<?php

namespace News;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    

 //    public function getAutoloaderConfig()
	// {
	//     return array(
	//       'Zend\Loader\StandardAutoloader' => array(
	//         'namespaces' => array(
	//           __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
	//         ),
	//       ),
	//     );
	// }


    // public function getControllerConfig()
    // {
    //     return [
    //         'factories' => [
    //             Controller\NewsController::class => function($container) {
                
    //                 return new Controller\NewsController(
    //                     $container->get(Model\News::class)
    //                 );
    //             },
    //         ],
    //     ];
    // }
}

