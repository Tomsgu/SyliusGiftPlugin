phpstan: vendor/ phpstan.neon
	vendor/bin/phpstan analyse -c phpstan.neon
.PHONY: phpstan

psalm: vendor/ psalm.xml
	vendor/bin/psalm -c psalm.xml
.PHONY: psalm

ecs: vendor/ ecs.php
	vendor/bin/ecs check
.PHONY: ecs

ecs-fix: vendor/ ecs.php
	vendor/bin/ecs check --fix
.PHONY: ecs-fix

behat: vendor/
	vendor/bin/behat
.PHONY: behat

phpspec: vendor/
	vendor/bin/phpspec run
.PHONY: phpspec
