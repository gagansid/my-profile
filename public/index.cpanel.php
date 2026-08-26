<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Production entry point for cPanel: app lives outside public_html, so paths
// are absolute instead of relative (__DIR__.'/../...'). Deployed as
// public_html/index.php by .cpanel.yml — keep this in sync with $DEPLOYPATH there.
$appPath = '/home/gagc8689/repositories/my-profile-app';

if (file_exists($maintenance = $appPath . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

require $appPath . '/vendor/autoload.php';

/** @var Application $app */
$app = require_once $appPath . '/bootstrap/app.php';

$app->handleRequest(Request::capture());
