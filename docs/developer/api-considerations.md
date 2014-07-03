# Create an API using Apigility
Ref: 
	* Apigility Intro [PDF presentation - `Rob Allen`, March 2014](http://akrabat.com/wp-content/uploads/20140318-phpne-apigility-intro.pdf "Apigility Intro.").  


# Start Server

	php public/index.php development enable
	php -S 0:8080 -t public/ public/index.php
	
# Test your API with curl
	curl -s -H "Accept: application/vnd.music.v1+json" \
    http://localhost:8080/albums | python -mjson.tool
    
# API considerations

	• Content negotiation
	• HTTP method negotiation
	• Error reporting
	• Versioning
	• Discovery

# Other considerations

	• Validation
	• Authentication
	• Authorisation
	• Documentation
	
# JSON - HAL

Hypermedia Application Language (HAL) - application/hal+json

	{
	 "_links": {
	 "self": {
	 "href": "http://localhost:8080/albums/1"
	 }
	 },
	 "artist": "Eninem",
	 "id": "1",
	 "title": "The Marshall Mathers LP 2"
	}	

# Error Reporting
API Problem - application/problem+json

	{
	 "type": "/api/problems/forbidden",
	 "title": "Forbidden",
	 "detail": "Your API key is missing or invalid.",
	 "status": 403,
	 "authenticationUrl": "/api/oauth"
	}
	
# HTTP Method Negotiation

	POST /albums HTTP/1.1
	Content-Type: application/json

	405 Method Not Allowed
	Allow: GET
	
# OPTIONS

	OPTIONS /albums HTTP/1.1
	Content-Type: application/json
	
	200 OK
	Allow: GET

# Accept

	GET /albums/1 HTTP/1.1
	Accept: application/xml
	
	406 Not acceptable
	Content-Type: application/problem+json
	
	{
	 "type": "/api/problems/content",
	 "title": "Not acceptable",
	 "detail": "This API can deliver
	 application/vnd.music.v1+json, application/hal+json,
	 or application/json only.",
	 "status": 406
	}

# Content-Type

	POST /albums HTTP/1.1
	Content-Type: application/xml
	
	415 Unsupported Media Type
	Content-Type: application/problem+json
	
	{
	 "type": "/api/problems/content",
	 "title": "Unsupported Media Type",
	 "detail": "This API can accept
	 application/vnd.music.v1+json, application/hal+json,
	 or application/json only.",
	 "status": 415
	}

# Versioning by default
	
	Media type:
	GET /albums HTTP/1.1
	Accept: application/vnd.music.v1+json
	
	URL-based:
	/v1/albums

# Validation

	PATCH /albums/1 HTTP/1.1
	Content-Type: application/json
	
	{ "title": "" }
	
	422 Unprocessable Entity
	Content-Type: application/problem+json
	
	{
	 "type": "w3.org/Protocols/rfc2616/rfc2616-sec10.html",
	 "title": "Unprocessable Entity",
	 "detail": "Failed validation",
	 "status": 422,
	 "validation_messages": {
	 "title": "Invalid title; must be a non-empty string"
	 }
	}

# Authentication

	• HTTP Basic and Digest (for internal APIs)
	• OAuth2 (for public APIs)
	• Event-driven, to accommodate anything else
	• Return a problem response early if invalid
	  credentials are provided

# Authentication

	GET /albums/1 HTTP/1.1
	Authorisation: Basic foobar
	Accept: application/json
	
	401 Unauthorized
	Content-Type: application/problem+json
	{
	 "type": "w3.org/Protocols/rfc2616/rfc2616-sec10.html",
	 "title": "Unauthorized",
	 "detail": "Unauthorized",
	 "status": 401
	}

# Authorization

	GET /albums/1 HTTP/1.1
	Accept: application/json
	
	403 Forbidden
	Content-Type: application/problem+json
	
	{
	 "type": "w3.org/Protocols/rfc2616/rfc2616-sec10.html",
	 "title": "Forbidden",
	 "detail": "Forbidden",
	 "status": 403
	}

# Hyperlinking: Pagination

	Automatic when you return
	Zend\Paginator\Paginator.
	
	{
	 _links: {
	 self: { href: "/api/albums?page=3" },
	 first: { href: "/api/albums" },
	 last: { href: "/api/albums?page=14" },
	 prev: { href: "/api/albums?page=2" },
	 next: { href: "/api/albums?page=4" }
	 }
	}

# Documentation
	• Written within admin while setting up API
	• Automatically populated via validation admin
	• User documentation:
	• apigility/documentation/{API name}/V1
	• JSON or HTMl based on accept header
	• Swagger available too