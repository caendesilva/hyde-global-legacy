<?php

namespace App\Commands;

use Hyde\Hyde;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class NewProjectCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'new {name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a new Hyde project';

    public function __construct()
    {
        parent::__construct();

        if (file_exists(Hyde::path('hyde'))) {
            $this->setHidden();
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $command = 'composer create-project hyde/hyde ' . escapeshellarg($this->argument('name')) . ' --stability=dev --ansi';        

        passthru($command, $exitCode);

        return $exitCode;
    }
}
