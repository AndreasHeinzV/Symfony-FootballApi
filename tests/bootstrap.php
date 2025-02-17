<?php

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

$kernel = new App\Kernel('test', true);
$kernel->boot();

$application = new Application($kernel);
$application->setAutoExit(false);

$application->run(new ArrayInput([
    'command' => 'doctrine:database:drop',
    '--force' => true,
    '--env' => 'test',
    '--quiet' => true,
]));

$application->run(new ArrayInput([
    'command' => 'doctrine:database:create',
    '--env' => 'test',
    '--quiet' => true,
]));

$application->run(new ArrayInput([
    'command' => 'doctrine:schema:update',
    '--force' => true,
    '--env' => 'test',
    '--quiet' => true,
]));

$application->run(new ArrayInput([
    'command' => 'doctrine:fixtures:load',
    '--env' => 'test',
    '--no-interaction' => true,
    '--quiet' => true,
]));
