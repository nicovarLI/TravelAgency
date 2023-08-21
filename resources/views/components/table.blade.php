<table class="w-full flex-1 text-center" id="main-table">
    <thead>
        <tr>
            {{ $headers }}
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-200 " id="table-body">
        {{ $slot }}
    </tbody>
</table>
