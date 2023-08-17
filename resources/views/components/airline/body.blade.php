@props(['airlines'])

@if (empty($airlines))
    <tr>
        <td class="py-2">
            <p class="text-gray-400 text-sm">Id</p>
        </td>
        <td class="py-2">
            <p class="text-gray-400 text-sm">Airline</p>
        </td>
        <td class="py-2">
            <p class="text-gray-400 text-sm">Description</p>
        </td>
        <td class="py-2">
            <p class="text-gray-400 text-sm">Flights</p>
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
@foreach ($airlines as $airline)
    <x-airline.table-row :airline="$airline" />
@endforeach
