#!/bin/bash

haproxy_config="global
    log /dev/log    local0
    log /dev/log    local1 notice
    chroot /var/lib/haproxy
    user haproxy
    group haproxy
    daemon
    maxconn 1024

defaults
    log     global
    mode    http
    option  httplog
    option  dontlognull

listen stats
    bind *:8081 ssl crt /etc/haproxy/haproxy.pem
    mode http
    stats enable
    stats hide-version
    stats uri /stats
    stats auth admin:is@burum@1002

frontend workers_front
    bind 127.0.0.1:8080
    mode http
    default_backend workers_backend

backend workers_backend
    balance roundrobin
    default-server inter 2s check maxconn 20 maxqueue 25 weight 100 agent-check agent-port 9707 agent-inter 2s
    server worker1 192.168.0.20:80
    server worker2 192.168.0.21:80
    server worker3 192.168.0.22:80
    server worker4 192.168.0.23:80
    server worker5 192.168.0.24:80
"

haproxy_cert="-----BEGIN CERTIFICATE-----
MIIC8jCCAdqgAwIBAgIJANFNswYidXO1MA0GCSqGSIb3DQEBCwUAMCAxHjAcBgNV
BAMMFWxvY2FsaG9zdC5sb2NhbGRvbWFpbjAeFw0xOTA2MTIxNDU2NDlaFw0yOTA2
MDkxNDU2NDlaMCAxHjAcBgNVBAMMFWxvY2FsaG9zdC5sb2NhbGRvbWFpbjCCASIw
DQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAM34EEUVGEeaR/L4ILdpo44D7n9F
jkOxV9uHcJ8IQR9JRwnVQl38zIWjxvK3Zpx73VF+cpPv8wFv85gsXu2H4sOEtq/h
LxvyykWYfCtoUtjRscRx3t1MJ0TpU9X0uhBkzPFjUljj45S3+JTs26Ays/COCtsh
epKj/QcgwOeMQED9yw87b9Jd09GA3CIGyisbii+ErwzYyy36VJmOu0cS0u5OIZDq
s4rt1EDFQqssRUNHZNO3Fem1KnWuu1zSY/9pTUT2KAUe7v6SW8rYAkg2GxT6kesy
xlczA//vOUQ1PVH3Ixvw8NFUevI+AFaRKYV3OILSHo4q4Y6xaWPrUKzwP3MCAwEA
AaMvMC0wCQYDVR0TBAIwADAgBgNVHREEGTAXghVsb2NhbGhvc3QubG9jYWxkb21h
aW4wDQYJKoZIhvcNAQELBQADggEBAG0AvAa62CICRrGJeIi0YnNyrGnMNd/vmZ1w
+AXboiTskMONeGYentFhCEQPZ0QgdT4kuAy/10HhY1S0ZimMrXb2+TlCW1bk1WHK
CZBlATBoy8vl3N7LqNSn5Q4n7le6xcTENax8nwVbH5tyMVPpNflUlZZLgivulszt
q/jyyzPISAiciYrChlTxKFclO4fObMYeragmOoSeMXWd95bX+XDZYtuDkzExbppt
5oXWXUikRv6WTJH8yrDvbQx4dMzfM0QxTNbrvMVcRFpj8Hqeur8BnTqA5PPZWUAo
KXNnw/AEHren+hcmYgXuS3lmgwOul88CrnPIdEUABg0Wru6hmgA=
-----END CERTIFICATE-----
-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDN+BBFFRhHmkfy
+CC3aaOOA+5/RY5DsVfbh3CfCEEfSUcJ1UJd/MyFo8byt2ace91RfnKT7/MBb/OY
LF7th+LDhLav4S8b8spFmHwraFLY0bHEcd7dTCdE6VPV9LoQZMzxY1JY4+OUt/iU
7NugMrPwjgrbIXqSo/0HIMDnjEBA/csPO2/SXdPRgNwiBsorG4ovhK8M2Mst+lSZ
jrtHEtLuTiGQ6rOK7dRAxUKrLEVDR2TTtxXptSp1rrtc0mP/aU1E9igFHu7+klvK
2AJINhsU+pHrMsZXMwP/7zlENT1R9yMb8PDRVHryPgBWkSmFdziC0h6OKuGOsWlj
61Cs8D9zAgMBAAECggEAdwYS4Nj/3uDZEx8wSM1TJo4/FG0teRDSpJnwCvbKKzo9
QwFqCMY9qjyqizhQo70weBeKPtM6qmn3asi5Uqpj8HiQ2bJXdt8m5HDp0GvI9GK5
R7xF/bw0NS5gtBNoMnENvbCXtaZ7rUVi8Syu/jROp4Rt4ZPHMVZysdvLngL+Xo9B
PWNdFcXIelXHdX++80KJzZGmi02EvVlTdfkZIAjjsyw0XUe6i58Nbf5fIWyNGYgU
6XCeEnkvrWr0FHQErrdSqh/LFDZWAqBv9opZuSDyHY6FUkXWExYiVB/8Jc+kFAG2
UIfuDkpGxRKHKtbOFRUSSC7ePtRWyM56f0kYS51BAQKBgQDxiZm6Upe/Q1iSziGq
PqErK9Kyj3vjpMyuKDEtFaFRFB03pLQeCLCoeIkgweVYzeuSW5Twu8Sx3O/EBdgR
S+Qhva3SK81HPhLzHq6/b+o2RuZ3DIP9L0g3cq+k64N6kpR/bTlm8Okope72bKyk
4UOcVNC61uzQY4S7D7H9clEzGQKBgQDaTUCfzn2FW+CtL4GziIiq1FrJWoKKqpxk
6AiNe4PePgSFDyxdWrKsSfCNat/c84oDq0CztIqvD8BcrxGDrSqHH/qlUJpfqTN3
qKFrDfoNsn65ol2dL2fJx0+xSuEQs6piO/pHbZya+1jMSKYpR34UCFwx+wmTFKSZ
5y49/7+EawKBgQDUg5rsYsr9D4YY9KCOJ7iqQU6KqM/6RP+Jo/dQkZ1zttzWHmYT
ntXABP2yAqeF8Pf5t/ZdsPeo/pk+wV2QKlO4lCkhqERfEHCf1DkwWomZ49vWlv5y
f21sy81ar5To/ZsGWtWMix66EvUjgA6Oq1xPahiUq5GE8GrSI0cZlcF30QKBgFtU
GodBAi56w8Jwr5iGtHaTpO+8WATfX9KvaHSYihC+bXGlaXAc88c0n9jqL4HmuYTT
bpxAGg0nT9j2vSMTnUkuzdO/pvYCea/D8tQw4r48QNw022lZXdiC9Ao+Q26TW+MB
KLIdX3lPUlUUx79ZU5vZ64hVeCn6ZuqkVypFBsDFAoGBAOoFQy8wDKVln95BJzQ7
7P8gKP3uekn4BtO9NYa0ZuHrBJ7JGlfByoCAZBFmH1/h+4W6LKj5/v4M0PdP/cli
DE/LaYfD0X0lTiew+c9o6hpsAsbd1ffi19bUb2Bq6O3+R//ZON5iEssnJb33cOGb
7zi2WmjDPn9d+lVL5JBPOG5b
-----END PRIVATE KEY-----
"

mkdir -p "/etc/haproxy"

echo "${haproxy_config}" > "/etc/haproxy/haproxy.cfg"
echo "${haproxy_cert}" > "/etc/haproxy/haproxy.pem"

apt --reinstall install haproxy

echo "${haproxy_config}" > "/etc/haproxy/haproxy.cfg"
echo "${haproxy_cert}" > "/etc/haproxy/haproxy.pem"

chown -R haproxy:haproxy "/etc/haproxy"
chmod -R 755 "/etc/haproxy"

systemctl restart haproxy
