#!/bin/bash

set -e

exec make -C /app PHPUNIT=vendor/bin/phpunit docker-phpunit
