@props(['city'])
<tr class="hover:bg-gray-300" x-data="{ show: true }">
        <td class="py-3">
            <p class="text-sm font-semibold text-gray-900">{{$city->id}}</p>
        </td>
        <td class="py-3 flex justify-center">
            <p x-show="show" class="text-sm text-gray-900">{{$city->name}}</p>

            <form x-show="!show" id="cities-update-form" class="flex">
                <input type="hidden" name="id" value="{{$city->id}}"/>
                <div>
                    <input class="border rounded-xl border-gray-400 p-2 mx-2" type="text" name="name" id="name"
                        value="{{ old('name') }}" required>

                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button @click="show = ! show" onclick="updateCity()" type="button" class="bg-blue-400 text-white rounded-full py-2 px-4 hover:bg-blue-500">
                        ✓
                    </button>
                </div>
            </form>
        </td>
        <td class="py-3">
            {{$city->arrivals}}
        </td>
        <td class="py-3">
            {{$city->departures}}
        </td>
        <td>
            <button @click="show = ! show" class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
                Edit
            </button>
        </td>
        <td>
            <form id="cities-delete-form">
                <input type="hidden" name="id" value="{{$city->id}}"/>
                <button onclick="deleteCity()" type="button" class="text-xs bg-red-400 text-white hover:bg-white hover:text-red-500 p-2 px-4 rounded-full">
                    Delete
                </button>
            </form>

        </td>
</tr>
