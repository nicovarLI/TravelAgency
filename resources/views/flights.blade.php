<x-layout>
    <script src="{{ asset('js/ajax-flight-handler.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <div  x-data="{ show: false, flightId: '', departureTime: '', arrivalTime: ''}" class="flex-1 px-20 h-full py-10">
        <section class="flex-col py-2 bg-gray-100 rounded-xl border justify-center">
            <x-flight.table :flights="$flights" />
            <x-flight.edit/>
            <x-pagination :data="$flights"/>
        </section>
        <x-flight.create />
    </div>
</x-layout>
