SYMFONY         = bin/console

##
## Project
## -------
##

install: ## Install the project
install: db

reset: ## Stop a fresh install of the project
reset: clean install

clean: ## Stop the project and remove generated files
clean:
	rm -rf vendor

.PHONY: install reset clean

##
## Utils
## -----
##

db: ## Reset the database and load fixtures
db: vendor
	php -r 'echo "Wait database...\n"; set_time_limit(30); require __DIR__."/config/bootstrap.php";'
	-$(SYMFONY) doctrine:database:drop --if-exists --force
	-$(SYMFONY) doctrine:database:create --if-not-exists
	$(SYMFONY) doctrine:migrations:migrate --no-interaction --allow-no-migration
#	$(SYMFONY) doctrine:fixtures:load --no-interaction --purge-with-truncate

migration: ## Generate a new doctrine migration
migration: vendor
	$(SYMFONY) doctrine:migrations:diff

db-validate-schema: ## Validate the doctrine ORM mapping
db-validate-schema: vendor
	$(SYMFONY) doctrine:schema:validate

.PHONY: db migration

# rules based on files
composer.lock: composer.json
	composer update --lock --no-scripts --no-interaction

vendor: composer.lock
	composer install

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
