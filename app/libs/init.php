<?php
ob_start();

define('BASEPATH', realpath(__DIR__ . '/..'));
require_once(BASEPATH . '/vendor/autoload.php');
require_once(BASEPATH . '/libs/Config.php');

$template_config = Config::get('template');
$path = BASEPATH . $template_config['dir'];

$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader($path));