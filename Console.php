<?php

require_once __DIR__ . '/../../../../autoload.php';

use Symfony\Component\Console\Application;

$console = new Application();
$commands = preg_grep('/^([^.])/', scandir(__DIR__ . '/Commands'));

foreach ($commands as $command) {
    $class = 'Zyncro\\Framework\Commands\\' . preg_replace('/.[^.]*$/', '', $command);
    $command = new $class();

    $console
        ->register($command->name)
        ->setDefinition($command->definition)
        ->setDescription($command->description)
        ->setHelp($command->help)
        ->setCode($command->execute);
}

$console->run();