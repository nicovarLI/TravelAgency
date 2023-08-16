@props(['airline'])
<tr class="hover:bg-gray-300" data-id="{{$airline->id}}">
        <td class="py-3">
            <p class="text-sm font-semibold text-gray-900">{{$airline->id}}</p>
        </td>
        <td class="py-3 flex justify-center">
            <p class="text-sm text-gray-900">{{$airline->name}}</p>
        </td>
        <td class="py-3">
            {{$airline->description}}
        </td>
        <td class="py-3">
            {{$airline->flights_count}}
        </td>
        <td>
            <button @click="show = true; airlineName = '{{$airline->name}}'; airlineId = '{{$airline->id}}'" class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
                Edit
            </button>
        </td>
        <td>
            <form id="airline-delete-form">
                <input type="hidden" name="id" value="{{$airline->id}}"/>
                <button @click="show = false" onclick="deleteCity({{$airline->id}})" type="button" class="text-xs bg-red-400 text-white hover:bg-white hover:text-red-500 p-2 px-4 rounded-full">
                    Delete
                </button>
            </form>
        </td>
</tr>
