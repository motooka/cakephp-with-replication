# CakePHP CMS Tutorial with RDB Replication Considerations
An implementation of [CakePHP CMS Tutorial](https://book.cakephp.org/3/en/tutorials-and-examples/cms/installation.html) which comes with :

- RDB replication considerations
- Docker settings for local development environment

# Requirements
- [Docker Compose](https://docs.docker.com/compose/install/)
	- [Docker Desktop for Mac](https://docs.docker.com/docker-for-mac/install/)
	- [Docker Desktop for Windows](https://docs.docker.com/docker-for-windows/install/)
- Internet connection during setup
- The following TCP ports are available on your machine. If you want to change this, just modify `ports` left value in [docker-compose.yml](./docker-compose.yml)
	- 8080 : The CMS app listens here
	- 8081 : phpMyAdmin listens here
	- 3306 : MySQL listens here

# Installation
- Clone this repository
- Open a terminal and move to the cloned directory, where you can see `docker-compose.yml` or some other files.
- Execute the following commands
```
docker-compose build
docker-compose up -d
docker-compose exec web "/composer_install.sh"
```
Note : If you have some troubles on `docker-compose build`, try `docker-compose build --no-cache` instead.

# Local Development Environment
- Commands : can be executed in the repository root directory
	- `docker-compose start` : start the container working
	- `docker-compose stop` : stop the container working
	- `docker-compose down` : destroy the containers. You will need Installation steps described above to reenable the environment after destroying.
	- `docker-compose exec web bash` : destroy the containers
- URLs
	- http://localhost:8080/ : the CMS app
	- http://localhost:8081/ : phpMyAdmin

# License
MIT License

# Version Information
- CakePHP : 3.8
- [Ubuntu Docker Image](https://hub.docker.com/_/ubuntu) : 18.04 (bionic)
	- PHP 7.2
- [MySQL Docker Image](https://hub.docker.com/_/mysql) : 8.0
- [phpMyAdmin Docker Image](https://hub.docker.com/r/phpmyadmin/phpmyadmin) : 4.9
