# web-chat backend

<h4>Requirements</h4>
* php 7.3+
* Symfony 5.*
* MySql 5.7 / MariaDB 10.3
* Mercure <link>https://symfony.com/doc/current/components/mercure.html</link>
* npm 
* composer
* ApiPlatform <link>https://api-platform.com/docs</link>
* Docker  

<h4>Installing and start backend project</h4>
1. Clone this repository 
2. Install docker <link>https://docs.docker.com/get-started/</link>
3. Open docker directory in project
4. Copy .env.dist file and rename from .env.dist to .env
5. Run commend: <i><b>docker-compose up -d --build</b></i> (if you want check existing you containers run commend: <i></b>docker ps</b></i>)
6. Wait for docker that download all necessary extensions and lib  
7. Go to link: <link>http://api.web-chat.test/api</link>
8. Mercury installation and all necessary file you can find at my repository or link: <link>https://symfony.com/doc/current/components/mercure.html</link>

You dont forget configure your host file or if you don't want play with docker you can use command: <i><b>symfony server:start</b></i> <link>https://symfony.com/doc/current/setup/symfony_server.html<link>
but you need to install all required extension to your php.