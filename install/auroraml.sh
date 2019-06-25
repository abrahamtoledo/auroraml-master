#!/bin/bash

aurora_etc_dir="/etc/auroraml"

#### Web Server ####
mkdir -p "/var/www/html"
cp -r ../www /var/www/html
chown www-data:www-data /var/www/html -R
chmod 755 /var/www/html -R

echo "<?php

// MYSQL
define('MYSQL_HOST', '$(read_def "Mysql Host" "192.168.0.11")');
define('MYSQL_PORT', $(read_def "Mysql Port" "3306"));
define('MYSQL_USER', '$(read_def "Mysql User" "")');
define('MYSQL_PASS', '$(read_def "Mysql Pass" "")');
define('MYSQL_DB', '$(read_def "Mysql Database" "")');


// SMTP
define('MAIL_IS_SMTP', 1);
define('SMTP_HOST', '$(read_def "SMTP Host" "192.168.0.10")');
define('SMTP_PORT', $(read_def "SMTP Port" "25"));
define('SMTP_AUTH', 0);
define('SMTP_SSL', 0);

define('SMTP_DEBUG', 0);


// Mail
define('MAIL_DOMAIN', 'auroraml.com');
define('MAIL_USER', 'w2m');
define('MAIL_NAME', 'Aurora Mail');
define('SERVICE_ADDRESS', 'w2m@auroraml.com');
define('SUPPORT_ADDRESS', 'nauta.fw@gmail.com');

// Misc
define('_DEBUG_', 0);
define('REPORT_ERRORS', 0);
//define('ERROR_REPORTING', 0);

define('DIAS_PRUEBA', 7);

// Version Minima de AuroraSuite para nuevos usuarios
define('AU_NEW_USER_MIN_VERSION_CODE ',  13);
define('AU_NEW_USER_MIN_VERSION_NAME ',  '6.0.1');

// Hack para cuando hay una cola enorme de entrada
// porque el sistema estuvo caido
define('DROP_ALL', 0);

// Other configurations
define('REV_BASE', 'http://www.revolico.com');

define('SERVICES_PATH', DOCUMENT_ROOT . DS . 'mail_services');
define('MOBILE_SERVICES_PATH', DOCUMENT_ROOT . DS .'mobile_services');
define('SMS_SERVICES_PATH', DOCUMENT_ROOT . DS .'sms_service');

" > "${aurora_etc_dir}/config.php"

# Importar la configuracion en AuroraSuite
echo "<?php
require_once '${aurora_etc_dir}/config.php';

define('AURORA_CONFIG_DIR', '${aurora_etc_dir}');

" > "/var/www/html/config/config.php"

#### Postfix transport ####
adduser ${auroraml_user} --quiet --disabled-login --home /home/${auroraml_user} --gecos ""

cp ../sender/send-to-worker.sh /home/${auroraml_user}/send-to-worker.sh
chown ${auroraml_user}:${auroraml_user} /home/${auroraml_user}/send-to-worker.sh
chmod 755 /home/${auroraml_user}/send-to-worker.sh

mkdir -p "${aurora_etc_dir}"

echo "#!/bin/bash
WORKERS_BALANCER="$( read_def 'Workers Load Balancer IP' '192.168.0.20' )"
" > "${aurora_etc_dir}/conf.sh"

