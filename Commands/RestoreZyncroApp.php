<?php

namespace Zyncro\Framework\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;

class RestoreZyncroApp
{
    public $name;
    public $definition;
    public $description;
    public $help;
    public $execute;

    public function __construct()
    {
        $this->name = 'zyncroapp:restore';
        $this->definition = array(
            new InputArgument('namespace', InputArgument::REQUIRED, 'The namespace of the ZyncroApp'),
        );
        $this->description = 'Configure parameters of the ZyncroApp from the "config.yml" file';
        $this->help = '';
        $this->help = 'The <info>zyncroapp:restore</info> command will restore the "config.yml" file from the "config.yml.bkp" file.
This is an example of how to restore a ZyncroApp which namespace is <options=bold>mention</options=bold>:

    <info>php bin/console.php zyncroapp:restore mention</info>
    ';
        $this->execute = function (InputInterface $input, OutputInterface $output) {
            $this->execute($input, $output);
        };
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $args = $input->getArguments();
        $folder = $this->getZyncroAppFolder($args['namespace']);

        if ($folder) {
            $output->writeln('');
            $copied = $this->restoreZyncroAppConfigBackup($folder);

            if ($copied) {
                $output->writeln('<info>The configuration for the ZyncroApp with the namespace ' . $args['namespace'] . ' has been restored</info>');
            } else {
                $output->writeln('<error>The was an error copying the "config.yml.bkp" file to the "config.yml" file, check permissions.</error>');
            }
        } else {
            $output->writeln('');
            $output->writeln('<error>ZyncroApp with namespace ' . $args['namespace'] . ' is not found or doesn\'t have a config.yml.bkp file</error>');
        }

        $output->writeln('');
    }

    private function getZyncroAppFolder($namespace)
    {
        $zyncroAppPath = __DIR__ . '/../../../../../../src/*';
        $zyncroAppsFolders = glob($zyncroAppPath, GLOB_ONLYDIR);

        foreach ($zyncroAppsFolders as $folder) {
            if (strtolower(basename($folder)) === strtolower($namespace)) {
                $backupConfigPath = $folder . '/Config/config.yml.bkp';

                if (is_file($backupConfigPath)) {
                    return $folder;
                }
            }
        }

        return null;
    }

    private function restoreZyncroAppConfigBackup($folder)
    {
        $configPath = $folder . '/Config/config.yml';
        $backupConfigPath = $folder . '/Config/config.yml.bkp';

        return copy($backupConfigPath, $configPath);
    }
}