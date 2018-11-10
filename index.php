<?php
define('app',1);
session_start();
require 'utils/auto_loader.php';
require 'Application.php';

$config = array_merge(
    require 'config/main.php',
    require 'config/database.php'
);
$app = new Application();
$app->start($config);
