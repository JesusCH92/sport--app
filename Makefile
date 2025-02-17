#! /bin/bash

##	deploy:							deploying app
deploy:
	-docker network create app-network | true
	-docker-compose -p sport up -d
	-@docker exec -it php-fpm composer install
	-@docker exec -it php-fpm php vendor/bin/phinx migrate
