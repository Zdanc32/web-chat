# web-chat backend

<h4>Requirements</h4> <br />
* php 7.3+ <br />
* Symfony 5.*  <br />
* MySql 5.7 / MariaDB 10.3  <br />
* Mercure <link>https://symfony.com/doc/current/components/mercure.html</link>  <br />
* npm  <br />  
* composer  <br />
* ApiPlatform <link>https://api-platform.com/docs</link>  <br />
* Docker   <br /> 

<h4>Installing and start backend project</h4>  <br />
1. Clone this repository  <br />
2. Install docker <link>https://docs.docker.com/get-started/</link> <br />
3. Open docker directory in project <br />
4. Copy .env.dist file and rename from .env.dist to .env  <br />
5. Run commend: <i><b>docker-compose up -d --build</b></i> <br /> (if you want check existing you containers run commend: <i></b>docker ps</b></i>) <br />
6. Wait for docker that download all necessary extensions and lib   <br />
7. Go to link: <link>http://api.web-chat.test/api</link> <br />
8. Mercury installation and all necessary file you can find at my repository or link:  <br /><link>https://symfony.com/doc/current/components/mercure.html</link> <br />

You dont forget configure your host file or if you don't want play with docker you can use command: <i><b>symfony server:start</b></i> <link>https://symfony.com/doc/current/setup/symfony_server.html<link> 
but you need to install all required extension to your php. <br />
