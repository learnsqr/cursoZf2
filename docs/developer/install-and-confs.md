# Some installation and configuratin hints

## Virtualhost

The virtualhost with cache disabled

	<VirtualHost *:80>
	    ServerAdmin admin@cursoZf2.local.example.com
	    DocumentRoot "/Some/Path/cursoZf2/public"
	    ServerName cursoZf2.local
		ServerAlias suombuel.noip.me
		php_admin_value zend_optimizerplus.enable 0  
		php_admin_value zend_datacache.apc_compatibility "off"  
		ErrorLog "/var/log/apache2/cursoZf2.local-error_log"
		CustomLog "/var/log/apache2/cursoZf2.local-access_log" common  
		<Directory "/Some/Path/cursoZf2/public">  
			Options Indexes FollowSymLinks  
			AllowOverride All  
			Order allow,deny  
			Allow from all  
		</Directory>  
	</VirtualHost>  

## Composer   
    php composer update    
    


## Configurar opcache  
Aparece este mensaje al intentar abrir apigility en un proyecto  
![Alt text](/assets/developer/opcache-warning.png "Opcache Warning")

1. Desabilitar directivas de cache en php-ini con:  

	apc.enabled = 0;
	eaccelerator.enable = 0;
	opcache.enable = 0;
	wincache.ocenabled = 0;
	xcache.cacher = 0;
	zend_datacache.apc_compatibility = 0;
	zend_optimizerplus.enable = 0;
	zend_optimizer.enable_loader = 0;
	zend_optimizer.optimization_level = 0;
   
2. Desabilitar directivas de cache en virtual host:  
	php_admin_value zend_optimizerplus.enable 0
	
## Review this video

http://www.youtube.com/watch?v=EZzfhTqorA0&t=14m31s
    