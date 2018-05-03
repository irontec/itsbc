# Irontec Tiny SBC

## ¿Another SBC?
On this topic, from our humble perspective, there are good pieces of software for building your own SBC, but our team needed something quite simple and web based, so we can deploy easily and management can be done by not-so-protocol/software experts.  
Also, one of the main key points we needed rtpproxy'ing. 
The name choosen: Irontec Tiny SBC **can be taken as it sounds**.  
On the open source universe, we know and we usually deploy SEMS, Kamailio, OpenSIPS and also the B2BUA module, Asterisk, FreeSwitch and other options,, if you are interested on an stable SBC, please look at this projects.  
There are also a plenty of good commercial options, production ready, and some of them from the developpers of this projects.

## TinySBC ?
Yes, we don't have plans to build a big solution right now :)  
This name is an expectation controller handler.  
Seriously: The features working now is the minimum viable we needed.

## Technology behind
Behind this project, main software is:
* OpenSIPS for SIP Server.
* RTPEngine for RTP handling.
* Symfony 3.4 with EasyAdminBundle for web administration ("backoffice").

## Features
This is mainly a web administration project for OpenSIPS and RTPEngine, with a small opensips configuration script validating requests against database.  

### Supported features:
* Manage IP address, ports and protocols OpenSIPS will listen.
* Manage IP address (can be multiple) for RTPEngine, so media can be bridged between interfaces (internal/external rtp region like behaviour).
* Route registers with the excellent mid_registrar module (OpenSIPS will appear as the contact), based on source address / domain / incoming interface.
* Route requests to next hop, including protocol change and media proxyin with definable interfaces.
* Partial Topology hiding is enabled by default on config file, masking route/via headers and call-id, but keep in mind we use params on route with received ips, etc ...

### Not supported features at this moment:
* Full Topology Hiding
* Manage SSL Certs.
* In-dialog different routing cannot be done.
* Nothing on the security area is done, no limit on requests per second, no geo ip (not yet).
* Concurrent dialog limitations.
* Routing based on username part of requri or from header (aKa: DID/CLID routing).
* CDR
* Realtime web dialog viewer.

You are totally invited to hack this ;) Configuration script is quite small, so you can enter your own logic, main blocks are commented.

## Official Roadmap
Right now there is no active Roadmap, will see what happens ;)  
There are plenty points to fix or do in a better way, plenty to new things.  

## Production Ready?
**NO.**  
**NO.(eof)** 
First at all: OpenSIPS, RTPEngine are very very stable and production rock solid products, as everyone working on this area knows.  
But, **usage we do (script file) and design we have done** - mainly for OpenSIPS,  may be not the best usage / best performance / best practices, this is our first version, is working for us on testing environments.  
We **DO NOT RECOMMENDED for production**, use at your own risk!  
Also, security concerns: nothing has been done (yet).

## Installation
This guide will cover installation o Debian based systems, prefering Debian 9 (latest stable) 64bits.
### Brief info
We use directly the Debian construction system present on OpenSIPS and RTPEngine source code (basically the debian directory) for building our own versions and mangle/touch/alter configuration files, systemd service files.  
It's just for this, we dont want to misrespect any of this projects, we love both :)  
Packages we build:
* itsbc-opensips (and -modules)
* itsbc-rtpengine


### Detailed steps for installation
Please add Irontec Debian repo:

```
echo 'deb http://packages.irontec.com/debian itsbc main' > /etc/apt/sources.list.d/irontectinysbc.list
wget http://packages.irontec.com/public.key -q -O - | apt-key add -
apt-get update
```

Installation is done using standard Debian way:

```
apt-get install itsbc
```
On the installation you will  not be prompted for root MariaDB user, please take care you need this password in next steps (and also for security purposes), on Debian 9 it's different from prior versions.

### Setup Database

Information bellow works for MariaDB (default shipped on Debian 9), but it's expected to work also on other MySQL like database engine such as Percona, MySQL ...
```
apt-get install mariadb-server
mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' IDENTIFIED BY 'ROOTPASSWORD' WITH GRANT OPTION"
```

Update `/etc/opensips/opensipsctlrc` (change MySQL options) and generate Opensips tables with opensipsdbctl tool
```
opensipsdbctl create
```

Create a user and grant all privileges on:

```
mysql -uroot -pROOTPASSWORD -e "CREATE USER opensips@localhost IDENTIFIED BY 'OPENSIPSPASS'"
mysql -uroot -pROOTPASSWORD -e "GRANT ALL PRIVILEGES ON opensips.* TO opensips@localhost"
```
*Note*: This can be done in a better way with separate privileges :) 

After that, it's needed to prepare OpenSIPS scritpt to access this database, file:  
  `/opt/irontec/itsbc/config/opensips/opensips_database.cfg`  
  
  
```
modparam("usrloc", "db_url","mysql://opensips:OPENSIPSPASS@127.0.0.1/opensips")
modparam("avpops","db_url","mysql://opensips:OPENSIPSPASS@127.0.0.1/opensips")

```
As you can see, we have divided opensips configuration with this module parameters with credentials on different file.  
Please change OPENSIPSPASS with the correct user to access database (R/W).  

Last step is to add tables for Irontec Tiny SBC web administration:

Update `/opt/irontec/itsbc/app/config/parameters.yml` with your database credentials

```
cd /opt/irontec/itsbc/
bin/console doctrine:database:import schema/initial.sql
```

## Usage
Default admin user on web interface is admin / irontec  
You can log on the web interface and confirm all the web sections.  
Please, keep in mind there are no validations at all right now, you can enter bad values or not present interfaces and this can break everything.  


### Hello world case
A visual guide with screenshots is available on [ our blog ](https://blog.irontec.com) (english and spanish) version.
#### 1) Creating SIP Listener
First step is to define a SIP Listener, you can start but using UDP, so everything will be easy to capture and debug with sngrep or other tools. If the server has 192.168.1.100 as default IP, you can use this IP and whatever port you like.  
Click on 
#### 2) Define RTPEngine interfaces
Next, if needed, you can define RTPEngine interfaces, using one or more interfaces, please remember that no validation is done.  
Last step is to edit at least one rule, 

## Technical perspective
The path we have followed for managing requests/dialog follows is based on this key points:
* OpenSIPS
    * General perspective: 
        * We have try to consider OpenSIPS as a SIP Router, forcing send socket, destination - may be not the best idea but working for our case usages.
    * Routing decisions are only done on first requests/not in dialog, this decisions are based on logic on database, not using LCR Modules or Dynamic Routing Modules, may be not the best idea right now.
    * For managing Registers we use the excellent module mid_registrar from OpenSIPS proyect.
    * Configuration file is based on include_file, specifically for listeners and database
    * After editing rules on web interface, OpenSIPS can be restarted for applying new config.
* RTPEngine
    * Configuration file is created on the fly from the web server.
    * We need to use this path for launching RTPEngine process with different interfaces.

### Troubleshooting
We repeat: At this moment nothing is validated on the web administration, input can lead to a non-starting OpenSIPS or RTPEngine, so checking logs is something you must do.
```
journalctl -f
```
And see what happens :)  
SIP Interfaces: You can check configuration that has automatically built on this file:
```
# cat /opt/irontec/itsbc/config/opensips/opensips_custom_listeners.cfg
listen=UDP:127.0.0.1:5060
```
This is a sample, on each one case you should have the port and IP defined on the web.
So, if this is correct, you can must verify:
* This IP address are on the system (execute: 'ip a s' to check ip address on system)
* This port is not in use (execute: 'ss -tulnp' to check process listening on each port).  
 
Media IP: You can check configuration that has automatically built on this file:
```
# cat /opt/irontec/itsbc/config/rtpengine/interfaces
INTERFACES=" --interface=demo/127.0.0.1!127.0.0.1"
```
And, finally check if OpenSIPS and RTPEngine are running:
* systemctl status rtpengine
* systemctl status opensips

If everything is good for flying and process RTPEngine/OpenSIPS are running, next you can do is check logs to check routing decicisions (with command: journalctl -f).
Also, we strongly recommend to start using this SBC with UDP to UDP rules, so you chan execute SNGREP and check what is happening with SIP requests.

### FAQ
Coming soon

