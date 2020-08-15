install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR12 app bootstrap/app.php config routes tests

test:
	php artisan test

test-coverage:
	composer run-script phpunit -- --coverage-clover clover.xml tests

tinker:
	php artisan tinker

run:
	php artisan serve

migrate:
	php artisan migrate --force

testone:
	./vendor/bin/phpunit --filter testFilter tests/Feature/TaskControllerTest.php
