.PHONY: help
help: ## Affiche cette aide
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'


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
