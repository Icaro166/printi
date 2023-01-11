# Readme project-print

##  Como Começar

Assumindo que você já tenha instalado em sua máquina, [PHP 8.x](https://www.php.net/manual/en/install.php),
[Laravel 9.x](https://laravel.com/docs/9.x), [Composer](https://getcomposer.org/doc/00-intro.md, ) e [Docker](https://www.docker.com/)

``` bash
# instale as dependências
composer install

# crie arquivo env
cp .env.example .env
```

#### Em seguida, inicie o servidor:

## Linux

``` bash
bash rundev.sh
```

## Windows
``` bash
.\rundev.ps1
```

## Manual
``` bash
# levanta os conteineres
bash ./vendor/bin/sail up -d
# roda o teste
bash ./vendor/bin/sail artisan test
# executa as migrations e seeders
bash ./vendor/bin/sail artisan migrate --seed
```

Após realizar todas as ações a [documentação](http://localhost/api/documentation/) já está disponível para começar a usar a API.
