@props(['flights'])

@forelse($flights as $flight)
    <x-flight.table-row :flight="$flight" />
@empty
    <x-empty-table-default/>
@endforelse
