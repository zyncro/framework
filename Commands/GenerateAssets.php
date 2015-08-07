<?php

namespace Zyncro\Framework\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateAssets
{
    public $args;
    public $name;
    public $definition;
    public $description;
    public $help;
    public $execute;

    public function __construct()
    {
        $this->name = 'assets:generate';
        $this->definition = array();
        $this->description = 'Copy all resources from all the apps to the public folder';
        $this->help = 'The <info>assets:generate</info> command will copy all resources (javascript, css and images) from all the apps to the "assets" public folder';
        $this->execute = function (InputInterface $input, OutputInterface $output) {
            $publicFolder = __DIR__ . '/../../../../../../web/assets';
            $appsFolder = __DIR__ . '/../../../../../../src';
            $apps = scandir($appsFolder);

            foreach ($apps as $app) {
                if ($app === '.' or $app === '..') continue;

                $resourcesFolder = $appsFolder . '/' . $app . '/Resources';

                if (is_dir($resourcesFolder)) {
                    $publicAppFolder = $publicFolder . '/' . $app;

                    if (!is_dir($publicAppFolder)) {
                        exec('mkdir ' . $publicAppFolder);
                    }

                    if (is_dir($resourcesFolder . '/css')) {
                        if (!is_dir($publicAppFolder . '/css')) {
                            exec('mkdir ' . $publicAppFolder . '/css');
                        }

                        exec('cp -R ' . $resourcesFolder . '/css/* ' . $publicAppFolder . '/css');
                    }

                    if (is_dir($resourcesFolder . '/img')) {
                        if (!is_dir($publicAppFolder . '/img')) {
                            exec('mkdir ' . $publicAppFolder . '/img');
                        }

                        exec('cp -R ' . $resourcesFolder . '/img/* ' . $publicAppFolder . '/img');
                    }

                    if (is_dir($resourcesFolder . '/tpl')) {
                        if (!is_dir($publicAppFolder . '/tpl')) {
                            exec('mkdir ' . $publicAppFolder . '/tpl');
                        }

                        exec('cp -R ' . $resourcesFolder . '/tpl/* ' . $publicAppFolder . '/tpl');
                    }
                }
            }
        };
    }
}