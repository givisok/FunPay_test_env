.PHONY: clean stop start-dev

.PHONY: shell-dev shell-node shell-phpunit

.PHONY: phpunit logs fixperm node-install comp-update comp-update-dev

stop:
	@docker-compose stop

fixperm:	
	@bash scripts/fix-perm.sh

logs:
	@docker-compose logs

clean: stop
	@bash scripts/rm-runtime.sh
	@bash scripts/clean-images.sh

phpunit:
	@docker-compose run --rm phpunit

start-dev:
	@docker-compose up -d nginx-dev

node-install:
	@docker-compose run --rm node npm install
	@docker-compose run --rm node bower install

shell-node:
	@docker-compose run --rm node sh

shell-dev:
	@bash scripts/get-dev-shell.sh
