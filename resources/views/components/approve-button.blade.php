<button {{ $attributes->
    merge(['type' => 'submit', 'class' => 'inline-flex items-center px-2 py-2
    bg-green-800 border border-transparent rounded-md font-semibold text-xs
    text-white uppercase tracking-wide hover:bg-green-700 active:bg-green-900
    focus:outline-none focus:border-green-900 focus:ring ring-green-300
    disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
