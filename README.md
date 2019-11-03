# auroraml-master
Master server of AuroraSuite. Master server contains the frontend website, 
incomming postfix server, HAProxy load balancer, and other stuff.

## Requirements:
You will need these aditional stuff:
* A machine (posibly VPS) with `Debian 9` installed.
* A Mysql Server (recommended in another machine), with the database for the software
* A Postfix server to send replies (recommended in another machine).
* At least one [worker](https://github.com/abrahamtoledo/auroraml-worker/) server.

## Installation
Run installation script and provide the required information:

```bash
pushd install && ./install.sh
```

Althoug ideally you would have all the services in diferent servers, it is also possible to install everything on a single server (posibly with minor modifications to the code).

__IMPORTANT NOTE: This document is a work in progrees__

Contributions are welcome. You can contact me about any problems with installation.
