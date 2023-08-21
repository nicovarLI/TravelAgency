@props(['cities'])

@if (empty($cities))
    <tr>
        <td class="py-2">
            <p class="text-gray-400 text-sm">Id</p>
        </td>
        <td class="py-2">
            <p class="text-gray-400 text-sm">City</p>
        </td>
        <td class="py-2">
            <p class="text-gray-400 text-sm">Arrivals</p>
        </td>
        <td class="py-2">
            <p class="text-gray-400 text-sm">Departures</p>
        </td>
        <td>
            <button class="text-xs bg-gray-200 text-gray-400 p-2 px-4 rounded-full">
                Edit
            </button>
        </td>
        <td>
            <button class="text-xs bg-gray-200 text-gray-400 p-2 px-4 rounded-full">
                Delete
            </button>
        </td>
    </tr>
@endif
@foreach ($cities as $city)
    <x-city.table-row :city="$city" />
@endforeach
