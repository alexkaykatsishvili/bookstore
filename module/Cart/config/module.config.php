<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Cart\Controller\Index' => 'Cart\Controller\IndexController',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'router' => array(
        'routes' => array(
            'cart' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/cart/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cart\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),

                'may_terminate' => true,

                'child_routes' => array(

                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[:controller/[:action/[:id/]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),//child routes
            ),
        ),
    ),
);
