<?php

namespace Zyncro\Framework\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CleanCache
{
    public $args;
    public $name;
    public $definition;
    public $description;
    public $help;
    public $execute;

    public function __construct()
    {
        $this->name = 'cache:clean';
        $this->definition = array();
        $this->description = 'Clean the cache folder';
        $this->help = 'The <info>cache:clean</info> command will delete all the contents of every cache folder';
        $this->execute = function (InputInterface $input, OutputInterface $output) {
            $cacheFolders = glob(__DIR__ . '/../../../../../../cache/*', GLOB_ONLYDIR);

            foreach ($cacheFolders as $folder) {
                $folderContents = scandir($folder);

                foreach ($folderContents as $folderContent) {
                    if ($folderContent !== '.' && $folderContent !== '..') {
                        exec('rm -Rf ' . $folder . '/' . $folderContent);
                    }
                }
            }

            $output->writeln('');
            $output->writeln('<info>The cache has been cleaned</info>');
            $output->writeln('');
        };
    }
}