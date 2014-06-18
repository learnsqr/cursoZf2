<?php
return array(
    'db' => array(
        'adapters' => array(
            'Db\\StatusLib' => array(),
        ),
    ),
    'zf-mvc-auth' => array(
        'authentication' => array(),
    ),
    'router' => array(
        'routes' => array(
            'oauth' => array(
                'options' => array(
                    'route' => '/oauth',
                ),
            ),
        ),
    ),
);
