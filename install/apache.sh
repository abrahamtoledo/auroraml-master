#!/bin/bash

rm -rf /etc/apache2 2> /dev/null
apt install -y apache2


# Enable ssl
a2enmod -q ssl 2> /dev/null 

# Enable Rewrite and htaccess
a2enmod -q rewrite 2> /dev/null
echo "<Directory /var/www/html>
        AllowOverride All
</Directory>
" > '/etc/apache2/conf-available/htaccess.conf'
a2enconf -q htaccess 2> /dev/null

# Regular site
echo '<VirtualHost *:80>
	ServerAdmin auroraml.root@gmail.com
	DocumentRoot /var/www/html

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
' > '/etc/apache2/sites-available/auroraml.conf'
a2ensite -q auroraml 2> /dev/null


# SSL site
echo '<IfModule mod_ssl.c>
	<VirtualHost _default_:443>
		ServerAdmin auroraml.root@gmail.com
		DocumentRoot /var/www/html

		ErrorLog ${APACHE_LOG_DIR}/error.log
		CustomLog ${APACHE_LOG_DIR}/access.log combined

		SSLEngine on

		SSLCertificateFile	/etc/ssl/certs/ssl-cert-snakeoil.pem
		SSLCertificateKeyFile /etc/ssl/private/ssl-cert-snakeoil.key

		<FilesMatch "\.(cgi|shtml|phtml|php)$">
				SSLOptions +StdEnvVars
		</FilesMatch>
		
        <Directory /usr/lib/cgi-bin>
				SSLOptions +StdEnvVars
		</Directory>

	</VirtualHost>
</IfModule>

' > '/etc/apache2/sites-available/auroraml-ssl.conf'
a2ensite -q auroraml-ssl 2> /dev/null

# Restart apache
systemctl restart apache