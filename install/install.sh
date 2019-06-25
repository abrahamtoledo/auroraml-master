#!/bin/bash

####     Install Prerequisites     ####
apt install -y curl

####     Functions    ####
. ./func.sh

####     Packages    ####
. ./syslog.sh

. ./apache.sh

. ./php.sh

. ./auroraml.sh

. ./postfix.sh


echo "Done !"

