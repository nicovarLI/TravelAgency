<section class="px-6 py-8">
    <main class="max-w-lg w-1/2 mx-auto mt-4 bg-gray-100 p-6 rounded-xl border-gray-200">
        <h1 class="text-center font-bold text-xl">Create City</h1>
        <form method="POST" action="/">
            @csrf
            <div class="mb-6 mt-2">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name">

                    Name
                </label>
                <input class="border border-gray-400 p-2 w-full" type="text" name="name" id="name"
                    value="{{ old('name') }}" required>

                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 flex justify-center">
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                    Submit
                </button>
            </div>
        </form>
    </main>
</section>
