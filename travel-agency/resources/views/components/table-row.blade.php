@props(['city'])
<tr class="hover:bg-gray-300">
        <td class="py-3">
            <p class="text-sm font-semibold text-gray-900">{{$city->id}}</p>
        </td>
        <td class="py-3">
            <p class="text-sm text-gray-900">{{$city->name}}</p>
        </td>
        <td class="py-3">
            {{$city->arrivals}}
        </td>
        <td class="py-3">
            {{$city->departures}}
        </td>
        <td>
            <button class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
                Edit
            </button>
        </td>
        <td>
            <form method="POST" action="/">
                @method('DELETE')
                @csrf
                <input type="hidden" name="id" value="{{$city->id}}"/>
                <button type="submit"class="text-xs bg-red-400 text-white hover:bg-white hover:text-red-500 p-2 px-4 rounded-full">
                    Delete
                </button>
            </form>

        </td>
</tr>
