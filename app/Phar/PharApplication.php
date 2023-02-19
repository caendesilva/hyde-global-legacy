<?php

namespace App\Phar;

class PharApplication extends \Hyde\Foundation\Application
{
    protected $storagePath = TEMP_DIR.'/storage';

    /**
     * Get the path to the cached packages.php file.
     */
    public function getCachedPackagesPath(): string
    {
        // Since we have a custom path for the cache directory, we need to return it here.
        return TEMP_DIR.'/storage/framework/cache/packages.php';
    }
}
