<?php
return array(
    'router' => array(
        'routes' => array(
            'music.rest.album' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/albums[/:album_id]',
                    'defaults' => array(
                        'controller' => 'Music\\V1\\Rest\\Album\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'music.rest.album',
        ),
        'default_version' => 2,
    ),
    'service_manager' => array(
        'factories' => array(),
        'invokables' => array(),
    ),
    'zf-rest' => array(
        'Music\\V1\\Rest\\Album\\Controller' => array(
            'listener' => 'Music\\V1\\Rest\\Album\\AlbumResource',
            'route_name' => 'music.rest.album',
            'route_identifier_name' => 'album_id',
            'collection_name' => 'album',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Music\\V1\\Rest\\Album\\AlbumEntity',
            'collection_class' => 'Music\\V1\\Rest\\Album\\AlbumCollection',
            'service_name' => 'Album',
        ),
        'Music\\V2\\Rest\\Album\\Controller' => array(
            'listener' => 'Music\\V2\\Rest\\Album\\AlbumResource',
            'route_name' => 'music.rest.album',
            'route_identifier_name' => 'album_id',
            'collection_name' => 'album',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => '25',
            'page_size_param' => '',
            'entity_class' => 'Music\\V2\\Rest\\Album\\AlbumEntity',
            'collection_class' => 'Music\\V2\\Rest\\Album\\AlbumCollection',
            'service_name' => 'Album',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Music\\V1\\Rest\\Album\\Controller' => 'HalJson',
            'Music\\V2\\Rest\\Album\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Music\\V1\\Rest\\Album\\Controller' => array(
                0 => 'application/vnd.music.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Music\\V2\\Rest\\Album\\Controller' => array(
                0 => 'application/vnd.music.v2+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Music\\V1\\Rest\\Album\\Controller' => array(
                0 => 'application/vnd.music.v1+json',
                1 => 'application/json',
            ),
            'Music\\V2\\Rest\\Album\\Controller' => array(
                0 => 'application/vnd.music.v2+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Music\\V1\\Rest\\Album\\AlbumEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'music.rest.album',
                'route_identifier_name' => 'album_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Music\\V1\\Rest\\Album\\AlbumCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'music.rest.album',
                'route_identifier_name' => 'album_id',
                'is_collection' => true,
            ),
            'Music\\V2\\Rest\\Album\\AlbumEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'music.rest.album',
                'route_identifier_name' => 'album_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ClassMethods',
            ),
            'Music\\V2\\Rest\\Album\\AlbumCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'music.rest.album',
                'route_identifier_name' => 'album_id',
                'is_collection' => '1',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Music\\V1\\Rest\\Album\\Controller' => array(
            'input_filter' => 'Music\\V1\\Rest\\Album\\Validator',
        ),
        'Music\\V2\\Rest\\Album\\Controller' => array(
            'input_filter' => 'Music\\V2\\Rest\\Album\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Music\\V1\\Rest\\Album\\Validator' => array(
            0 => array(
                'name' => 'title',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Title of this album',
            ),
            1 => array(
                'name' => 'artist',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Artist who made this album!',
            ),
        ),
        'Music\\V2\\Rest\\Album\\Validator' => array(
            0 => array(
                'name' => 'title',
                'required' => '1',
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Title of this album',
            ),
            1 => array(
                'name' => 'artist',
                'required' => '1',
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Artist who made this album!',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'Music\\V2\\Rest\\Album\\Controller' => array(
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PATCH' => false,
                    'PUT' => false,
                    'DELETE' => true,
                ),
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PATCH' => false,
                    'PUT' => false,
                    'DELETE' => false,
                ),
            ),
        ),
    ),
);
