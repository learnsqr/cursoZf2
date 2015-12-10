<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'cinema\\V1\\Rest\\Movie\\MovieResource' => 'cinema\\V1\\Rest\\Movie\\MovieResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'cinema.rest.movie' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/movie[/:movie_id]',
                    'defaults' => array(
                        'controller' => 'cinema\\V1\\Rest\\Movie\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'cinema.rest.movie',
        ),
        'default_version' => 1,
    ),
    'zf-rest' => array(
        'cinema\\V1\\Rest\\Movie\\Controller' => array(
            'listener' => 'cinema\\V1\\Rest\\Movie\\MovieResource',
            'route_name' => 'cinema.rest.movie',
            'route_identifier_name' => 'movie_id',
            'collection_name' => 'movie',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
                3 => 'PATCH',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'cinema\\V1\\Rest\\Movie\\MovieEntity',
            'collection_class' => 'cinema\\V1\\Rest\\Movie\\MovieCollection',
            'service_name' => 'movie',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'cinema\\V1\\Rest\\Movie\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'cinema\\V1\\Rest\\Movie\\Controller' => array(
                0 => 'application/vnd.cinema.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'cinema\\V1\\Rest\\Movie\\Controller' => array(
                0 => 'application/vnd.cinema.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'cinema\\V1\\Rest\\Movie\\MovieEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cinema.rest.movie',
                'route_identifier_name' => 'movie_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'cinema\\V1\\Rest\\Movie\\MovieCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cinema.rest.movie',
                'route_identifier_name' => 'movie_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'cinema\\V1\\Rest\\Movie\\Controller' => array(
            'input_filter' => 'cinema\\V1\\Rest\\Movie\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'cinema\\V1\\Rest\\Movie\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '4',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                        'options' => array(
                            'charlist' => '',
                            'allowAttribs' => '',
                        ),
                    ),
                ),
                'name' => 'director',
            ),
        ),
    ),
);
