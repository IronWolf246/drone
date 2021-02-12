# Drone

**Como executar o projeto**

1. Clone o repositorio
2. Crie um banco de dados como por exemplo 'drone'
3. Copie o arquivo .env.example para .env e configure. (Coloque o nome do banco, usuário e senha)
4. Crie uma chave de 32 caracteres e preencha no campo APP_KEY do .env
5. Tenha instalado na máquina o [composer](https://getcomposer.org/)
6. Execute `composer install` para instalar as dependências do Lumen
7. Execute `php artisan migrate --seed` para gerar o banco de dados
8. Execute `php -S localhost:8000 -t public` para iniciar o servidor na porta 8000
9. Teste as rotas utilizando as requisições criadas no Insomnia