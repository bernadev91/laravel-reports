# laravel-reports
Scaffolding to generate data reports in a unified way

This package is intended to make the creation of new reports faster and easier to maintain. To do so, it establishes an interface all reports must implement. With this library, when you need to create a new report, all you have to do is the following:

1. Create a route for it
2. Write a couple of class methods
3. Write a Blade template to render the results.

This class helps in the following ways:

1. Artisan command to create new reports. Just run `php artisan reports:generate` . It will ask for the details of the new report and it will create a class and a view for it.
2. Interface all report classes must implement with common methods.
3. Blade view that shows the list of filters. Using Bootstrap 5.
