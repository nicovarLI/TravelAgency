<x-layout>
    <script src="{{ asset('js/ajax-post.js') }}" defer></script>
    <div class="flex-1 px-20 h-full py-10">
        <section class="flex py-2 bg-gray-100 rounded-xl border justify-center">
            <x-table :cities="$cities" />
        </section>
        <x-city.create />
    </div>

</x-layout>
