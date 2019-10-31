<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class crudRollback extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:rollback {name : Class (singular), e.g User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Roll back crud service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        // Delete Controller
        $controller = 'app/Http/Controllers/' . $name . 'Controller.php';
        if (file_exists($controller)) {
            unlink(base_path($controller));
        }

        // Delete Model
        $model = 'app/Models/' . $name . '.php';
        if (file_exists($model)) {
            unlink(base_path($model));
        }

        // Delete Factory
        $factory = 'database/factories/' . $name . 'Factory.php';
        if (file_exists($factory)) {
            unlink(base_path($factory));
        }

        // Delete StoreRequest
        $storeRequest = 'app/Http/Requests/Store' . $name . '.php';
        $updateRequest = 'app/Http/Requests/Update' . $name . '.php';
        if (file_exists($storeRequest)) {
            unlink(base_path($storeRequest));
        }

        if (file_exists($updateRequest)) {
            unlink(base_path($updateRequest));
        }


        $viewsDirname = base_path('resources/views/' . strtolower($name) . '/*.*');
        array_map('unlink', glob($viewsDirname));
        rmdir($viewsDirname);

        $vueDirname = base_path('resources/js/components/' . strtolower($name) . '/*.*');
        array_map('unlink', glob($vueDirname));
        rmdir($vueDirname);

        $this->info('Please delete the migration manualy');
    }
}
