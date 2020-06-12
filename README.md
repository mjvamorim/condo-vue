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

> > SET PASSWORD FOR 'root'@'localhost' = PASSWORD('root');
> > create database if not exists laravue;

php artisan migrate:fresh

php artisan db:seed

npm install

npm run watch

php artisan serve

http://localhost:8000

Tarefas a realizar Felipe
#########################

ok 1. Icones do sidebar
ok 2. Linkar a sidebar proprietarios a página do proprietarios (obs: a rota já existe)

3. Criar uma página para cada opçao do menu
   a) Criar o arquivo na pasta pages, copiar do Dashboard.vue
   b) Importar página
   c) Criar rota
   d) Alterar sidebar, link para rota
4. Diminuir fonte do menu
5. Paginas
6. Criar Pages (parecida com proprietario trocando os campos)
   a) Proprietário (ok)
   b) Unidade
   c) Taxa
   d) Debito
   e) Email
   f) Acordo

Tarefas Mauricio
################

1. Testar solução multitenant
2. Criar API
   a) Proprietário (ok)
   b) Unidade
   c) Taxa
   d) Debito
   e) Email
   f) Acordo
3. Componentes do Vue
   ok a) Mover routes.js
   ok b) Máscara para campos
   ok c) Cep
4. Rotinas Financeiras
   a) Gerar Mensalidades
   b) Gerar Remessa
   c) Baixas Bancárias
   d) Acordo
5. Utilidades
   a) Manual do Usuário
   b) Log de Baixas
   c) Emails enviados
