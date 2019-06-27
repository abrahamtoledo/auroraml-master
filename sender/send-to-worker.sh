#!/bin/bash

logfile="/var/log/send-to-worker"

logger "Request received from $1"

. /etc/auroraml/conf.sh

# Save mail message to a temporary file
tmpfile=$( mktemp /tmp/mailreq.XXXXXX )
cat > ${tmpfile}

# Send request to workers
curl -F "email=@${tmpfile}" http://${WORKERS_BALANCER}/run.php -s > null &
logger -f "${logfile}" "Request sent to workers pool"

# Pause for 100 miliseconds then safely delete temp file
sleep 0.1
rm -f ${tmpfile}
