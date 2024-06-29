.RECIPEPREFIX +=
.DEFAULT_GOAL := help
sail := vendor/bin/sail

help:
	@echo "welcome to IT Support"

install:
	@composer install

test:
	php artisan test 

CleanTest:
	php artisan test && rm -rf storage/tenant* &&  rm -rf storage/app/*

fresh: 
	rm -rf storage/app/listings/* && php artisan migrate:fresh --seed 

clearFiles: 
	rm -rf storage/app/listings/*

dockerFresh:
	@docker exec -it mybnb_php make fresh