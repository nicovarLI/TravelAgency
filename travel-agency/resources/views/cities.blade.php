<x-layout>
    <script src="{{ asset('js/ajax-post.js') }}" defer></script>
    <div class="flex-1 px-20 h-full py-10">
        <x-table :cities="$cities"/>
        <x-city.create/>
    </div>

</x-layout>
