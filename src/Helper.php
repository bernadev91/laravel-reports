<?php
namespace Bernadev\LaravelReports;

use Illuminate\Support\Str;

class Helper {
    public static function formatDate($input)
    {
        return $input->format('d/m/Y');
    }
}