@props(['airlines'])

@if (empty($airlines))
    <x-empty-table-default/>
@endif
@foreach ($airlines as $airline)
    <x-airline.table-row :airline="$airline" />
@endforeach
