<x-layout>
    <script src="{{ asset('js/ajax-city-handler.js') }}" defer></script>
    <div  x-data="{ show: false, cityId: '', cityName: ''}" class="flex-1 px-20 h-full py-10">
        <section class="flex-col py-2 bg-gray-100 rounded-xl border justify-center">
            <x-city.table :cities="$cities" />
            <x-city.edit/>
            <x-pagination :data="$cities"/>
        </section>
        <x-city.create />
    </div>

</x-layout>
