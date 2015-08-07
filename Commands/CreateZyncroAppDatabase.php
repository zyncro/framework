<?php

namespace Zyncro\Framework\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;

class CreateZyncroAppDatabase
{
    public $args;
    public $name;
    public $definition;
    public $description;
    public $help;
    public $execute;

    public function __construct()
    {
        $this->name = 'zyncroapp:create:database';
        $this->definition = array(
            new InputArgument('namespace', InputArgument::REQUIRED, 'The namespace of the ZyncroApp'),
        );
        $this->description = 'Create a new database for the given Zyncroapp';
        $this->help = 'The <info>zyncroapp:create:database</info> command will create the database, a user for that database and configure the "config.yml" file for the ZyncroApp.

This is an example of how to create the database for a ZyncroApp called <options=bold>FeaturedGroups</options=bold>:

    <info>php bin/console.php zyncroapp:create:database FeaturedGroups</info>';
        $this->execute = function (InputInterface $input, OutputInterface $output) {
            $args = $input->getArguments();
            $namespace = $args['namespace'];
            $appFolder = __DIR__ . '/../../../../../../src/' . $namespace;
            $configFilePath = $appFolder . '/Config/config.yml';

            $helper = new QuestionHelper();

            $question = new Question('<info>MySQL user which will execute the creation of the database and user: </info>');
            $mysqlUser = $helper->ask($input, $output, $question);

            $question = new Question('<info>Password for the MySQL user: </info>');
            $mysqlPassword = $helper->ask($input, $output, $question);

            $question = new Question('<info>Host of the MySQL server: </info>');
            $mysqlHost = $helper->ask($input, $output, $question);

            $question = new Question('<info>Port of the MySQL server: </info>');
            $mysqlPort = $helper->ask($input, $output, $question);

            if (!is_dir($appFolder) || !is_file($configFilePath)) {
                $output->writeln('<error>ZyncroApp with namespace ' . $args['namespace'] . ' is not found or doesn\'t have a config.yml file</error>');

                exit;
            }

            if (!$mysqlUser) {
                $output->writeln('<error>You must provide a MySQL user</error>');

                exit;
            }

            if (!$mysqlHost) {
                $output->writeln('<error>You must provide a MySQL host</error>');

                exit;
            }

            if (!$mysqlPort) {
                $output->writeln('<error>You must provide a MySQL port</error>');

                exit;
            }

            $result = $this->createDatabaseAndUser(strtolower($namespace), $mysqlUser, $mysqlPassword, $mysqlHost, $mysqlPort);

            if (!$result) {
                $output->writeln('<error>There was and error using MySQL with username "' . $mysqlUser . '" and password "' . $mysqlPassword . '"</error>');
            } else {
                $written = $this->writeConfigYmlFile($configFilePath, strtolower($namespace), $result);

                if ($written) {
                    $output->writeln('<info>Database and user created successfully. All the parameters are in the "config.yml" file.</info>');
                } else {
                    $output->writeln('<error>There was and error writting the configuration to the "config.yml" file</error>');
                }
            }
        };
    }

    private function createDatabaseAndUser($namespace, $mysqlUser, $mysqlPassword, $mysqlHost, $mysqlPort)
    {
        $password = $this->generateRandomPassword();

        $dbCreateCommand = "mysql -h $mysqlHost -P $mysqlPort -u $mysqlUser -p$mysqlPassword -e 'CREATE DATABASE $namespace;' 2> /dev/null";
        $userCreateCommand = "mysql -h $mysqlHost -P $mysqlPort -u $mysqlUser -p$mysqlPassword -e \"CREATE USER '$namespace'@'%' IDENTIFIED BY '$password';\" 2> /dev/null";
        $grantCommand = "mysql -h $mysqlHost -P $mysqlPort -u $mysqlUser -p$mysqlPassword -e \"GRANT ALL PRIVILEGES ON $namespace.* TO '$namespace'@'%';\" 2> /dev/null";

        $results = array();
        $return1 = $return2 = $return3 = null;

        exec($dbCreateCommand, $results, $return1);
        exec($userCreateCommand, $results, $return2);
        exec($grantCommand, $results, $return3);

        if (!$return1 && !$return2 && !$return3) {
            return $password;
        }

        return false;
    }

    private function generateRandomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;

        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        return implode($pass);
    }

    private function writeConfigYmlFile($filePath, $namespace, $password)
    {
        $content = 'database:' . PHP_EOL .
            '  driver: pdo_mysql' . PHP_EOL .
            '  host: localhost' . PHP_EOL .
            '  user: ' . $namespace . PHP_EOL .
            '  password: ' . $password . PHP_EOL .
            '  dbname: ' . $namespace;

        $file = fopen($filePath, 'w');
        $written = fwrite($file, $content);

        fclose($file);

        return $written !== false;
    }
}