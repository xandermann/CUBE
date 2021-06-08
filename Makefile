.PHONY: help
help: ## Print this help page
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'



.PHONY: install
install: ## Install the docker images & depedencies
	docker-compose pull
	docker-compose build

	docker-compose run --rm composer composer install
	docker-compose run --rm frontend yarn
	docker-compose run --rm frontend-admin yarn

	docker-compose run --rm composer cp .env.example .env
	docker-compose run --rm frontend cp .env.example .env
	docker-compose run --rm frontend-admin cp -p .env.example .env

	docker-compose run --rm composer php artisan key:generate



.PHONY: migrate
migrate: ## Migrate the database
	docker-compose run --rm composer php artisan migrate

.PHONY: fresh
fresh: ## Migrate and seed the database
	docker-compose run --rm composer php artisan migrate:fresh --seed



.PHONY: artisan
artisan: ## Open bash terminal in composer container
	docker-compose exec composer bash



.PHONY: test
test: test-backend test-frontend test-frontend-admin ## Run all tests

.PHONY: test-backend
test-backend: ## Run backend tests
	docker-compose run --rm composer php artisan test

.PHONY: test-frontend
test-frontend: ## Run frontend tests
	docker-compose run --rm frontend yarn test

.PHONY: test-frontend-admin
test-frontend-admin: ## Run frontend-admin tests
	docker-compose run --rm frontend-admin yarn test



.PHONY: route
route: ## Print the route list
	docker-compose run --rm composer php artisan route:list

.PHONY: route-compact
route-compact: ## Print the route list (compact)
	docker-compose run --rm composer php artisan route:list --compact



.PHONY: fix-permissions
fix-permissions: ## Fix the permissions (sudo needed)
	# You can run this command:
	# sudo chown $$USER:www-data backend/ -R




.PHONY: dev
dev: ## Run in development (run "make install" if first time)
	docker-compose down
	docker-compose up -d


.PHONY: pre-prod
pre-prod: ## Run on vps (with docker-compose)
	docker-compose down
	docker-compose -f docker-compose.prod.yml down

	docker-compose run --rm frontend rm -rf .nuxt dist
	docker-compose run --rm frontend-admin rm -rf .nuxt dist

	docker-compose run --rm frontend yarn build
	docker-compose run --rm frontend-admin yarn build

	docker-compose -f docker-compose.prod.yml up -d

	docker-compose run --rm composer wait-for-it.sh database:5432 -- php artisan migrate:fresh --seed

.PHONY: prod
prod: ## Run in prod
	echo "TODO (docker swarm / kubernetes)"
