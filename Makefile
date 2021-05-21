.PHONY: help
help: ## Print this help page
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'



.PHONY: install
install: ## Install the depedencies (composer install & node_modules install)
	docker-compose exec composer composer install
	docker-compose exec frontend yarn
	docker-compose exec frontend-admin yarn
	docker-compose exec composer cp .env.example ./
	docker-compose exec composer php artisan key:generate

	Green='\033[0;32m'
	BGreen='\033[1;32m'
	NC='\033[0m' # No Color
	echo -e "${Green}Done ! If everything's fine, begin the development now ! ${BGreen}Happy coding !${NC}"



.PHONY: migrate
migrate: ## Update the database
	docker-compose exec composer php artisan migrate

.PHONY: fresh
fresh: ## php artisan migrate:fresh --seed
	docker-compose exec composer php artisan migrate:fresh --seed



.PHONY: bash
bash: ## Go in container
	docker-compose exec composer bash

.PHONY: test
test: ## Run tests
	docker-compose exec composer php artisan test

.PHONY: route
route: ## Print the route list
	docker-compose exec composer php artisan route:list


.PHONY: fix_permissions
fix_permissions: ## Fix the permissions
	echo "TODO"


.PHONY: prod
prod: ## Run in production
	docker-compose -f docker-compose.prod.yml up -d
