<x-layout>
    <script src="{{ asset('js/ajax-airline-handler.js') }}" defer></script>
    <div  x-data="{ show: false, airlineId: '', airlineName: '', airlineDescription: ''}" class="flex-1 px-20 h-full py-10">
        <section class="flex-col py-2 bg-gray-100 rounded-xl border justify-center">
            <x-airline.table :airlines="$airlines" />
            <x-airline.edit/>
            <x-pagination :data="$airlines"/>
        </section>
        <x-airline.create />
    </div>

</x-layout>
