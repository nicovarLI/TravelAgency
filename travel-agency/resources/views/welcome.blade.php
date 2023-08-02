<x-layout>
    <div class="h-full flex bg-white-500 mx-4 justify-center">
        <div class="mx-4 flex justify-center bg-blue-500 w-1/2">
            <table class="divide-y divide-gray-100 flex-1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>City</th>
                        <th>Incoming</th>
                        <th>Outgoing</th>
                    </tr>

                </thead>

                <tbody>

                    <x-list-item />
                    <x-list-item />
                    <x-list-item />
                    <x-list-item />
                    <x-list-item />
                </tbody>

                {{-- <ul role="list" class="divide-y divide-gray-100 flex-1">

                </ul> --}}
            </table>

        </div>

    </div>
</x-layout>
