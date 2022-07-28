<form method="GET" action="{{ url()->current() }}">

    <div class="form-inline">

    @php $filters = $report->getFilters(); @endphp

    @foreach ($filters as $key => $filter)
        @if ($filter['type'] == 'date')
            <label for="{{ $key }}" class="me-2">{{ $filter['name'] }}: </label>
            <div class="input-daterange input-group date @error($key) is-invalid @enderror me-2">
                <input type="text" name="{{ $key }}" size="10" id="{{ $key }}" class="date-picker text-start form-control @error($key) is-invalid @enderror" value="{{ $filter['value'] ? Bernadev\LaravelReports\Helper::formatDate($filter['value']) : '' }}">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
        @else

        @endif
    @endforeach

    @if ($filters)
        <button type="submit" class="btn btn-primary me-2"><i class="fas fa-sync"></i> Regenerate Report</button>
    @endif

    </div>

    <hr class="my-4">
</form>