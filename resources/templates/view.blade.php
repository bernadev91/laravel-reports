<h1>{{ $report->getName() }}</h1>

@if ($report->getDescription())
    <p>{!! $report->getDescription() !!}</p>
@endif

@include('bernadev::filtering')

@if ($results)
    {{-- Render your results here --}}
@else
    No data to display yet
@endif