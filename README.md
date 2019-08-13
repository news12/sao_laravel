# sao_laravel
Sword Art Online Browser Game PHP/Laravel

Faça um clone do repositório em seu pc

utilize uma IDE a seu gosto, neste projeto foi utilizado o PHPStorm

Necessário conhecimento no framework Laravel.

Instale o Mysql 7.2 ou superior
configure um usuario e senha

https://laravel.com/docs/5.8

Installation

Clone the repo

  git clone https://github.com/news12/sao_laravel.git sao
  
Navigate to the project folder

  cd sao
  
Create .env file from the .env.example file

  copy .env.example .env

No arquivo .env altere as configuações de acordo com as suas

não esqueça de mudar:APP_URL=http://localhost/sword_art/sao_ng/public

Run composer install to import the dependencies and enable auto-loading

composer install

Generate Laravel Application key

  php artisan key:generate

Altere os dados do seed UsersTableSeeder

Run Laravel database migrations and seeds

  php artisan migrate --seed

Running in local environment

Create a symbolic link from "public/storage" to "storage/app/public"

  php artisan storage:link  
  
Run PHP build-in development server on the host machine

  php artisan serve  
  
  Navigate to http://localhost:8000/
