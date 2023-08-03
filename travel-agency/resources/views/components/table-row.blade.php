@props(['city'])
<tr class="bg-gray-100">
        <td>
            <p class="text-sm font-semibold text-gray-900">{{$city->id}}</p>
        </td>
        <td>
            <p class="text-sm text-gray-900">{{$city->name}}</p>
        </td>
        <td>
            {{$city->arrivals}}
        </td>
        <td>
            {{$city->departures}}
        </td>
        <td>
            <button class="text-xs">
                Edit
            </button>
        </td>
        <td>
            <button class="text-xs">
                Delete
            </button>
        </td>
</tr>
