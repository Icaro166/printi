bash ./vendor/bin/sail up -d
echo  --tests--
bash ./vendor/bin/sail artisan test
echo  --migrate and seed--
bash ./vendor/bin/sail artisan migrate --seed
