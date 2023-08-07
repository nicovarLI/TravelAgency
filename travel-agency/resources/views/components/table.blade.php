@props(['cities'])

<section class="flex py-2 bg-gray-100 rounded-xl border justify-center">
    <table class="w-4/5 flex-1 text-center" id="cities-table">
        <thead>
            <tr>
                <th class="py-2">Id</th>
                <th class="py-2">City</th>
                <th class="py-2">Arrivals</th>
                <th class="py-2">Departures</th>
                <th class="py-2"></th>
                <th class="py-2"></th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @if (!count($cities) > 0)
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
                <x-table-row :city="$city" />
            @endforeach
        </tbody>
    </table>
</section>
