<?php
namespace Bernadev\LaravelReports;

use Illuminate\Support\Str;

class Loader {
    public static function load($slug, $input_data)
    {
        $class_name = '\App\Reports\\' . Str::of($slug)->studly();

        if (!class_exists($class_name))
        {
            abort(404, 'The report you requested doesn\'t seem to be in the system');
        }

        $report = new $class_name($input_data);

        return $report;
    }
}