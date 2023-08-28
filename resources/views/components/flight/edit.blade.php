<form x-show="show" id="flight-update-form" class="flex-col mx-auto w-1/2 justify-center">
    <input type="hidden" name="id" x-model="flightId" />
    <h3 class="text-center text-xl mb-4 text-gray-600">Edit flight</h3>
    <div class="mb-6 mt-2">
        <label class="block mb-2 mt-2 uppercase font-bold text-xs text-gray-700" for="departure_time">
            Departure time
        </label>
        <input type="datetime-local" x-model="departureTime" x-text="departureTime" id="departure-date" class="px-2 border-gray-400 mb-2 border" name="departure_time" required>
        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="arrival_time" >
            Arrival time
        </label>
        <input type="datetime-local" x-model="arrivalTime" x-text="arrivalTime" id="arrival-date" class="px-2 border-gray-400 mb-2 border" name="arrival_time" required>
    </div>
    <x-form.buttons :back-attributes="['@click' => 'show = !show']" :submit-attributes="['@click' => 'updateFlight(flightId)']"/>
</form>
