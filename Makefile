install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR12 bin src

test:
	composer run-script phpunit tests

console:
	./vendor/bin/psysh psysh.php
