<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

/** @var Slim\App $app */
$app = require_once dirname(__DIR__) . '/source/bootstrap.php';

$app->run();