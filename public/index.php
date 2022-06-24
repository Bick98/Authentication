<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use src\controller\controllerClass;
require_once "/var/www/html/Autisto/src/controller/controllerClass.php";
require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . "/twigTemplates/template/");
$twig = new Environment($loader);
$cntrl = new controllerClass($twig);

$cntrl->goToPage();