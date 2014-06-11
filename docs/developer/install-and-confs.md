# Some installation and configuratin hints

## Virtualhost

The virtualhost with cache disabled

	<VirtualHost *:80>
	    ServerAdmin admin@cursoZf2.local.example.com
	    DocumentRoot "/Some/Path/cursoZf2/public"
	    ServerName cursoZf2.local
		ServerAlias suombuel.noip.me
		//php_admin_value zend_optimizerplus.enable 0
		//php_admin_value zend_datacache.apc_compatibility "off"
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