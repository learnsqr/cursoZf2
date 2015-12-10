<?php
return array(
    'cinema\\V1\\Rest\\Movie\\Controller' => array(
        'description' => 'Movie endpoint',
        'collection' => array(
            'description' => 'Collection for movies',
        ),
        'entity' => array(
            'description' => 'Entity for movies',
            'GET' => array(
                'description' => 'Get a movie by id',
                'response' => '{
   "_links": {
       "self": {
           "href": "/movie[/:movie_id]"
       }
   }
   "director": ""
}',
            ),
        ),
    ),
);
