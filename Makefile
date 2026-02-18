up:
	docker compose up -d --build

down:
	docker compose down

logs:
	docker compose logs -f

bash:
	docker compose exec app bash

install:
	docker compose exec app composer install

migrate:
	docker compose exec app php bin/console doctrine:migrations:migrate

test:
	docker compose exec app php bin/phpunit
