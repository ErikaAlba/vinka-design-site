UID=$(shell id -u)
GID=$(shell id -g)
CONTAINER=php

start: down build install up init

build: ## build dockers
	docker-compose build

bash: ## enter inside php bash
	docker-compose exec -u ${UID}:${GID} ${CONTAINER} sh

up: ## up -d dockers
	docker-compose up -d

down: ## down dockers
	docker-compose down

install: ## make composer install
	docker-compose run --rm -u ${UID}:${GID} ${CONTAINER} composer install

init: ## create database and execute migrations
	docker-compose run --rm -u ${UID}:${GID} ${CONTAINER} console doctrine:database:create --if-not-exists
	docker-compose run --rm -u ${UID}:${GID} ${CONTAINER} console doctrine:migrations:migrate --no-interaction
	npm install
	npm run build

fixtures: ## load project fixtures
	docker-compose run --rm -u ${UID}:${GID} php console doctrine:fixtures:load --no-interaction

help: ## Display this help message
	@cat $(MAKEFILE_LIST) | grep -e "^[a-zA-Z_\-]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'