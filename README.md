﻿# project-test
Sistema de lançamento de horas

Este projeto é um CRUD simples de um sistema de lançamento de horas.
Usuário pode registrar no sistema e entrar no sistema

Ações do usuário:<br>
    - Login
    - Cadastro de usuários
    - Cadastro de colaboradores
    - Lançamento de pontos dos colaboradores
    - Relatório com filtro por período com opção de ordenar por nome e data

Ações Back-End:
    - Confirir usuário existente
    - Cadastrar usuário não existente
    - Administrador de pontos dos outros usuários
    - buscar a tabela de relatórios do banco de dados

PEDIDOS DO SISTEMA

Nele precisa ter os seguintes requisitos:
    - Login
    - Cadastro de usuários
    - Cadastro de colaboradores
    - Lançamento de pontos dos colaboradores
    - Relatório com filtro por período com opção de ordenar por nome e data

Requisitos obrigatórios:
    - PHP sem a utilização de frameworks
    - Banco de dados mysql ou mariadb

GUIA DE INSTALAÇÃO
   Neste projeto é usado o driver PDO para fazer as interações com o banco de dados. portanto é necessário
   dentro do php.ini descomentar ou inserir as seguintes linhas:
    
    extension=php_pdo.dll
    extension=php_pdo_mysql.dll
    
Após estes passos o projeto estará pronto para começar
