@props(['flight'])
<tr class="hover:bg-gray-300" data-id="{{$flight->id}}">
        <td class="py-3">
            <p class="text-sm font-semibold text-gray-900">{{$flight->id}}</p>
        </td>
        <td class="py-3 justify-center">
            <p class="text-sm text-gray-900">{{$flight->originCity->name}}</p>
        </td>
        <td class="py-3 justify-center">
            <p class="text-sm text-gray-900">{{$flight->destinationCity->name}}</p>
        </td>
        <td class="py-3 justify-center">
            <p class="text-sm text-gray-900">{{$flight->airline->name}}</p>
        </td>
        <td class="py-3">
            {{$flight->departure_time}}
        </td>
        <td class="py-3">
            {{$flight->arrival_time}}
        </td>
        <td>
            <button @click="show = true; loadFlightSelects('{{$flight->airline->id}}','{{$flight->originCity->id}}','{{$flight->destinationCity->id}}'); flightId = '{{$flight->id}}'; departureTime = '{{$flight->departure_time}}'; arrivalTime = '{{$flight->arrival_time}}';" class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
                Edit
            </button>
        </td>
        <td>
            <form id="flights-delete-form">
                <button @click="show = false" onclick="deleteFlight({{$flight->id}})" type="button" class="text-xs bg-red-400 text-white hover:bg-white hover:text-red-500 p-2 px-4 rounded-full">
                    Delete
                </button>
            </form>
        </td>
</tr>
