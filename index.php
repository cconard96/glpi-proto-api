<?php


use GlpiPlugin\API\Kernel;
use Symfony\Component\HttpFoundation\Request;

include_once '../../inc/includes.php';
$GLOBALS['API_AUTOLOADER'] = require __DIR__.'/vendor/autoload.php';

// Clear output from core since it doesn't consider this being in the API yet.
while (ob_get_level() > 0) {
   ob_end_clean();
}

$request = Request::createFromGlobals();

$kernel = new Kernel($_SERVER['APP_ENV'] ?? 'dev', (bool) ($_SERVER['APP_DEBUG'] ?? 1));

$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
