# Create an API using Apigility
Ref: Apigility Intro [PDF presentation - `Rob Allen`, March 2014](http://akrabat.com/wp-content/uploads/20140318-phpne-apigility-intro.pdf "Apigility Intro.").  


# Start Server

	php public/index.php development enable
	php -S 0:8080 -t public/ public/index.php
	
# Test your API with curl
	curl -s -H "Accept: application/vnd.music.v1+json" \
    http://localhost:8080/albums | python -mjson.tool
    
# Create the Albums Collection Endpoint
	AlbumCollection
	AlbumEntity
	AlbumResource

![Alt text](/assets/developer/albums-endpoints.png "Album Endpoints") 

# Create a Database
	
sqlite3 -echo data/music.db < data/album.sql
	
	CREATE TABLE album (
	    album_id int NOT NULL primary key,
	    artist text NOT NULL,
	    title text NOT NULL,
	);
	 
	INSERT INTO album (artist, title)
	    VALUES ('Eninem', 'The Marshall Mathers LP 2');
	INSERT INTO album (artist, title)
	    VALUES ('James Arthur', 'James Arthur');
	INSERT INTO album (artist, title)
	    VALUES ('Tinie  Tempah', 'Demonstration');
	INSERT INTO album (artist, title)
	    VALUES ('Andre Rieu', 'Music of the Night');
	INSERT INTO album (artist, title)
	    VALUES ('The Overtones', 'Saturday Night at the Movies');
	    
	    
# Represent Data with an Entity

	<?php
	namespace Music\V1\Rest\Album;
	 
	class AlbumEntity
	{
	    public $album_id;
	    public $artist;
	    public $title;
	}
	
# Hydrator as ObjectProperty 

We need to configure a ZF2 hydrator so that Apigility can convert an AlbumEntity into JSON (ObjectProperty hydrator)

![Alt text](/assets/developer/hydrator-name.png "Hydrator Service name") 

__module/Music/config/module.config.php:__

	'metadata_map' => array(
	  'Music\\V1\\Rest\\Album\\AlbumEntity' => array(
	    'identifier_name' => 'album_id',
	    'route_name' => 'music.rest.album',
	    'hydrator' => 'Zend\Stdlib\Hydrator\ObjectProperty',
	  ),
	  ...
	  
# Load and Save Data

The AlbumMapper with iimportant things:  

	* fetchAll() method uses Zend\Db‘s Select object to get data from the database. This enables the paginator.
	* The fetchOne method simply fetches a single row and returns an AlbumEntity.
	
	
`module/Music/src/Music/V1/Rest/Album/AlbumMapper.php:`

	<?php 
	namespace Music\V1\Rest\Album; 
	use Zend\Db\Sql\Select; 
	use Zend\Db\Adapter\AdapterInterface; 
	use Zend\Paginator\Adapter\DbSelect; 
	
	class AlbumMapper 
	{
	    protected $adapter;
	    public function __construct(AdapterInterface $adapter)
	    {
	        $this->adapter = $adapter;
	    }
	
	    public function fetchAll()
	    {
	        $select = new Select('album');
	        $paginatorAdapter = new DbSelect($select, $this->adapter);
	        $collection = new AlbumCollection($paginatorAdapter);
	        return $collection;
	    }
	
	    public function fetchOne($albumId)
	    {
	        $sql = 'SELECT * FROM album WHERE album_id = ?';
	        $resultset = $this->adapter->query($sql, array($albumId));
	        $data = $resultset->toArray();
	        if (!$data) {
	            return false;
	        }
	
	        $entity = new AlbumEntity();
	        $entity->album_id = $data[0]['album_id'];
	        $entity->artist  = $data[0]['artist'];
	        $entity->title   = $data[0]['title'];
	        return $entity;
	    }
	}
	

# Injection of adapters into Mapper

	* ZF2′s dependency injection container
	* Adapter Master
	* Adapter Slave

`module/Music/src/Music/V1/Rest/Album/Module.php:`

	public function getServiceConfig()
    {
    	return array(
			'factories' => array(
				'Music\V1\Rest\Album\AlbumMapper' =>  function ($sm) {
					$adapter 		= $sm->get('Zend\Db\Adapter\Adapter');
					$adapterMaster 	= $sm->get('dbMasterAdapter');
					$adapterSlave 	= $sm->get('dbSlaveAdapter');
					return new \Music\V1\Rest\Album\AlbumMapper($adapter);
				},
			),
    	);
    }


## Configure the database adapter to point to our database

`config/autoload/user.global.php:`

	return array(
	  'db' => array(
	    'driver'   => 'Pdo_Sqlite',
	    'database' => 'data/music.db',
	  ),
	  'service_manager' => array(
	    'factories' => array(
	      'Zend\Db\Adapter\Adapter'
	            => 'Zend\Db\Adapter\AdapterServiceFactory',
	    ),
	  ),
	); 

# Implement the API








