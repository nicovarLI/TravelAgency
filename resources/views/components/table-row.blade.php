@props(['city'])
<tr class="hover:bg-gray-300" data-id="{{$city->id}}">
        <td class="py-3">
            <p class="text-sm font-semibold text-gray-900">{{$city->id}}</p>
        </td>
        <td class="py-3 flex justify-center">
            <p class="text-sm text-gray-900">{{$city->name}}</p>
        </td>
        <td class="py-3">
            {{$city->arrivals_count}}
        </td>
        <td class="py-3">
            {{$city->departures_count}}
        </td>
        <td>
            <button @click="show = true; cityName = '{{$city->name}}'; cityId = '{{$city->id}}'" class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
                Edit
            </button>
        </td>
        <td>
            <form id="cities-delete-form">
                <input type="hidden" name="id" value="{{$city->id}}"/>
                <button @click="show = false" onclick="deleteCity({{$city->id}})" type="button" class="text-xs bg-red-400 text-white hover:bg-white hover:text-red-500 p-2 px-4 rounded-full">
                    Delete
                </button>
            </form>
        </td>
</tr>
