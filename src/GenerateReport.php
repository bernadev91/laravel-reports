<?php

namespace Bernadev\LaravelReports;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $this->info('Generate a new report');

        // $name = $this->ask('Report name (to display to the user): ');
        // $slug = $this->ask('Report slug (no spaces and special characters): ');
        // $description = $this->ask('Report description/explanatory text (optional): ');
        // $view = $this->ask('Blade view that will render it: ');

        $name = 'Testing Report';
        $slug = 'testing-report';
        $description = '';
        $view = 'admin.reports.testing';

        $class_name = Str::of($slug)->studly();

        $path = app_path();

        $file_name = $path . DIRECTORY_SEPARATOR . 'Reports' . DIRECTORY_SEPARATOR . $class_name . '.php';

        $this->info($file_name);

        if (file_exists($file_name))
        {
            $yesno = $this->ask('The file already exists. Do you want to overwrite it? (y/n)');

            if (strtolower($yesno) != 'y')
            {
                $this->error('Aborted');
                return 1;
            }
        }

        $template = file_get_contents(__DIR__ . '/../resources/templates/ClassTemplate.php');

        $template = strtr($template, [
            'ClassTemplate' => $class_name,
            '{report_name}' => $name,
            '{report_description}' => $description,
            '{report_view}' => $view,
            '{report_slug}' => $slug
        ]);

        file_put_contents($file_name, $template);

        $this->info($class_name.' class created in '.$file_name);

        $view_file = resource_path() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $view) . '.blade.php';

        if (!file_exists($view_file))
        {
            $template = file_get_contents(__DIR__ . '/../resources/templates/view.blade.php');
            file_put_contents($view_file, $template);

            $this->info($view.' view created in '.$view_file);
        }

        return 0;
    }
}
