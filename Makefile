install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR12 app bootstrap/app.php config database routes tests

test:
	php artisan test

tinker:
	php artisan tinker

run:
	php artisan serve

migrate:
	php artisan migrate --force
