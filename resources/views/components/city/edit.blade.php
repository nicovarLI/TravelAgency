<form x-show="show" id="cities-update-form" class="flex-col mx-auto w-1/2 justify-center">
    <input type="hidden" name="id" x-model="cityId" />
    <h3 class="text-center text-xl mb-4 text-gray-600">Edit city</h3>
    <div class="flex flex-col">
        <span class="text-md pl-3 text-gray-500">Name</span>
        <x-form.input name="name" id="name" x-model="cityName" x-text="cityName" />
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <x-form.buttons :back-attributes="['@click' => 'show = !show']" :submit-attributes="['@click' => 'updateCity(cityId)']"/>
</form>
