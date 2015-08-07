<?php

namespace Zyncro\Framework\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;

class ConfigureZyncroApp
{
    public $name;
    public $definition;
    public $description;
    public $help;
    public $execute;

    public function __construct()
    {
        $this->name = 'zyncroapp:configure';
        $this->definition = array(
            new InputArgument('namespace', InputArgument::REQUIRED, 'The namespace of the ZyncroApp'),
        );
        $this->description = 'Configure parameters of the ZyncroApp from the "config.yml" file';
        $this->help = '';
        $this->help = 'The <info>zyncroapp:configure</info> command will read the "config.yml" file of the ZyncroApp and ask for all the parameters.
It will make a backup of the "config.yml" file in the same directory with the name "config.yml.bkp".
Yo can restore this backup using the <info>restore:zyncroapp</info> command.
This is an example of how to configure a ZyncroApp which namespace is <options=bold>mention</options=bold>:

    <info>php bin/console.php zyncroapp:configure mention</info>
    ';
        $this->execute = function (InputInterface $input, OutputInterface $output) {
            $this->execute($input, $output);
        };
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $args = $input->getArguments();
        $config = $this->getZyncroAppConfig($args['namespace']);
        $helper = new QuestionHelper();
        $newParameters = array();

        if ($config) {
            $output->writeln('');
            $parameters = $this->getParametersFromConfig($config);

            foreach ($parameters as $parameter) {
                if (!isset($newParameters[$parameter['block']])) {
                    $newParameters[$parameter['block']] = array();
                }

                $question = new Question('Set value for parameter <fg=green>' . $parameter['key'] . '</fg=green> of block <fg=green>' . $parameter['block'] . '</fg=green> (default: <fg=yellow>' . $parameter['value'] . '</fg=yellow>): ', $parameter['value']);
                $newParameters[$parameter['block']][$parameter['key']] = $helper->ask($input, $output, $question);
            }

            $dataSaved = $this->saveZyncroAppConfig($args['namespace'], $newParameters);

            if ($dataSaved) {
                $output->writeln('');
                $output->writeln('<info>The new configuration for the ZyncroApp with the namespace ' . $args['namespace'] . ' has been saved</info>');
                $output->writeln('');
            }
        } else {
            $output->writeln('<error>ZyncroApp with namespace ' . $args['namespace'] . ' is not found or doesn\'t have a config.yml file</error>');
        }
    }

    private function getZyncroAppConfig($namespace)
    {
        $zyncroAppPath = __DIR__ . '/../../../../../../src/*';
        $zyncroAppsFolders = glob($zyncroAppPath, GLOB_ONLYDIR);

        foreach ($zyncroAppsFolders as $folder) {
            if (strtolower(basename($folder)) === strtolower($namespace)) {
                $configPath = $folder . '/Config/config.yml';

                if (is_file($configPath)) {
                    $yamlParser = new Yaml\Parser();
                    $config = $yamlParser->parse(file_get_contents($configPath));

                    if (is_array($config)) {
                        return $config;
                    }
                }
            }
        }

        return null;
    }

    private function getParametersFromConfig($config)
    {
        $parameters = array();

        foreach ($config as $block => $fields) {
            foreach ($fields as $key => $value) {
                $parameters[] = array(
                    'block' => $block,
                    'key' => $key,
                    'value' => $value
                );
            }
        }

        return $parameters;
    }

    private function saveZyncroAppConfig($namespace, $config)
    {
        $zyncroAppPath = __DIR__ . '/../../../../../../src/*';
        $zyncroAppsFolders = glob($zyncroAppPath, GLOB_ONLYDIR);

        foreach ($zyncroAppsFolders as $folder) {
            if (strtolower(basename($folder)) === strtolower($namespace)) {
                $configPath = $folder . '/Config/config.yml';
                $backupConfigPath = $folder . '/Config/config.yml.bkp';

                if (is_file($configPath) && is_writable($configPath)) {
                    copy($configPath, $backupConfigPath);

                    $yamlContent = Yaml\Yaml::dump($config);
                    $yamlFile = fopen($configPath, 'w');

                    if (fwrite($yamlFile, $yamlContent)) {
                        fclose($yamlFile);

                        return true;
                    }
                }
            }
        }

        return null;
    }
}