@props(['cities'])

@if (empty($cities))
    <x-empty-table-default/>
@endif
@foreach ($cities as $city)
    <x-city.table-row :city="$city" />
@endforeach
