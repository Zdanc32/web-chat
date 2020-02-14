
### Install from Docker
  
Docker version 18.09.0, build 4d60db4
docker-compose version 1.17.1
--------------------------------------------------------------------------------

Create network from dedicated local ip
* If the network uses this ip then select others (eg 172.255.0.1 or 172.19.0.0 or similar)
``` 
docker network create nginx-proxy --subnet=172.18.0.0/16 --gateway=172.18.0.1
```
Inspect network
``` 
docker network inspect nginx-proxy
```
Add to /ete/hosts IP gateway
* Also change the IP gateway in the .env file NGINX_PROXY_IP=172.18.0.1 
``` 
sudo echo "172.18.0.1 api.{host_name_from_your_env_file}.test" >> /etc/hosts
```
--------------------------------------------------------------------------------

### Getting started (Linux/Windows)

Work dir 
```
cd _develop
```

Enter your own settings
```
cp .env.dist .env 
```

* First run project up and build
```
docker-compose build --pull
```

* Up project
```
docker-compose up -d
```

* First run Symfony  
```
docker exec -it ws_php composer install
```

* Open url 
```
http://api.{host_name_from_your_env_file}.test/ 
```

* Down
```
docker-compose down
```

* Symfony list CLI commends symfony 
```
docker exec -it ws_php php bin/console 
```

* Doctrine schema:update 
```
docker exec -it ws_php php bin/console doctrine:schema:update --force
```

### Load fixtures 

``` 
docker exec -it ws_php bin/console app:load-fixtures
``` 

--------------------------------------------------------------------------------

### PHP Coding Standards Fixer 
https://cs.symfony.com/

``` 
docker exec -it ws_php php-cs-fixer fix
```
--------------------------------------------------------------------------------

### Getting started (OSX)

Work dir 
```
cd _develop
```

Enter your own settings
```
cp .env.dist .env 
```

Install docker-sync
```
sudo gem install docker-sync
```

* First run project up and build
```
docker-compose build --pull
```

* Project up
```
docker-compose up -d
```

* First run Symfony  
```
docker exec -it ws_php composer install
```

* Open url 
```
http://api.{host_name_from_your_env_file}.test/api
```

* Enter shell in project (for loading fixtures and clearing cache)
```
docker exec -it ws_php bash
```

* When you're inside shell (executed by command above), change permissions to write in container for var folder
```
chmod 777 var
```
--------------------------------------------------------------------------------

*  Generate entity by DB
``` 
docker exec -it ws_php bin/console doctrine:mapping:import App\\Entity annotation --path=src/Entity
docker exec -it ws_php bin/console make:entity --regenerate App
``` 

*  Entrance to the container
```
docker exec -it ws_php bash
docker exec -it ws_web bash
docker exec -it ws_mariadb bash 
```
 
* List run container
``` 
docker ps
``` 

* Docker stop all container
``` 
docker stop $(docker ps -q)
``` 

* Other
``` 
docker info
docker ps -a -f status=dead
docker ps -a -f status=exited
docker rm -f $(docker ps -aqf status=dead)
docker rm -f $(docker ps -aqf status=exited)

docker images -f dangling=true
docker rmi $(docker images -q -f dangling=true)
docker container prune # Remove all stopped containers
docker volume prune # Remove all unused volumes
docker image prune # Remove unused images
```

### Remove force all - (remove all project)
```
docker system prune --all --force --volumes
```

### Tests
docker exec -it ws_php ./vendor/bin/phpunit --coverage-html=coverage/

