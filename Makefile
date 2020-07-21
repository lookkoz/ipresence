.PHONY: docs

run-app:
	docker-compose up -d

run-unit-tests:
	./bin/phpunit -c tests/unit/phpunit.xml.dist

run-functional-tests:
	./bin/phpunit -c tests/functional/phpunit.xml.dist