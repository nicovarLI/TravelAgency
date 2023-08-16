<form x-show="show" id="airlines-update-form" class="flex-col mx-auto w-1/2 justify-center">
    <input type="hidden" name="id" x-model="airlineId"/>
    <h3 class="text-center text-xl mb-4 text-gray-600">Edit city</h3>
    <div class="flex flex-col">
        <span class="text-md pl-3 text-gray-500">Name</span>
        <input class="border rounded-xl border-gray-400 text-gray-600 p-2 mx-2" type="text" name="name" id="name"
            x-model="airlineName" x-text="airlineName" required>
        <span class="text-md pl-3 text-gray-500">Description</span>
        <input class="border border-gray-400 rounded-xl p-2 w-full" type="text" name="description" id="description"
            x-model="airlineDescription" x-text="airlineDescription">
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex justify-center mt-2">
        <button @click="show = ! show" type="button" class="flex mr-2 text-md justify-center rounded-full py-2 px-4 bg-red-400 text-white hover:bg-white action:bg-red-500r hover:text-red-500">
            ←
        </button>
        <button @click="show = ! show; updateAirline(airlineId)" type="button" class="flex justify-center rounded-full py-2 px-4 bg-blue-400 text-sm text-white hover:bg-white action:bg-red-500r hover:text-blue-500">
            Submit
        </button>
    </div>
</form>
