@props(['flights'])

@if (empty($flights))
    <x-empty-table-default/>
@endif
@foreach ($flights as $flight)
    <x-flight.table-row :flight="$flight" />
@endforeach
