<?php

ini_set('display_errors', 0);

define('HOST','localhost');
define('USER','postgres');
define('SENHA','root');
define('BANCO','pdv');
define('PORTA','5432');

define('DS', DIRECTORY_SEPARATOR);
define('DIR_APP', $_SERVER['DOCUMENT_ROOT'].'/pdv-api');
define('DIR_PROJETO', 'pdv-api');

if(file_exists('autoload.php')){
    include 'autoload.php';
}else{
    die('Erro ao incluir o autoload.');
}

?>