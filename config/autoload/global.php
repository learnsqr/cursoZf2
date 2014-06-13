<?php
return array(
    'db' => array(
        'adapters' => array(
            'Db\\StatusLib' => array(),
        ),
    ),
    'zf-mvc-auth' => array(
        'authentication' => array(
            'http' => array(
                'accept_schemes' => array(
                    0 => 'basic',
                ),
                'realm' => 'api',
            ),
        ),
    ),
);
