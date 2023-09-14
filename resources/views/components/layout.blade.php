<!doctype html>

<title>{{ config('app.name') }}</title>

<link rel="preconnect" href="https://fonts.gstatic.com">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-3 py-4">
        <nav class="md:flex md:justify-between md:items-center">
            <div class="px-10 flex flex-1 justify-around">
                <a href="/flights">
                    <img src="/images/airplane.svg" alt="Flights" width="50" height="5">
                </a>
                <a href="/cities">
                    <img src="/images/city.svg" alt="Cities" width="50" height="5">
                </a>
                <a href="/airlines">
                    <img src="/images/airline.svg" alt="Airlines" width="50" height="5">
                </a>
            </div>
        </nav>
        <div id="main-content">
            <script src="{{ asset('js/utils.js')}}"></script>
            {{ $slot }}
        </div>


        <footer id="newsletter"
        class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
        <p class="text-sm mt-3">Travel Safe</p>
        <div class="mt-10">
            <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">
            </div>
        </div>
    </footer>
</section>
<div class="fixed bottom-5 right-5 z-50">
    <div id="toast" class="p-4 bg-blue-500 text-white rounded-md shadow-lg hidden">
        <div id="toast-message"></div>
    </div>
</div>
</body>
