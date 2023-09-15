<section class="px-6 py-8">
    <div id="app">
        <create-flight></create-flight>
    </div>
</section>

<script type="text/x-template" id="create-flight">
        <main class="max-w-lg w-1/2 mx-auto mt-4 bg-gray-100 p-6 rounded-xl border-gray-200">
            <h1 class="text-center font-bold text-xl">Create Flight</h1>
            <form id="add-flight-form" @submit.prevent="triggerCreate">
                <div class="mb-6 mt-2">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700">Airline</label>
                    <select class="w-full" id="airline-select" name="airline_id">
                        <option value="">Select an airline</option>
                    </select>
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700">Origin</label>
                    <select class="w-full" id="origin-select" name="origin_city_id">
                        <option value="">Select an origin</option>
                    </select>
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700">Destination</label>
                    <select class="w-full" id="destination-select" name="destination_city_id">
                        <option value="">Select a destination</option>
                    </select>
                    <label class="block mb-2 mt-2 uppercase font-bold text-xs text-gray-700" for="departure_at">Departure at</label>
                    <input type="datetime-local" id="departure-at" name="departure_at" class="px-2 border-gray-400 mb-2 border" required/>
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="arrival_at">Arrival at</label>
                    <input type="datetime-local" id="arrival-at" name="arrival_at" class="px-2 border-gray-400 mb-2 border" required/>
                </div>
                <div class="mb-6 flex justify-center">
                    <button type="submit" class="bg-blue-400 text-white hover:bg-white hover:text-blue-500 rounded-full py-2 px-4">
                        Submit
                    </button>
                </div>
            </form>
        </main>
</script>

<script>
    const createComponent = {
        template: '#create-flight',
        data() {
            return {};
        },
        methods: {
            triggerCreate(){
                createFlight();
            }
        }
    };

    const { createApp } = Vue
    createApp({
        components: {
            'create-flight': createComponent,
        },
    }).mount('#app');
</script>
