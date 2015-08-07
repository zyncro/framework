<?php

namespace Zyncro\Framework\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateZyncroApp
{
    public $name;
    public $definition;
    public $description;
    public $help;
    public $execute;

    public function __construct()
    {
        $this->name = 'zyncroapp:create';
        $this->definition = array(
            new InputArgument('name', InputArgument::REQUIRED, 'The name of the app'),
        );
        $this->description = 'Creates the file and folder structure for a new app';
        $this->help = 'The <info>zyncroapp:create</info> command will create the file and folder structure for a new app.

This is an example of how to create a new app called <options=bold>Mention</options=bold>:

    <info>php bin/console.php create:app Mention</info>';
        $this->execute = function (InputInterface $input, OutputInterface $output) {
            $this->execute($input->getArguments(), $output);
        };
    }

    public function execute($args, OutputInterface $output)
    {
        $name = $args['name'];
        $appPath = __DIR__ . '/../../../../../../src/' . $name;

        if (!is_dir($appPath)) {
            if (mkdir($appPath)) {
                $treeView = $this->createFilesAndFolders($appPath, $name);

                $output->writeln('');
                $output->writeln('<info>The ZyncroApp structure for ' . $name . ' has been created:</info>');
                $output->writeln('');
                $output->writeln($treeView);
            } else {
                $output->writeln('');
                $output->writeln('<error>The ZyncroApp folder cannot be created. Check permissions for creating a new folder in ' . $appPath . ' folder</error>');
                $output->writeln('');
            }
        } else {
            $output->writeln('');
            $output->writeln('<error>Another app with the same name (' . $name . ') already exists</error>');
            $output->writeln('');
        }
    }

    private function createFilesAndFolders($appPath, $name)
    {
        if (mkdir($appPath . '/Config') &&
            touch($appPath . '/Config/config.yml') &&
            touch($appPath . '/Config/routing.yml') &&
            touch($appPath . '/Config/security.yml') &&
            touch($appPath . '/Config/templates.yml') &&
            mkdir($appPath . '/Controller') &&
            touch($appPath . '/Controller/ExampleController.php') &&
            mkdir($appPath . '/Install') &&
            touch($appPath . '/Install/README.txt') &&
            mkdir($appPath . '/Model') &&
            touch($appPath . '/Model/ExampleModel.php') &&
            mkdir($appPath . '/Resources') &&
            mkdir($appPath . '/Resources/css') &&
            mkdir($appPath . '/Resources/img') &&
            mkdir($appPath . '/Resources/js') &&
            mkdir($appPath . '/Resources/tpl') &&
            mkdir($appPath . '/Views') &&
            touch($appPath . '/Views/example.html.twig') &&
            $this->createConfigConfigFiles($appPath . '/Config/config.yml') &&
            $this->createRoutingConfigFiles($appPath . '/Config/routing.yml', $name) &&
            $this->createSecurityConfigFiles($appPath . '/Config/security.yml', $name) &&
            $this->createTemplatesConfigFiles($appPath . '/Config/templates.yml') &&
            $this->createExampleController($appPath . '/Controller/ExampleController.php', $name) &&
            $this->createExampleModel($appPath . '/Model/ExampleModel.php', $name) &&
            $this->createExampleTemplate($appPath . '/Views/example.html.twig')
        ) {
            return $this->getTreeView($appPath);
        } else {
            return false;
        }
    }

    private function createConfigConfigFiles($path)
    {
        $content = 'database:' . PHP_EOL .
            '  driver: pdo_mysql' . PHP_EOL .
            '  host: localhost' . PHP_EOL .
            '  user: username' . PHP_EOL .
            '  password: password' . PHP_EOL .
            '  dbname: databasename' . PHP_EOL . PHP_EOL .
            'block1:' . PHP_EOL .
            '  parameter1: value1' . PHP_EOL .
            '  parameter2: value2' . PHP_EOL .
            '  parameter1: value3' . PHP_EOL . PHP_EOL .
            'block2:' . PHP_EOL .
            '  parameter4: value4' . PHP_EOL .
            '  parameter5: value5' . PHP_EOL .
            '  parameter6: value6';

        $file = fopen($path, 'w');
        $written = fwrite($file, $content);

        fclose($file);

        return $written !== false;
    }

    private function createRoutingConfigFiles($path, $name)
    {
        $content = 'route1:' . PHP_EOL .
            '  path: /' . strtolower($name) . '/route1' . PHP_EOL .
            '  defaults: { _controller: \'' . $name . '\Controller\ExampleController::route1Action\' }' . PHP_EOL . PHP_EOL .
            'route2:' . PHP_EOL .
            '  path: /' . strtolower($name) . '/route2/{parameter}' . PHP_EOL .
            '  defaults: { _controller: \'' . $name . '\Controller\ExampleController::route2Action\' }';

        $file = fopen($path, 'w');
        $written = fwrite($file, $content);

        fclose($file);

        return $written !== false;
    }

    private function createSecurityConfigFiles($path, $name)
    {
        $content = 'protected:' . PHP_EOL .
            '  routes: [route2]' . PHP_EOL .
            '  session: ' . $name . PHP_EOL .
            '  logged: route2' . PHP_EOL .
            '  not_logged: route1';

        $file = fopen($path, 'w');
        $written = fwrite($file, $content);

        fclose($file);

        return $written !== false;
    }

    private function createTemplatesConfigFiles($path)
    {
        $content = 'templates:' . PHP_EOL .
            '  - template1.tpl.html' . PHP_EOL .
            '  - template2.tpl.html' . PHP_EOL .
            '  - template3.tpl.html';

        $file = fopen($path, 'w');
        $written = fwrite($file, $content);

        fclose($file);

        return $written !== false;
    }

    private function createExampleController($path, $name)
    {
        $content = '<?php' . PHP_EOL . PHP_EOL .
            'namespace ' . $name . '\\Controller;' . PHP_EOL . PHP_EOL .
            'use Symfony\\Component\\HttpFoundation\\Response;' . PHP_EOL .
            'use Zyncro\\Framework\\App;' . PHP_EOL . PHP_EOL .
            'class ExampleController' . PHP_EOL .
            '{' . PHP_EOL .
            '    public function route1Action(App $app = null)' . PHP_EOL .
            '    {' . PHP_EOL .
            '        $twig = $app->container->get(\'twig\');' . PHP_EOL .
            '        $template = $twig->loadTemplate(\'example.html.twig\');' . PHP_EOL .
            '        $content = $template->render(array(\'zyncroapp\' => \'' . $name . '\'));' . PHP_EOL . PHP_EOL .
            '        return new Response($content);' . PHP_EOL .
            '    }' . PHP_EOL . PHP_EOL .
            '    public function route2Action(App $app = null, $parameter = null)' . PHP_EOL .
            '    {' . PHP_EOL .
            '        /* YOUR CODE HERE */' . PHP_EOL .
            '    }' . PHP_EOL .
            '}';

        $file = fopen($path, 'w');
        $written = fwrite($file, $content);

        fclose($file);

        return $written !== false;
    }

    private function createExampleModel($path, $name)
    {
        $content = '<?php' . PHP_EOL . PHP_EOL .
            'namespace ' . $name . '\\Model;' . PHP_EOL . PHP_EOL .
            'use Doctrine\DBAL\Connection;' . PHP_EOL . PHP_EOL .
            'class ExampleModel' . PHP_EOL .
            '{' . PHP_EOL .
            '    private $doctrine;' . PHP_EOL . PHP_EOL .
            '    public function __construct(Connection $doctrine)' . PHP_EOL .
            '    {' . PHP_EOL .
            '        $this->doctrine = $doctrine;' . PHP_EOL .
            '    }' . PHP_EOL .
            '}';

        $file = fopen($path, 'w');
        $written = fwrite($file, $content);

        fclose($file);

        return $written !== false;
    }

    private function createExampleTemplate($path)
    {
        $content = '<html>' . PHP_EOL .
            '    <head>' . PHP_EOL .
            '    </head>' . PHP_EOL .
            '    <body>' . PHP_EOL .
            '        <h1>This is an example template for the ZyncroApp {{ zyncroapp }}</h1>' . PHP_EOL .
            '    </body>' . PHP_EOL .
            '</html>';

        $file = fopen($path, 'w');
        $written = fwrite($file, $content);

        fclose($file);

        return $written !== false;
    }

    private function getTreeView($path)
    {
        $result = basename($path) . PHP_EOL;

        if (is_dir($path)) {
            $folders = glob($path . '/*', GLOB_ONLYDIR);
            $countFolders = count($folders);
            $i = 1;

            foreach ($folders as $folder) {
                if ($i < $countFolders) {
                    $result .= '├── ' . basename($folder) . PHP_EOL;
                } else {
                    $result .= '└── ' . basename($folder) . PHP_EOL;
                }

                $files = glob($folder . '/*');
                $subfolders = glob($folder . '/*', GLOB_ONLYDIR);
                $countSubFolders = count($subfolders);
                $j = 1;

                foreach ($subfolders as $subfolder) {
                    if ($j < $countSubFolders) {
                        $result .= '|   ├── ' . basename($subfolder) . PHP_EOL;
                    } else {
                        $result .= '|   └── ' . basename($subfolder) . PHP_EOL;
                    }

                    $j++;
                }

                $countFiles = count($files);
                $j = 1;

                foreach ($files as $file) {
                    if ($j < $countFiles) {
                        if (is_file($file)) {
                            $result .= '|   ├── ' . basename($file) . PHP_EOL;
                        }
                    } else {
                        if (is_file($file)) {
                            if ($i < $countFolders) {
                                $result .= '|   └── ' . basename($file) . PHP_EOL;
                            } else {
                                $result .= '    └── ' . basename($file) . PHP_EOL;
                            }
                        }
                    }

                    $j++;
                }

                $i++;
            }
        }


        return $result;
    }
}