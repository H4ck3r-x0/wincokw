<button {{ $attributes->
    merge(['type' => 'submit', 'class' => 'inline-flex items-center px-2 py-2
    bg-red-800 border border-transparent rounded-md font-semibold text-xs
    text-white uppercase tracking-wide hover:bg-red-700 active:bg-red-900
    focus:outline-none focus:border-red-900 focus:ring ring-red-300
    disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
