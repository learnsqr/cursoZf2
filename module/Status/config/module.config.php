<?php
return array(
    'controllers' => array(
        'factories' => array(
            'Status\\V1\\Rpc\\Ping\\Controller' => 'Status\\V1\\Rpc\\Ping\\PingControllerFactory',
            'Status\\V2\\Rpc\\Ping\\Controller' => 'Status\\V2\\Rpc\\Ping\\PingControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'status.rpc.ping' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ping',
                    'defaults' => array(
                        'controller' => 'Status\\V1\\Rpc\\Ping\\Controller',
                        'action' => 'ping',
                    ),
                ),
            ),
            'status.rest.status' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/status[/:status_id]',
                    'defaults' => array(
                        'controller' => 'Status\\V1\\Rest\\Status\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'status.rpc.ping',
            1 => 'status.rest.status',
        ),
        'default_version' => 1,
    ),
    'zf-rpc' => array(
        'Status\\V1\\Rpc\\Ping\\Controller' => array(
            'service_name' => 'Ping',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'status.rpc.ping',
        ),
        'Status\\V2\\Rpc\\Ping\\Controller' => array(
            'service_name' => 'Ping',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'status.rpc.ping',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Status\\V1\\Rpc\\Ping\\Controller' => 'Json',
            'Status\\V1\\Rest\\Status\\Controller' => 'HalJson',
            'Status\\V2\\Rpc\\Ping\\Controller' => 'Json',
            'Status\\V2\\Rest\\Status\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Status\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.status.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Status\\V1\\Rest\\Status\\Controller' => array(
                0 => 'application/vnd.status.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Status\\V2\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.status.v2+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Status\\V2\\Rest\\Status\\Controller' => array(
                0 => 'application/vnd.status.v2+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Status\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.status.v1+json',
                1 => 'application/json',
            ),
            'Status\\V1\\Rest\\Status\\Controller' => array(
                0 => 'application/vnd.status.v1+json',
                1 => 'application/json',
            ),
            'Status\\V2\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.status.v2+json',
                1 => 'application/json',
            ),
            'Status\\V2\\Rest\\Status\\Controller' => array(
                0 => 'application/vnd.status.v2+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Status\\V1\\Rpc\\Ping\\Controller' => array(
            'input_filter' => 'Status\\V1\\Rpc\\Ping\\Validator',
        ),
        'Status\\V1\\Rest\\Status\\Controller' => array(
            'input_filter' => 'Status\\V1\\Rest\\Status\\Validator',
        ),
        'Status\\V2\\Rpc\\Ping\\Controller' => array(
            'input_filter' => 'Status\\V2\\Rpc\\Ping\\Validator',
        ),
        'Status\\V2\\Rest\\Status\\Controller' => array(
            'input_filter' => 'Status\\V2\\Rest\\Status\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Status\\V1\\Rpc\\Ping\\Validator' => array(
            0 => array(
                'name' => 'ack',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Acknowledge the request with a timestamp.',
            ),
        ),
        'Status\\V1\\Rest\\Status\\Validator' => array(
            0 => array(
                'name' => 'message',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Status update message.',
            ),
            1 => array(
                'name' => 'user',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'User providing status update.',
            ),
            2 => array(
                'name' => 'timestamp',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Timestamp of status update.',
            ),
        ),
        'Status\\V2\\Rpc\\Ping\\Validator' => array(
            0 => array(
                'name' => 'ack',
                'required' => '1',
                'filters' => array(),
                'validators' => array(),
                'description' => 'Acknowledge the request with a timestamp.',
            ),
        ),
        'Status\\V2\\Rest\\Status\\Validator' => array(
            0 => array(
                'name' => 'message',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '140',
                        ),
                    ),
                ),
                'description' => 'Status update message.',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'user',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^(mwop|zeevs|andi)$/',
                            'message' => 'Invalid user supplied.',
                        ),
                    ),
                ),
                'description' => 'User providing status update.',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'timestamp',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Digits',
                        'options' => array(),
                    ),
                ),
                'description' => 'Timestamp of status update.',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Status\\V1\\Rest\\Status\\StatusResource' => 'Status\\V1\\Rest\\Status\\StatusResourceFactory',
            'Status\\V2\\Rest\\Status\\StatusResource' => 'Status\\V2\\Rest\\Status\\StatusResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'Status\\V1\\Rest\\Status\\Controller' => array(
            'listener' => 'Status\\V1\\Rest\\Status\\StatusResource',
            'route_name' => 'status.rest.status',
            'route_identifier_name' => 'status_id',
            'collection_name' => 'status',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => '5',
            'page_size_param' => null,
            'entity_class' => 'StatusLib\\Entity',
            'collection_class' => 'StatusLib\\Collection',
            'service_name' => 'Status',
        ),
        'Status\\V2\\Rest\\Status\\Controller' => array(
            'listener' => 'Status\\V2\\Rest\\Status\\StatusResource',
            'route_name' => 'status.rest.status',
            'route_identifier_name' => 'status_id',
            'collection_name' => 'status',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => '5',
            'page_size_param' => '',
            'entity_class' => 'StatusLib\\Entity',
            'collection_class' => 'StatusLib\\Collection',
            'service_name' => 'Status',
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Status\\V1\\Rest\\Status\\StatusEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Status\\V1\\Rest\\Status\\StatusCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'is_collection' => true,
            ),
            'StatusLib\\Entity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'StatusLib\\Collection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'is_collection' => '1',
            ),
            'Status\\V2\\Rest\\Status\\StatusEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Status\\V2\\Rest\\Status\\StatusCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'is_collection' => '1',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'Status\\V2\\Rest\\Status\\Controller' => array(
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PATCH' => false,
                    'PUT' => false,
                    'DELETE' => false,
                ),
                'collection' => array(
                    'GET' => false,
                    'POST' => true,
                    'PATCH' => false,
                    'PUT' => false,
                    'DELETE' => false,
                ),
            ),
            'Status\\V2\\Rpc\\Ping\\Controller' => array(
                'actions' => array(
                    'ping' => array(
                        'GET' => false,
                        'POST' => false,
                        'PATCH' => false,
                        'PUT' => false,
                        'DELETE' => false,
                    ),
                ),
            ),
        ),
    ),
);
