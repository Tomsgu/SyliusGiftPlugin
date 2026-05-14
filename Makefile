phpstan: vendor/ phpstan.neon
	vendor/bin/phpstan analyse -c phpstan.neon
.PHONY: phpstan

ecs: vendor/ ecs.php
	vendor/bin/ecs check
.PHONY: ecs

ecs-fix: vendor/ ecs.php
	vendor/bin/ecs check --fix
.PHONY: ecs-fix

db-reset: vendor/
	vendor/bin/console doctrine:database:drop --force --if-exists --env=test
	vendor/bin/console doctrine:database:create --env=test
	vendor/bin/console doctrine:schema:update --complete --force --env=test
	vendor/bin/console sylius:fixtures:load -n --env=test
.PHONY: db-reset

vendor/sylius/test-application/public/build/admin/entrypoints.json: vendor/
	cd vendor/sylius/test-application && yarn install && yarn build
	vendor/bin/console assets:install

frontend-build: vendor/sylius/test-application/public/build/admin/entrypoints.json
.PHONY: frontend-build

test-app-init: db-reset frontend-build
.PHONY: test-app-init

server-start:
	@if ! curl -sf -o /dev/null http://127.0.0.1:8080/; then \
		APP_ENV=test symfony server:start --port=8080 --dir=vendor/sylius/test-application/public --daemon; \
	fi
	@echo "Symfony server running on 127.0.0.1:8080 (APP_ENV=test)"
.PHONY: server-start

server-stop:
	@symfony server:stop --dir=vendor/sylius/test-application/public || true
.PHONY: server-stop

behat: vendor/sylius/test-application/public/build/admin/entrypoints.json server-start
	@mkdir -p etc/build
	@set -e; \
	chromium --headless --disable-gpu --no-sandbox \
		--remote-debugging-port=9222 about:blank \
		> etc/build/chromium.log 2>&1 & \
	CHROME_PID=$$!; \
	trap "kill $$CHROME_PID 2>/dev/null" EXIT INT TERM; \
	vendor/bin/behat
.PHONY: behat

behat-no-js: vendor/sylius/test-application/public/build/admin/entrypoints.json
	vendor/bin/behat --tags='~@javascript'
.PHONY: behat-no-js

phpspec: vendor/
	vendor/bin/phpspec run
.PHONY: phpspec
