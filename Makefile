SYMFONY         = bin/console

##
## Project
## -------
##

install: ## Install the project
install:
	make -C events-bus/ install
	make -C mailer/ install
	make -C pdf-creator/ install


.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
