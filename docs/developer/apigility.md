# Apigility - www.apigility.com

## Instalación del Apigility

1. desde c:\www
2. php composer.phar create-project -sdev zfcampus/zf-apigility-skeleton apig
3. php public/index.php development enable
3. php -S localhost:8000 -t public public/index.php

## Trabajando con Apigility

1. Get Started!
2. Crear una version, si se necesita
3. Crear un Database Adapter con PDO_Mysql, username, password, host, port.
4. Crear una API. El nombre NO puede llevar - (guión)
5. Crear un Service
6. Hay dos tipos servicios: restService, Database
7. Usar Database por ahora
8. Verificar el Route: usamos albumrest (para diferenciarlo de album-rest, previamente creado) 
9. Hacerlo para empezar de solo lectura. Habilitar solo GET tanto en Entities como en Collections.
10. Verificar el Hydrator. Pro ahora es array-serializable.
11. Verificar con un REST client del chrome (Advanced REST Client,  REST Console,  Postman REST Client) o con CURL desde consola.
12. Ir a: localhost:8000\v4\albumrest 
13. Llamar via GET
14. Retorna Album List
15. Llamar via GET/id
16. Restorna Album id
17. Llamar via POST
18. Poner Accept application/json
19. Poner Content-Type application/json con datos en raw
	{"id":"9",
	 "artist":"Agustin-1",
	 "title":"Title-1"
	} y enviar via POST
18. Retorna error 405
19. Retorna Header con Allowed Methods

## GET y Authorization

1. Crear una nueva version (o continuar con la siguiente)
2. Usar Authorization, autorizar el method POST para Entity y para Collection
3. Probar GET nuevamente. 
4. Mirar que version se esta atacando por defecto. 
5. Para atacar una version diferente a la default, usar: localhost:8000/v4/albumrest
6. Tambien se puede usar Accept application/vnd.albumrest.v4+json
7. Como hemos puesto en Authorization el GET retorna un error 403 Forbidden

## Definir Authentication

0. Verificar la base de datos que vamos a usar. 
0.1. Debe tener la estructura de datos para almacenar autenticacion oauth.
0.2. Sino, crearla. Ver [https://github.com/zfcampus/zf-oauth2]
0.3. Llenar oauth_clients

1. Seleccionar OAuth2
2. Seleccionar PDO
3. DSN para Mysql: mysql:dbname=zf2;host=localhost
4. Rellenar usuario y contraseña
5. Rellenar route para autenticación /oauth
6. Ir al endpoint localhost:8000/oauth
7. Llamar via POST con los datos de usuario/contraseña en Accept application/json y Content-Type application/json
8. {"username":"testclient",
	 "password":"testpass",
	 "grant_type":"password",
	 "client_id": "testclient",
     "client_secret":"testpass"
	}
9. que obtiene
	{
	    "access_token": "b99d9995c425097afe5d488cd1e67e1c2a2ba95f",
	    "expires_in": 3600,
	    "token_type": "Bearer",
	    "scope": null,
	    "refresh_token": "36995417725ff744bdbe287b48fac8fb8e16b47e"
	}
10. O este funciona!!! 
	{ 
	 "grant_type":"client_credentials",
	 "client_id":"testclient",
	 "client_secret":"testpass"
	}
11.que obtiene
	{
	    "access_token": "1af85611751764f4eba99cda8791cd3936f94f06",
	    "expires_in": 3600,
	    "token_type": "Bearer",
	    "scope": null
	}
12. Entonces hacer la llamada GET con el token Accept: application/vnd.albumrest.v4+json y Authorization: Bearer 7ffc325852a11b5f36633f395fc82c311b382e47
13. La salida es la llamada GET de antes.
14. Si el token esta mal sale 
	{
	    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
	    "title": "Forbidden",
	    "status": 403,
	    "detail": "Forbidden"
	}







 