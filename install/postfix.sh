#!/bin/bash

apt --reinstall install -y postfix

postfix_master="/etc/postfix/master.cf"
postfix_main="/etc/postfix/main.cf"
auroraml_transport="auroraml-send"

# Add transport to master.cf
echo "
${auroraml_transport}   unix  -       n       n       -       -       pipe
  flags=F user=auroraml argv=/home/auroraml/send-to-worker.sh \${sender}
" >> "${postfix_master}"

# Replace default postfix main.cf with ours
echo '# See /usr/share/postfix/main.cf.dist for a commented, more complete version


# Debian specific:  Specifying a file name will cause the first
# line of that file to be used as the name.  The Debian default
# is /etc/mailname.
#myorigin = /etc/mailname

smtpd_banner = $myhostname ESMTP $mail_name (Debian/GNU)
biff = no

# appending .domain is the MUAs job.
append_dot_mydomain = no

# Uncomment the next line to generate "delayed mail" warnings
#delay_warning_time = 4h

readme_directory = no

# See http://www.postfix.org/COMPATIBILITY_README.html -- default to 2 on
# fresh installs.
compatibility_level = 2

# TLS parameters
smtpd_tls_cert_file=/etc/ssl/certs/ssl-cert-snakeoil.pem
smtpd_tls_key_file=/etc/ssl/private/ssl-cert-snakeoil.key
smtpd_use_tls=yes
smtpd_tls_session_cache_database = btree:${data_directory}/smtpd_scache
smtp_tls_session_cache_database = btree:${data_directory}/smtp_scache

# See /usr/share/doc/postfix/TLS_README.gz in the postfix-doc package for
# information on enabling SSL in the smtp client.

smtpd_relay_restrictions = permit_mynetworks permit_sasl_authenticated defer_unauth_destination

myhostname = mail.auroraml.net
myorigin = auroraml.net

mydestination = $myhostname, $myorigin, localhost.localdomain, localhost.localdomain, localhost

relayhost = 

mynetworks = 127.0.0.0/8 192.168.0.0/24 [::ffff:127.0.0.0]/104 [::1]/128

mailbox_size_limit = 0
recipient_delimiter = +

inet_interfaces = all
inet_protocols = all

alias_maps = hash:/etc/aliases
alias_database = hash:/etc/aliases

transport_maps = hash:/etc/postfix/transport

' > "${postfix_main}"

echo "auroraml.net  ${auroraml_transport}:
.auroraml.net  ${auroraml_transport}:
" > "/etc/postfix/transport"

postmap "/etc/postfix/transport"

postfix reload
