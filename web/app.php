<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->register();

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Session\Session;
use Zyncro\Framework\App;

$session = new Session();
$session->start();

$dispatcher = new EventDispatcher();
$dispatcher->addListener('request', '\Zyncro\Framework\Security::listener');

$request = Request::createFromGlobals();
$app = new App($dispatcher, $session);
$response = $app->handle($request);

$response->send();