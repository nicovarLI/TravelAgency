@props(['backAttributes', 'submitAttributes'])

<div class="flex justify-center mt-2">
    <button {{ $attributes->merge(array_merge(['type' => 'button', 'class' => 'flex mr-2 text-md justify-center rounded-full py-2 px-4 bg-red-400 text-white hover:bg-white action:bg-red-500r hover:text-red-500'], $backAttributes)) }}>
        ←
    </button>
    <button {{ $attributes->merge(array_merge(['type' => 'button', 'class' => 'flex justify-center rounded-full py-2 px-4 bg-blue-400 text-sm text-white hover:bg-white action:bg-red-500r hover:text-blue-500'], $submitAttributes)) }}>
        Submit
    </button>
</div>
