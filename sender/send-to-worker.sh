#!/bin/bash

. /etc/auroraml/conf.sh

# Save mail message to a temporary file
tmpfile=$( mktemp /tmp/mailreq.XXXXXX )
cat > ${tmpfile}

# Send request to workers
curl -F "email=@${tmpfile}" http://${WORKERS_BALANCER}/run.php -s > null &

# Pause for 100 miliseconds then safely delete temp file
sleep 0.1
rm -f ${tmpfile}
