init:  docker-down-clear docker-build perm docker-up composer-install wait-db migrate 
rebuild: docker-down docker-build docker-up perm
restart: down up
up: docker-up
down: docker-down

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans	

docker-build:
	docker-compose build

composer-install:
	docker-compose run --rm php-cli composer install --ignore-platform-reqs

composer-update:
	docker-compose run --rm php-cli composer install --ignore-platform-reqs

migrate:
	docker-compose run --rm php-cli php artisan migrate

vendor-publish:
	docker-compose run --rm php-cli php artisan vendor:publish

art-clear:
	docker-compose run --rm php-cli php artisan optimize:clear

test:
	docker-compose exec php-cli php artisan test

perm:
	sudo chgrp -R www-data project/storage project/bootstrap/cache
	sudo chmod -R ug+rwx project/storage project/bootstrap/cache

wait-db:
	bash wait-db.sh