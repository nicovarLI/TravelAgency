@props(['cities'])
<x-table>
    <x-slot name="headers">
            <th class="py-2">ID</th>
            <th class="py-2">City</th>
            <th class="py-2">Arrivals</th>
            <th class="py-2">Departures</th>
            <th class="py-2"></th>
            <th class="py-2"></th>
    </x-slot>
    <x-city.body :cities="$cities"/>
</x-table>
