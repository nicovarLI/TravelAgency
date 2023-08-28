<section class="px-6 py-8">
    <main class="max-w-lg w-1/2 mx-auto mt-4 bg-gray-100 p-6 rounded-xl border-gray-200">
        <h1 class="text-center font-bold text-xl">Create Flight</h1>
        <form id="add-flight-form">
            <div class="mb-6 mt-2">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" >
                    Airline
                </label>
                <select class="w-full" id="airline-select" name="airline_id">
                    <option value="">Select an airline</option>
                </select>
                <label class="block mt-2 mb-2 uppercase font-bold text-xs text-gray-700" >
                    Origin
                </label>
                <select class="w-full" id="origin-select" name="origin_city_id">
                    <option value="">Select an origin</option>
                </select>
                <label class="block mt-2 mb-2 uppercase font-bold text-xs text-gray-700" >
                    Destination
                </label>
                <select class="w-full" id="destination-select" name="destination_city_id">
                    <option value="">Select a destination</option>
                </select>
                <label class="block mb-2 mt-2 uppercase font-bold text-xs text-gray-700" for="departure_time">
                    Departure time
                </label>
                <input type="datetime-local" id="departure-date" class="px-2 border-gray-400 mb-2 border" name="departure_time" required>
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="arrival_time" >
                    Arrival time
                </label>
                <input type="datetime-local" id="arrival-date" class="px-2 border-gray-400 mb-2 border" name="arrival_time" required>
            </div>
            <div class="mb-6 flex justify-center">
                <button onclick="createFlight()" type="submit" class="bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 rounded-full py-2 px-4">
                    Submit
                </button>
            </div>
        </form>
    </main>
</section>
