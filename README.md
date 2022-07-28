# laravel-reports
Scaffolding to generate data reports in a unified way

To install, simply run the following command:

`composer require bernadev/laravel-reports`

This package is intended to make the creation of new reports faster and easier to maintain. To do so, it establishes an interface all reports must implement. With this library, when you need to create a new report, all you have to do is the following:

1. Create a route for it
2. Write a couple of class methods
3. Write a Blade template to render the results.

This class helps in the following ways:

1. Artisan command to create new reports. Just run `php artisan reports:generate` . It will ask for the details of the new report and it will create a class and a view for it.
2. Interface all report classes must implement with common methods.
3. Blade view that shows the list of filters. Using Bootstrap 5.

# Filtering

Example of how setting the filters work. You have to create an associative array where the key is the name of the field and it contains a set of properties.

- `name`: the name the user will see in the page.
- `value`: value given to the filter.
- `type`: type of filter. Possible values accepted so far:
  -  `date`: it will render a date-picker field. Depends on having this library available: https://github.com/uxsolutions/bootstrap-datepicker/blob/master/docs/index.rst and adding the picker to all elements with the class `.date-picker`

```
    public function __construct(array $input_data=array())
    {
        $this->filters = [
            'start_date' => ['name' => 'Start Date', 'value' => NULL, 'type' => 'date'],
            'end_date' => ['name' => 'End Date', 'value' => NULL, 'type' => 'date']
        ];

        if (Arr::get($input_data, 'start_date'))
        {
            $this->filters['start_date']['value'] = MY::parseDate($input_data['start_date'])->startOfDay();
        }
        else
        {
            $this->filters['start_date']['value'] = now()->subMonth()->startOfDay();
        }

        if (Arr::get($input_data, 'end_date'))
        {
            $this->filters['end_date']['value'] = MY::parseDate($input_data['end_date'])->endOfDay();
        }
        else
        {
            $this->filters['end_date']['value'] = now()->endOfDay();
        }
    }
```
 
 Example where we filter by a date range and by default the value is -1 month until today.
 
 # Controller
 
 The controller and the routing is managed by the developer. You have to make sure there's a route linking to the new report. In that controller/route, in order to load the report all you have to do is something like this:
 
 ```
 use Bernadev\LaravelReports\Loader;

public function generate($report, Request $request)
{
    $report = Loader::load($report, $request->all());

    $view_data['report'] = $report;
    $view_data['results'] = $report->generate();

    return view($report->getView(), $view_data);
}
```

1. Load the report by passing the "slug" field (set when creating the report).
2. Pass the report object and the results to the view
3. Render the view. We can use the getView() method to retrieve its location.
