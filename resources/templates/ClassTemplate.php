<?php
namespace App\Reports;
use Bernadev\LaravelReports\ReportInterface;

class ClassTemplate implements ReportInterface
{
    private $filters = [];

    // Applies the filters according to the input. And if there's no input, 
    // it applies the default filters. Use $request->all() to send the current parameters
    public function __construct(array $input_data=array())
    {
        $this->filters = [

        ];
    }
    // Get the visual name of the report
    public function getName(): string
    {
        return '{report_name}';
    }
    // Optional small description or explanation
    public function getDescription(): string
    {
        return '{report_description}';
    }
    // Returns the blade view to use
    public function getView(): string
    {
        return '{report_view}';
    }
    // Returns the URL segment to use
    public function getSlug(): string
    {
        return '{report_slug}';
    }
    // Returns the list of filters applied
    public function getFilters(array $input_data=array()): array
    {
        return $this->filters;
    }
    // Generates the report
    public function generate(): array
    {
        $results = [

        ];

        return $results;
    }
}