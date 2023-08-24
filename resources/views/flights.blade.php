<x-layout>
    <script src="{{ asset('js/ajax-flight-handler.js') }}" defer></script>
    <div  x-data="{ show: false, flightId: ''}" class="flex-1 px-20 h-full py-10">
        <section class="flex-col py-2 bg-gray-100 rounded-xl border justify-center">
            <x-flight.table :flights="$flights" />
            <x-flight.edit/>
            <x-pagination :data="$flights"/>
        </section>
        <x-flight.create />
    </div>
</x-layout>