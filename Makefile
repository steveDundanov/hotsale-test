recreate: remove build up build-assets
restart: down up

build:
	vendor/bin/sail build

up:
	vendor/bin/sail up -d

down:
	vendor/bin/sail down --remove-orphans

remove:
	vendor/bin/sail down -v --remove-orphans

artisans:
	vendor/bin/sail artisan $(filter-out $@,$(MAKECMDGOALS))

composer:
	vendor/bin/sail composer $(filter-out $@,$(MAKECMDGOALS))

install-node-packages:
	vendor/bin/sail npm i -D

install-node-package:
	vendor/bin/sail npm i -D $(filter-out $@,$(MAKECMDGOALS))

run-dev-front:
	vendor/bin/sail npm run dev

build-assets:
	vendor/bin/sail npm run build
