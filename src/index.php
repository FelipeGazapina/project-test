<?
    ini_set('display_errors', 1);

require_once 'Core/Core.php';
require_once 'database/DB.php';
require_once 'controller/HomeController.php';
require_once 'controller/CadastrarController.php';
require_once 'controller/ErrorController.php';

require_once 'model/User.php';

ob_start();
    $core = new Core;
    $core->start($_GET,$_POST);

    $saida = ob_get_contents();

ob_end_clean();



$template = file_get_contents( $_SERVER['DOCUMENT_ROOT'].'/src/view/'.$saida.'.html');

str_replace('{{search}}', replace, $template);

echo $template;
?>