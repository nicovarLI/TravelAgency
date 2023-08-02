<!doctype html>

<title>Travel Agency</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    html {
        scroll-behavior: smooth;
    }
</style>
<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="" alt="Travel Agency" width="165" height="16">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @auth
                <span class="text-xs font-bold uppercase">Welcome, User</span>

                <form method="POST" action="/logout" class="text-xs font-semibold text-white ml-6 span-10 bg-red-500 py-2 px-3 rounded-xl">
                    @csrf

                    <button type="submit">Log Out</button>
                </form>
                @else
                    <a href="/register" class="text-xs font-bold uppercase">Register</a>
                    <a href="/login" class="text-xs font-semibold text-white ml-6 span-10 py-2 px-3 rounded-xl">Log In</a>
                @endauth
            </div>
        </nav>
        <div class="bg-gray-50">
            {{ $slot }}
        </div>


        <footer id="newsletter" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <p class="text-sm mt-3">Travel Safe</p>
            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">
                </div>
            </div>
        </footer>
    </section>
</body>
