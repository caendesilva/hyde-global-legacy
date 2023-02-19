<?php

// To allow the binary to be used anywhere, we define a temporary directory that Laravel can use to store compiled views and other cache files.
define('TEMP_DIR', (sys_get_temp_dir() . '/hyde-'. md5(dirname(__DIR__))));
// This is the directory that the binary is being run from.
define('WORK_DIR', getcwd());

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new \Hyde\Foundation\Application(
    WORK_DIR
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    \Hyde\Foundation\ConsoleKernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Illuminate\Foundation\Exceptions\Handler::class
);

// Bind Phar helpers

// Merge config data when config repository is instantiated
$app->afterBootstrapping(Hyde\Foundation\Internal\LoadConfiguration::class, function () {
    config()->set('view.compiled', TEMP_DIR . '/views');
});

/*
|--------------------------------------------------------------------------
| Set Important Hyde Configurations
|--------------------------------------------------------------------------
|
| Now, we create a new instance of the HydeKernel, which encapsulates
| our Hyde project and provides helpful methods for interacting with it.
| Then, we bind the kernel into the application service container.
|
*/

$hyde = new \Hyde\Foundation\HydeKernel(
    WORK_DIR
);

$app->singleton(
    \Hyde\Foundation\HydeKernel::class, function () {
        return \Hyde\Foundation\HydeKernel::getInstance();
    }
);

\Hyde\Foundation\HydeKernel::setInstance($hyde);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
