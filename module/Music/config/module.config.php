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
    ),
    'service_manager' => array(
        'factories' => array(
            //'Music\\V1\\Rest\\Album\\AlbumResource' => 'Music\\V1\\Rest\\Album\\AlbumResourceFactory',
        ),
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
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Music\\V1\\Rest\\Album\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Music\\V1\\Rest\\Album\\Controller' => array(
                0 => 'application/vnd.music.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Music\\V1\\Rest\\Album\\Controller' => array(
                0 => 'application/vnd.music.v1+json',
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
        ),
    ),
);
