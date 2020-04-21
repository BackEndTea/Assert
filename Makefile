.PHONY: all
all: cs psalm stan test

.PHONY: psalm
psalm: vendor
	vendor/bin/psalm

.PHONY: stan
stan:
	vendor/bin/phpstan analyse

.PHONY: cs
cs: vendor
	vendor/bin/phpcbf

.PHONY: cs-check
cs-check: vendor
	vendor/bin/phpcs

test: vendor
	vendor/bin/phpunit
vendor:
	composer update
