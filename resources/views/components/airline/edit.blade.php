<form x-show="show" id="airlines-update-form" class="flex-col mx-auto w-1/2 justify-center">
    <input type="hidden" name="id" x-model="airlineId"/>
    <h3 class="text-center text-xl mb-4 text-gray-600">Edit airline</h3>
    <div class="flex flex-col">
        <span class="text-md pl-3 text-gray-500">Name</span>
        <x-form.input name="name" id="name" x-model="airlineName" x-text="airlineName" required />

        <span class="text-md pl-3 text-gray-500">Description</span>
        <x-form.input name="description" id="description" x-model="airlineDescription" x-text="airlineDescription" />
        <label class="block mt-2 mb-2 uppercase font-bold text-xs text-gray-700" >
            Cities
        </label>
        <select class="mx-auto" id="edit-city-select" name="edit-city-select"></select>
        <label class="block mt-2 mb-2 uppercase font-bold text-xs text-gray-700" >
            Locations
        </label>
        <select class="mx-auto" id="edit-location-select" name="edit-location-select"></select>
        <button onclick="deleteCityAirline(airlineId)"  @click= "updateAirline(airlineId)" id="delete-locations-button" type="button" hidden="true" class="bg-red-400 mt-2 text-xs text-white mx-auto hover:bg-white action:bg-red-500r hover:text-red-500 rounded-full py-2 px-4">
            Delete locations
        </button>
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
        <x-form.buttons :back-attributes="['@click' => 'show = !show']" :submit-attributes="['@click' => 'updateAirline(airlineId)']"/>


</form>
