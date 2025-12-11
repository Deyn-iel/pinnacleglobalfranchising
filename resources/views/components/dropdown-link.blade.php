<a {{ $attributes->merge([
    'class' =>
        'flex w-full items-center px-4 py-2 text-sm text-gray-700 
         hover:bg-gray-100 focus:bg-gray-100 rounded-md 
         transition duration-150 ease-in-out'
]) }}>
    {{ $slot }}
</a>
