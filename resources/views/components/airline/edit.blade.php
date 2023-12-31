<form x-show="show" id="airlines-update-form" class="flex-col mx-auto w-1/2 justify-center">
    <input type="hidden" name="id" x-model="airlineId"/>
    <h3 class="text-center text-xl mb-4 text-gray-600">Edit airline</h3>
    <div class="flex flex-col">
        <span class="text-md pl-3 text-gray-500">Name</span>
        <x-form.input name="name" id="name" x-model="airlineName" x-text="airlineName" required />

        <span class="text-md pl-3 text-gray-500">Description</span>
        <x-form.input name="description" id="description" x-model="airlineDescription" x-text="airlineDescription" />
        <span class="text-md pl-3 text-gray-500">Add locations</span>
        <select class="mx-auto" style="width: 100%" id="edit-city-select" name="edit-city-select"></select>
        <span class="text-md pl-3 text-gray-500">Remove locations</span>
        <select class="mx-auto" style="width: 100%" id="edit-location-select" name="edit-location-select"></select>
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
        <x-form.buttons :back-attributes="['@click' => 'show = !show']" :submit-attributes="['@click' => 'updateAirline(airlineId)']"/>


</form>
