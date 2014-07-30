# Apigility admin

REF: 
 
* <sup>1</sup> Apigility Zend Framework. __"Creating a REST Service."__ _Create a simple REST service._ Web [Creating a REST Service](https://apigility.org/documentation/intro/first-rest-service). Accessed 29 Jul 2014.

## Trabajando con Apigility Admin

1. Get Started!
2. Crear una version, si se necesita
3. Crear un Database Adapter con PDO_Mysql, username, password, host, port.
4. Crear una API. El nombre NO puede llevar - (guión)
5. Crear un REST Service

 * Hay dos tipos de servicios: Code-Connected, DB-Conected

 `Code-Connected service`  

	<pre>When you create a Code-Connected service, Apigility creates a stub "Resource" class that defines all the various operations available in a REST service. These operations return `405 Method Not Allowed` responses until you fill them in with your own code. The "Code-Connected" aspect means that you will be supplying the code that performs the actual work of your API; Apigility provides the wiring for exposing that code as an API.</pre>

 `DB-Connected`  

	<pre>DB-Connected services allow you to specify a database adapter and a table; Apigility then creates a "virtual" Resource which delegates operations to an underlying Zend\Db\TableGateway\TableGateway instance. In other words, it is more of a rapid application development (RAD) or prototyping tool.</pre>

6. Usar Code-Connected 
7. Poner un REST Service Name, igual al de la API, por ejemplo.

![Alt text](/assets/developer/Rest-db-connected.png "REST Service Name Created")

#### Apigility provides a number of sane defaults:

	- Collections only allow GET (fetch a list) and POST (create a new entity) operations.  
	- GET (fetch an entity), PUT (replace the entity), PATCH (perform a partial update), and DELETE (remove the entity) operations.  
	- If your collection supports pagination, Apigility will limit to 25 items per "page" of results.  
	- Apigility creates a routing URI based on the service name (e.g., /status[/:status_id]).  

8. Cambiar los parametros de REST Hydrator a ClassMethods
9. Save ALL

	`Diferente de la referencia`. Ver mas explicación ver [Hydrators](/docs/hydrators).
	
![Alt text](/assets/developer/rest-parameter-hydrator.png "REST parameter Hydrator")

 `Service Classes`
	
	When you create a Code-Connected service, Apigility generates four PHP class files for you:		
	- An Entity class
	- A Collection class which extends Zend\Paginator\Paginator, which will allow you to provide paginated result sets.
	- A Resource class for performing operations.
	- A Factory class for the Resource created.


## Creación de Fields

10. Crear cada campo segun las columnas de la tabla de la base de datos.
11. Crear los filtros. Importante _Zend\Filter\StringTrim_ y _Zend\Filter\StripTags_ para los campos de texto.
12. Crear las validaciones. 

	* Para los campos de texto, validacion __Zend\Validator\StringLength__ con option __max__.  
	* Para los campos ID, validacion __Zend\Validator\Regex__ con option __pattern__ con valor de expresion regular (por ejemplo: /^(mwop|andi|zeev)$/).  
	* Para los timestamp, validacion __Zend\Validator\Digits__  
	

## Creación de Documentación

13. Llenar campo REST service description (e.g. Create, manipulate, and retrieve status messages.)
14. Llenar campo __Collection__ description (e.g. Manipulate lists of status messages.)
15. Llenar campo __Collection__ description GET (e.g. Retrieve a paginated list of status messages.)
16. Llenar campo __Collection__ description POST (e.g. Create a new status messages.)
17. Llenar campo __Entities__ description (e.g. Manipulate and retrieve individual status messages.)
18. Llenar campo __Entities__ description GET (e.g. Retrieve a status message.)
19. Llenar campo __Entities__ description PATCH (e.g. Update a status message.)
20. Llenar campo __Entities__ description PUT (e.g. Replace a status message.)
21. Llenar campo __Entities__ description DELETE (e.g. Delete a status message.)
22. Para cada operación puede generarse la documetación usando `generate from configuration`, menos para DELETE. 


## Creación de Authorization

23. Ir a Authorization
24. Marcar donde corresponda
25. Save

## Creación de Authentication

26. Cargar el fichero de base de datos en la base de datos a utilizar (vendor/zfcampus/zf-oauth2/data/db_oauth2.sql.)
27. El usuario / password de pruebas es: testclient / testpass
26. Seleccionar Authentication
27. Selecciónar Oauth
28. Llenar los datos de PDO para conección a la base de datos
	
	* Seleccionar PDO
	* DSN para Mysql: mysql:dbname=zf2;host=localhost
	* Rellenar usuario y contraseña
	* Rellenar route para autenticación /oauth

* Hay varios tipos de use case para oauth2
	
	`Web-server applications`
	
	<pre>The Web-server applications scenario is used to authenticate a web application with a third-party service (e.g., imagine you built a web application that needs to consume the API of Facebook).</pre>
		
	`Browser-based applications`
	
	<pre>This scenario is quite common when using a Javascript client (e.g., a Single Page Application) that requests access to the API of a third-party server. In a browser-based application, you cannot store the client_secret in a secure way, which means you cannot use the previous workflow (web-server application). Instead, we need to use an implicit grant. This is similar to the authorization code, but rather than an authorization code being returned from the authorization request, a token is returned.</pre>
		
	`Mobile apps`
	
	<pre>This OAuth2 scenario is similar to browser-based applications. The only difference is the redirect_uri, which, in the mobile world, can be a custom URI scheme. This allow native mobile apps to interact with a web browser application, opening a URL from a native app and going back to the app with a custom URI. For example, iPhone apps can register a custom URI protocol such as facebook://. On Android, apps can register URL matching patterns which will launch the native app if a URL matching the pattern is visited.</pre>
	
	`Username and password access`
	
	<pre>
	<pre>This use case can be used to authenticate an API with user based grants (also known as a password grant). The typical scenario includes a Login web page with username and password that is used to authenticate against a first-party API. Password grant is only appropriate for trusted clients. If you build your own website as a client of your API, then this is a great way to handle logging in.</pre>
	
	`Confidential clients`
	
	<pre>With confidential, trusted clients, you provide the client_id and client_secret as HTTP Basic authentication credentials, and the username, and password values in the request body, in order to obtain an access token.</pre>
	
	`Public Clients`
	
	<pre>If we are using a public client (by default, this is true when no secret is associated with the client) you can omit the client_secret value; additionally, you will now pass the client_id in the request body. </pre>
	</pre>
	
	`Application access`
	
	<pre>This use case can be used to authenticate against applications, mosty likely in machine to machine scenarios. The OAuth2 grant type for this use case is called client_credentials. The usage is similar to the public client password access reported above; the application sends a POST request to the OAuth2 server, passing both the client_id and the client_secret in the body. The server replies with the token if the client credentials are valid.</pre>
	
### Usar Aplication Access 

29. Hacer la llamada

	<pre>
	
	endpoint: http:///domainname/oauth
	method: POST
	Headers: Accept: application/json
			 Content-Type: application/json
	
    { 
     "grant_type":"client_credentials",
     "client_id":"testclient",
     "client_secret":"testpass"
    }
    </pre>
    

30. que obtiene

	<pre>
    {
        "access_token": "1af85611751764f4eba99cda8791cd3936f94f06",
        "expires_in": 3600,
        "token_type": "Bearer",
        "scope": null
    }
    </pre>


29. Refresh the token if you have a refresh token (only grant types: password, authorization_code)

	<pre>
    {
	    "grant_type": "refresh_token",
	    "refresh_token": "<the refresh_token>",
	    "client_id": "testclient",
	    "client_secret": "testpass"
	}
    </pre>




 