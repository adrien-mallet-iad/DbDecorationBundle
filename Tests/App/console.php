<?php
// tests/App/console

namespace Iad\Bundle\DbDecorationBundle\Tests\App;

require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Bundle\FrameworkBundle\Console\Application;

$kernel = new AppKernel('dev', true);
$application = new Application($kernel);
$application->run();
