<?php

namespace News;

use Zend\Router\Http\Segment;
// use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
          // NewsController::class => IndexControllerFactory::class,
            'News\Controller\NewsController' => 'News\Controller\IndexControllerFactory',
            // 'yourModule\Controller\Index' => 'yourModule\Controller\Factory\IndexControllerFactory',
        ],
    ],

    'doctrine' => array(
        'driver' => array(
            'News_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                     'News\Entity' =>  'News_driver'
                ),
            ),
        ),
    ),   

    'router' => [
        'routes' => [
            'news' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/news[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\NewsController::class,
                        'action'     => 'index',
                    ],

                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'news' => __DIR__ . '/../view',
        ],
    ],
];

