# HTTP STATUS CODES

#### A quick cheatsheet for HTTP status codes (from [RFC 2616](http://www.ietf.org/rfc/rfc2616.txt) and Wikipedia's List of [HTTP status codes](http://en.wikipedia.org/wiki/List_of_HTTP_status_codes)).

Informational   1xx   
Successful      2xx  
Redirection     3xx  
Client Error    4xx  
Server Error    5xx  

100 Continue  
101 Switching Protocols   
\--------------------------------------------  
102 Processing (WebDAV) (RFC 2518)  
103 Checkpoint
122 Request-URI too long (Microsoft/IE7)  
\--------------------------------------------  
200 OK  
201 Created (+ etag)  
202 Accepted  
203 Non-Authoritative Information  
204 No Content (no body)  
205 Reset Content (reset view)  
206 Partial Content (+ range header)  
\--------------------------------------------  
207 Multi-Status (WebDAV) (RFC 4918)  
226 IM Used (RFC 3229)  
\--------------------------------------------  
300 Multiple Choices  
301 Moved Permanently  
302 Found  
303 See Other (since HTTP/1.1)  
304 Not Modified  
305 Use Proxy (since HTTP/1.1)  
306 Switch Proxy (no longer used)  
307 Temporary Redirect (since HTTP/1.1)  
308 Resume Incomplete  
\--------------------------------------------  
400 Bad Request  
401 Unauthorized  
402 Payment Required (future)  
403 Forbidden  
404 Not Found  
405 Method Not Allowed  
406 Not Acceptable  
407 Proxy Authentication Required  
408 Request Timeout  
409 Conflict (with the resource)  
410 Gone  
411 Length Required  
412 Precondition Failed  
413 Request Entity Too Large  
414 Request-URI Too Long  
415 Unsupported Media Type  
416 Requested Range Not Satisfiable  
417 Expectation Failed  
\--------------------------------------------  
418 I'm a teapot (RFC 2324)  
420 Enhance Your Calm (Twitter API)  
422 Unprocessable Entity (WebDAV) (RFC 4918)  
423 Locked (WebDAV) (RFC 4918)  
424 Failed Dependency (WebDAV) (RFC 4918)  
425 Unordered Collection (RFC 3648)  
426 Upgrade Required (RFC 2817)  
428 Precondition Required (RFC 2616 pending)  
429 Too Many Requests (RFC 2616 pending)  
431 Request Header Fields Too Large  
444 No Response (Nginx)  
449 Retry With (Microsoft)  
450 Blocked by Windows Parental Controls (Microsoft)  
499 Client Closed Request (Nginx)  
\--------------------------------------------  
500 Internal Server Error  
501 Not Implemented  
502 Bad Gateway  
503 Service Unavailable  
504 Gateway Timeout  
505 HTTP Version Not Supported  
\--------------------------------------------  
506 Variant Also Negotiates (RFC 2295)  
507 Insufficient Storage (WebDAV)(RFC 4918)  
509 Bandwidth Limit Exceeded (Apache)  
510 Not Extended (RFC 2774)  
511 Network Authentication Required  (RFC 2616 pending)  
598 Network read timeout error (Informal convention)  
599 Network connect timeout error (Informal convention)  
