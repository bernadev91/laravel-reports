<?php
namespace Bernadev\LaravelReports;

interface ReportInterface {

    // Applies the filters according to the input. And if there's no input, it applies the default filters
    public function __construct(array $input_data=array());

    // Get the visual name of the report
    public function getName(): string;

    // Optional small description or explanation
    public function getDescription(): string;

    // Returns the blade view to use
    public function getView(): string;

    // Returns the URL segment to use
    public function getSlug(): string;

    // Returns the list of filters applied
    public function getFilters(): array;

    // Generates the report
    public function generate(): array;
}