.PHONY: help
help: ## Print this help page
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'



.PHONY: install
install: ## Install the docker images & depedencies (vendors & node_modules)
	docker-compose up -d # Install the images and run the containers

	docker-compose exec composer composer install
	docker-compose exec frontend yarn
	docker-compose exec frontend-admin yarn
	docker-compose exec composer cp .env.example .env
	docker-compose exec composer php artisan key:generate

	Green='\033[0;32m'
	BGreen='\033[1;32m'
	NC='\033[0m' # No Color
	echo -e "${Green}Installation is done! Check the README for more informations. ${BGreen}Happy coding ! ${NC}"



.PHONY: migrate
migrate: ## Migrate the database
	docker-compose exec composer php artisan migrate

.PHONY: fresh
fresh: ## Migrate and seed the database
	docker-compose exec composer php artisan migrate:fresh --seed



.PHONY: bash
bash: ## Open bash terminal in composer container
	docker-compose exec composer bash



.PHONY: test
test: test-backend test-frontend test-frontend-admin ## Run all tests

.PHONY: test-backend
test-backend: fresh ## Run backend tests
	docker-compose exec composer php artisan test

.PHONY: test-frontend
test-frontend: ## Run frontend tests
	docker-compose exec frontend yarn test

.PHONY: test-frontend-admin
test-frontend-admin: ## Run frontend-admin tests
	docker-compose exec frontend-admin yarn test



.PHONY: route
route: ## Print the route list
	docker-compose exec composer php artisan route:list



.PHONY: fix_permissions
fix_permissions: ## Fix the permissions (sudo needed)
	echo "TODO"



.PHONY: dev
dev: ## Run in development
	docker-compose up -d

.PHONY: prod
prod: ## Run in production
	docker-compose -f docker-compose.prod.yml up -d
