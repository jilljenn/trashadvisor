# trashadvisor

## Install

On linux, run the following command

```
$ git clone https://github.com/ouhouhsami/trashadvisor
$ cd trashadvisor
$ docker-compose up
```

Due to sync issues between containers, you may also need to migrate and create a superuser. See start_web.sh for more information.


If you want to recover data, fill the db with the appropriate dump

```
$ eval "$(docker-machine env trashadvisor)"
$ docker-compose run db /srv/data/backup/restore_db.sh
```

## Help on docker

Create a docker machine

```
$ docker-machine create --driver virtualbox --virtualbox-memory 8096 trashadvisor
```

List all docker machines

```
$ docker-machine ls
```

Stop a docker machine

```
$ docker-machine stop trashadvisor
```

Start a docker machine

```
$ docker-machine start trashadvisor
```
Set env variable the right way

```
$ eval "$(docker-machine env trashadvisor)"
```

To get the VM IP address

```
$ docker-machine ip trashadvisor
```

docker-compose

```
$ docker-compose build trashadvisor
$ docker-compose build --no-cache trashadvisor
$ docker-compose run trashadvisor command
$ docker-compose up trashadvisor
$ docker-compose stop
```

install docker-compose

```
$ sudo su -
$ mkdir /opt/
$ mkdir /opt/bin
$ curl -L https://github.com/docker/compose/releases/download/1.8.0/docker-compose-`uname -s`-`uname -m` > /opt/bin/docker-compose
$ chmod +x /opt/bin/docker-compose
$ exit
```

TODO

* sauvegarder waste avec les bonnes ref url
* supprimer insee de contribution

DONE
