<?php

namespace Zyncro\Framework\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateController
{
    public $args;
    public $name;
    public $definition;
    public $description;
    public $help;
    public $execute;

    public function __construct()
    {
        $this->name = 'zyncroapp:createcontroller';
        $this->definition = array(
            new InputArgument('controller', InputArgument::REQUIRED, 'The name of the controller'),
            new InputArgument('namespace', InputArgument::REQUIRED, 'The name of the ZyncroApp'),
        );
        $this->description = 'Creates a new controller for a ZyncroApp';
        $this->help = 'The <info>zyncroapp:createcontroller</info> command will create a new controller file for the ZyncroApp specified.

This is an example of how to create a new controller called <options=bold>Auth</options=bold> for the <options=bold>Mention</options=bold> ZyncroApp:

    <info>php bin/console.php zyncroapp:createcontroller Auth Mention</info>';
        $this->execute = function (InputInterface $input, OutputInterface $output) {
            $this->execute($input->getArguments(), $output);
        };
    }

    public function execute($args, OutputInterface $output)
    {
        $name = $args['namespace'];
        $controller = $args['controller'];
        $appPath = __DIR__ . '/../../../../../../src/' . $name;

        if (is_dir($appPath)) {
            $controllerName = ucfirst($controller) . 'Controller';
            $controllerPath = $appPath . '/Controller/' . $controllerName . '.php';
            if (!is_file($controllerPath)) {
                $controllerCreated = $this->createController($controllerPath, basename($appPath), $controllerName);

                if ($controllerCreated) {
                    $output->writeln('');
                    $output->writeln('<info>The controller ' . $controllerName . ' for the ZyncroApp ' . $name . ' has been created</info>');
                    $output->writeln('');
                } else {
                    $output->writeln('');
                    $output->writeln('<error>There was an error creating the controller ' . $controllerName . ' in the ' . $name . 'ZyncroApp</error>');
                    $output->writeln('');
                }
            } else {
                $output->writeln('');
                $output->writeln('<error>There is already a controller ' . $controllerName . ' in the ' . $name . 'ZyncroApp</error>');
                $output->writeln('');
            }
        } else {
            $output->writeln('');
            $output->writeln('<error>ZyncroApp with namespace ' . $name . ' is not found</error>');
            $output->writeln('');
        }
    }

    private function createController($path, $zyncroapp, $name)
    {
        $content = '<?php' . PHP_EOL . PHP_EOL .
            'namespace ' . $zyncroapp . '\\Controller;' . PHP_EOL . PHP_EOL .
            'use Symfony\\Component\\HttpFoundation\\Response;' . PHP_EOL .
            'use Zyncro\\Framework\\App;' . PHP_EOL . PHP_EOL .
            'class ' . $name . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $file = fopen($path, 'w');
        $written = fwrite($file, $content);

        fclose($file);

        return $written !== false;
    }
}