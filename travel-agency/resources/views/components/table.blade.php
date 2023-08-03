@props(['cities'])

<section class="flex justify-center">
    <table class="w-1/2 text-center rounded-xl">
        <thead class="bg-blue-200">
            <tr>
                <th>Id</th>
                <th>City</th>
                <th>Arrivals</th>
                <th>Departures</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($cities as $city)
            <x-table-row :city="$city" />
            @endforeach
        </tbody>
    </table>
</section>
