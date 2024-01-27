ifneq (,$(shell (type docker-compose 2>&1 >/dev/null && echo 1) || true))
	PHP=docker-compose run --rm --no-deps php
else
	PHP=php
endif

PHP_CONSOLE_DEPS=vendor

vendor: composer.json
	@$(PHP) composer install -o -n --no-ansi
	@touch vendor || true

phpunit: $(PHP_CONSOLE_DEPS)
	@$(PHP) vendor/bin/phpunit --color=always

check: phpunit
