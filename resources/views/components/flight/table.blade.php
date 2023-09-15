@props(['flights'])
<x-table>
    <x-slot name="headers">
            <th class="py-2">ID</th>
            <th class="py-2">Origin</th>
            <th class="py-2">Destination</th>
            <th class="py-2">Airline</th>
            <th class="py-2">Departure</th>
            <th class="py-2">Arrival</th>
            <th class="py-2"></th>
            <th class="py-2"></th>
    </x-slot>
    <x-flight.body :flights="$flights"/>
</x-table>
