#!/bin/bash

rm -rf /etc/haproxy 2> /dev/null
apt install haproxy

echo "
listen stats
   bind *:8081 ssl
   mode http
   stats enable
   stats hide-version
   stats uri /stats
   stats auth admin:is@burum@1002

frontend workers_front
   bind 127.0.0.1:8080
   stats disable
   default_backend http_back

backend workers_backend
   balance roundrobin
   default-server inter 2s check maxconn 20 maxqueue 25 weight 100 agent-check agent-port 9707 agent-inter 2s
   server worker 192.168.0.20:80
   server worker 192.168.0.21:80
   server worker 192.168.0.22:80
   server worker 192.168.0.23:80
   server worker 192.168.0.24:80
   
   
" >> "/etc/haproxy/haproxy.cfg"

systemctl restart haproxy
