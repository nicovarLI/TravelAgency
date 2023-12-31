<section class="px-6 py-8">
    <main class="max-w-lg w-1/2 mx-auto mt-4 bg-gray-100 p-6 rounded-xl border-gray-200">
        <h1 class="text-center font-bold text-xl">Create City</h1>
        <form id="add-city-form">
            <div class="mb-6 mt-2">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name">

                    Name
                </label>
                <input class="border border-gray-400 rounded-xl p-2 w-full" type="text" name="name" id="name" required>
                <span id="name-error" class="text-red-500 text-xs mt-1"></span>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 flex justify-center">
                <button onclick="createCity()" type="submit" class="bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 rounded-full py-2 px-4">
                    Submit
                </button>
            </div>
        </form>
    </main>
</section>
