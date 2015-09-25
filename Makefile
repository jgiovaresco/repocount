
setup:
	@(./composer install)
	@(cd repocount-phpunit; docker build -t repocount-phpunit .)

test: setup
	@docker run -ti --rm=true -v $(CURDIR):/app repocount-phpunit

docker-phpunit:
	$(PHPUNIT) $(PHPUNIT_TESTS_OPTIONS)
