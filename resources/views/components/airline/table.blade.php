@props(['airlines'])
<x-table>
    <x-slot name="headers">
            <th class="py-2">ID</th>
            <th class="py-2">Airline</th>
            <th class="py-2">Description</th>
            <th class="py-2">Flights</th>
            <th class="py-2"></th>
            <th class="py-2"></th>
    </x-slot>
    <x-airline.body :airlines="$airlines"/>
</x-table>
