<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User-Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome! " . Auth::user()->name) }}
                </div>
            </div>
        </div>
        <!-- BUTTON SECTION -->
<div class="max-w-4xl mx-auto mt-8 px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <a href="{{ route('ordering.supplies') }}"
        class="block w-full px-6 py-4 bg-blue-600 text-white font-semibold rounded-lg shadow-md
               hover:bg-green-700 hover:shadow-lg transition-all duration-200 text-center">
        Ordering of Supplies to Registered Partners
    </a>
</div>
<!-- END BUTTON SECTION -->

    </div>

</x-app-layout>
