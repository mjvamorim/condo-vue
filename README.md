### Baixar e instalar o mysql e php ou o (Xamp)
https://www.apachefriends.org/pt_br/download.html

### Baixar e instalar o nodejs 
https://nodejs.org/en/download/


### Baixar o git
https://git-scm.com/downloads


### Executar os comandos abaixo

git clone http://github.com/mjvamorim/condo-vue

cd condo-vue


composer install

cp .env.example .env

mysql -u root
>>  SET PASSWORD FOR 'root'@'localhost' = PASSWORD('root');
>>  create database if not exists laravue; 

php artisan migrate:fresh


php artisan db:seed

npm install

npm run watch

php artisan serve

http://localhost:8000

