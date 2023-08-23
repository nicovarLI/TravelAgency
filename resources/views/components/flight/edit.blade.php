<form x-show="show" id="flight-update-form" class="flex-col mx-auto w-1/2 justify-center">
    <input type="hidden" name="id" x-model="flightId" />
    <h3 class="text-center text-xl mb-4 text-gray-600">Edit flight</h3>
    <div class="flex flex-col">
        <span class="text-md pl-3 text-gray-500">Origin</span>
    </div>
    <x-form.buttons :back-attributes="['@click' => 'show = !show']" :submit-attributes="['@click' => 'updateFlight(flightId)']"/>
</form>
