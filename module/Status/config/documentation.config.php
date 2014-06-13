<?php
return array(
    'Status\\V1\\Rpc\\Ping\\Controller' => array(
        'GET' => array(
            'description' => 'Ping the API for acknowledgement.',
            'request' => null,
            'response' => '{
   "ack": "Acknowledge the request with a timestamp."
}',
        ),
        'description' => 'Ping the API.',
    ),
    'Status\\V1\\Rest\\Status\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieve a paginated list of status messages.',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/status"
       },
       "first": {
           "href": "/status?page={page}"
       },
       "prev": {
           "href": "/status?page={page}"
       },
       "next": {
           "href": "/status?page={page}"
       },
       "last": {
           "href": "/status?page={page}"
       }
   }
   "_embedded": {
       "status": [
           {
               "_links": {
                   "self": {
                       "href": "/status[/:status_id]"
                   }
               }
              "message": "Status update message.",
              "user": "User providing status update.",
              "timestamp": "Timestamp of status update."
           }
       ]
   }
}',
            ),
            'description' => 'Interact with collections of status messages.',
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retrieve an individual status message.',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/status[/:status_id]"
       }
   }
   "message": "Status update message.",
   "user": "User providing status update.",
   "timestamp": "Timestamp of status update."
}',
            ),
            'description' => 'Interact with individual status messages.',
        ),
        'description' => 'Status API.',
    ),
    'Status\\V2\\Rpc\\Ping\\Controller' => array(
        'GET' => array(
            'description' => 'Ping the API for acknowledgement.',
            'request' => '',
            'response' => '{
   "ack": "Acknowledge the request with a timestamp."
}',
        ),
        'description' => 'Ping the API.',
    ),
    'Status\\V2\\Rest\\Status\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieve a paginated list of status messages.',
                'request' => '',
                'response' => '{
   "_links": {
       "self": {
           "href": "/status"
       },
       "first": {
           "href": "/status?page={page}"
       },
       "prev": {
           "href": "/status?page={page}"
       },
       "next": {
           "href": "/status?page={page}"
       },
       "last": {
           "href": "/status?page={page}"
       }
   }
   "_embedded": {
       "status": [
           {
               "_links": {
                   "self": {
                       "href": "/status[/:status_id]"
                   }
               }
              "message": "Status update message.",
              "user": "User providing status update.",
              "timestamp": "Timestamp of status update."
           }
       ]
   }
}',
            ),
            'description' => 'Interact with collections of status messages.',
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retrieve an individual status message.',
                'request' => '',
                'response' => '{
   "_links": {
       "self": {
           "href": "/status[/:status_id]"
       }
   }
   "message": "Status update message.",
   "user": "User providing status update.",
   "timestamp": "Timestamp of status update."
}',
            ),
            'description' => 'Interact with individual status messages.',
        ),
        'description' => 'Status API.',
    ),
);
