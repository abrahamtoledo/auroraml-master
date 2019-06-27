#!/bin/bash

apt --reinstall install -y php libapache2-mod-php php-mysql php-mbstring

# Enable apache module
phpver=$( php --version | head -n 1 | cut -d " " -f 2 | cut -d "." -f 1,2 )
a2enmod -q "php${phpver}" 2> /dev/null

echo '# PHP directives for AuroraML - Worker.
log_errors = On
error_reporting = E_ALL & ~E_STRICT
display_errors = Off

error_log = "/var/log/php-error.log"

' > "$(ls -d /etc/php/7.*/apache2/conf.d | tail -n 1)/50-auroraml-worker.ini"

touch "/var/log/php-error.log"

systemctl restart apache2
