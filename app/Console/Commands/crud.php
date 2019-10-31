<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class crud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {name : Class (singular), e.g User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD Serivice';

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
        $name = ucfirst($name);
        $fields = [];
        $field = null;
        do {
            $field = $this->ask('Enter Database field (fieldName type)');
            if ($field != null || $field != '') {
                array_push($fields, $field);
            }
        } while ($field != null);

        $dbFields = "";
        $casts = "";
        $fillable = "";
        $migrations = "";
        $vueTableFields = "";
        if (count($fields) > 0) {
            foreach ($fields as $field) {
                $splitString = explode(" ", $field);
                $dbFields .= "[ 'key' => '$splitString[0]', 'caption' => '" . Str::title($splitString[0]) . "', 'htmlElement' => 'text', 'type' => 'text' ],\n";
                $casts .= '\'' . $splitString[0] . '\'' . '=>' . '\'' . $splitString[1] . '\'' . ",\n";
                $fillable .= '\'' . $splitString[0] . '\',';
                $migrations .= "\$table->$splitString[1]('$splitString[0]');\n";
                $vueTableFields .= "{key: '$splitString[0]', sortable: true},";
            }

            $this->model($name, $casts, $fillable);
            $this->info('Model created at app/Models/' . $name);

            $this->controller($name, $fillable, $dbFields);
            $this->info('Controller created at app/Http/Controllers/' . $name . 'Controller.php');

            $this->call('make:request', [
                'name' => 'Store' . $name,
            ]);

            $this->call('make:request', [
                'name' => 'Update' . $name,
            ]);

            $this->call('make:factory', [
                'name' => $name . 'Factory',
            ]);

            $this->call('make:seed', [
                'name' => $name . 'Seeder',
            ]);

            $this->migration($name, $migrations);
            $this->info('Migration created');

            $this->view($name);
            $this->vueTable($name, $vueTableFields);
            $this->info('View created');

            File::append(base_path('routes/web.php'), 'Route::resource(\'' . Str::slug(Str::plural(strtolower($name))) . "', '{$name}Controller')->except(['destroy', 'edit']);");
            File::append(base_path('routes/api.php'), 'Route::get(\'/' . Str::slug(Str::plural(strtolower($name))) . "', '{$name}Controller@list');\n");
            File::append(base_path('routes/api.php'), 'Route::delete(\'/' . Str::slug(Str::plural(strtolower($name))) . "/{id}', '{$name}Controller@destroy');");
            File::append(base_path('resources/js/vueComponents.js'), "Vue.component('" . strtolower($name) . "-list', require('./components/" . strtolower($name) . "/list.vue').default);\n");
        } else {
            $this->info('Resource for CRUD not created');
        }
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function model($name, $casts = '', $fillable = '')
    {
        $modelTemplate = str_replace(
            ['{{modelName}}', '{{ casts }}', '{{ fillable }}'],
            [$name, $casts, $fillable],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
    }

    protected function controller($name, $searchable, $dbFields = '')
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{ searchable }}',
                '{{ fields }}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name),
                $searchable,
                $dbFields
            ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function migration($name, $migrations)
    {
        $migrationTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{ migrations }}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                $migrations
            ],
            $this->getStub('Migration')
        );

        $now = Carbon::now();

        $migrationName = 'database/migrations/' . $now->format('Y_m_d_') . time() . '_create_' . strtolower(Str::plural($name)) . '_table.php';

        file_put_contents(base_path($migrationName), $migrationTemplate);
    }

    protected function view($name)
    {
        $indexFolder = base_path('resources/views/' . strtolower($name));

        if (!file_exists($indexFolder)) {
            mkdir($indexFolder, 0777, true);
        }

        $viewIndexTemplate = str_replace(
            [
                '{{modelNamePlural}}',
                '{{modelNameSingularLowerCase}}',
            ],
            [
                Str::plural($name),
                strtolower($name),
            ],
            $this->getStub('ViewIndex')
        );

        file_put_contents(base_path('resources/views/' . strtolower($name) . '/index.blade.php'), $viewIndexTemplate);

        $viewCreateTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}',
            ],
            [
                $name,
                Str::plural($name),
                strtolower(Str::plural($name)),
            ],
            $this->getStub('ViewCreate')
        );

        file_put_contents(base_path('resources/views/' . strtolower($name) . '/create.blade.php'), $viewCreateTemplate);

        $viewShowTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNamePlural}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                Str::plural($name),
                strtolower($name)
            ],
            $this->getStub('ViewShow')
        );

        file_put_contents(base_path('resources/views/' . strtolower($name) . '/show.blade.php'), $viewShowTemplate);
    }

    protected function vueTable($name, $vueTableFields)
    {
        $vueTableFolder = base_path('resources/js/components/' . strtolower($name));

        if (!file_exists($vueTableFolder)) {
            mkdir($vueTableFolder, 0777, true);
        }

        $vueTableTemplate = str_replace(
            [
                '{{modelNamePluralLowerCase}}',
                '{{ tableFields }}'
            ],
            [
                strtolower(Str::plural($name)),
                $vueTableFields
            ],
            $this->getStub('VueList')
        );

        $vueTableLocation = 'resources/js/components/' . strtolower($name) . '/list.vue';

        file_put_contents(base_path($vueTableLocation), $vueTableTemplate);
    }

    protected function request($name)
    {
        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Request')
        );

        if (!file_exists($path = app_path('/Http/Requests'))) {
            mkdir($path, 0777, true);
        }

        file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $requestTemplate);
    }
}
