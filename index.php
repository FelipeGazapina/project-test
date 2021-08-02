<?php

    session_start();

    ini_set('display_errors', 1);
    require_once 'src/core/Core.php';

    require_once 'src/database/Connection.php';

    require_once 'src/controller/LoginController.php';
    require_once 'src/controller/DashboardController.php';
    require_once 'src/controller/CadastrarController.php';
    require_once 'src/controller/RelatorioController.php';

    require_once 'src/model/User.php';
    require_once 'src/model/Pontos.php';

    require_once 'vendor/autoload.php';

    $core = new Core;
    echo $core->start($_GET);

?>