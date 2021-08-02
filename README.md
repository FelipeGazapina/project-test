# project-test
Sistema de lançamento de horas

Este projeto é um CRUD simples de um sistema de lançamento de horas.
Usuário pode registrar no sistema e entrar no sistema<br><br>

Ações do usuário:<br>
    - Login<br>
    - Cadastro de usuários<br>
    - Cadastro de colaboradores<br>
    - Lançamento de pontos dos colaboradores<br>
    - Relatório com filtro por período com opção de ordenar por nome e data<br><br>

Ações Back-End:<br>
    - Confirir usuário existente<br>
    - Cadastrar usuário não existente<br>
    - Administrador de pontos dos outros usuários<br>
    - buscar a tabela de relatórios do banco de dados<br>

PEDIDOS DO SISTEMA<br>

Nele precisa ter os seguintes requisitos:<br>
    - Login<br>
    - Cadastro de usuários<br>
    - Cadastro de colaboradores<br>
    - Lançamento de pontos dos colaboradores<br>
    - Relatório com filtro por período com opção de ordenar por nome e data<br><br>

Requisitos obrigatórios:<br>
    - PHP sem a utilização de frameworks<br>
    - Banco de dados mysql ou mariadb<br><br>

GUIA DE INSTALAÇÃO<br>
   Neste projeto é usado o driver PDO para fazer as interações com o banco de dados. portanto é necessário<br>
   dentro do php.ini descomentar ou inserir as seguintes linhas:
    
    extension=php_pdo.dll
    extension=php_pdo_mysql.dll
    
   Também é necessário a instalação do composer na sua máquina.
   Siga os passos dados pelo site https://getcomposer.org/
   <br><br>
   Foi utilizado um view engine chamado Twig, portanto é necessário insala-lo também.
   Primeiro se cria um arquivo composer.json na raiz do projeto. Após isso se faz o download do composer.phar https://getcomposer.org/composer.phar
   e salvar ele na pasta raiz.<br>
   Segundo deve entrar no terminal na pasta raiz e colocar o seguinte código:<br>
    
    php composer.phar install
   
   Terceiro ajeitar as config para conexão com o banco de dados, na pasta src/database, mudar a seguinte linha de código:
   
    self::$conn = new \PDO('mysql:host=localhost;dbname=project_test', 'root','');
   
   Quarto importar a tabela project_test, que se encontra na raiz do projeto, para seu phpMyAdmin.<br><br>
    
Após estes passos o projeto estará pronto para começar<br><br>

Terá um login e senha como adiministrador:<br>
    login: ADM<br>
    senha: ADM<br>
e um para teste de usuário comum:<br>
    login: test<br>
    senha: test<br>
