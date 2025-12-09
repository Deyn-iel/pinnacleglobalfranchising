<aside id="sidebar"
    class="fixed inset-y-0 left-0 w-94 bg-gray-900 text-white min-h-screen transform -translate-x-full 
           md:translate-x-0 transition-transform duration-300 z-50">

    <div class="p-6 text-2xl font-bold border-b border-gray-700 flex justify-between items-center">
        Admin Panel

        <!-- Close button on mobile -->
        <button id="closeSidebar" class="md:hidden text-white text-2xl leading-none">
            &times;
        </button>
    </div>

    <nav class="mt-4">
        <a href="{{ route('admin.admin') }}" class="block px-6 py-3 hover:bg-gray-800">
            Dashboard
        </a>

        <a href="{{ route('admin.franchise') }}" class="block px-6 py-3 hover:bg-gray-800">
            Franchise Application Process
        </a>

        <a href="{{ route('admin.supplies') }}" class="block px-6 py-3 hover:bg-gray-800">
            Ordering of Supplies
        </a>

        <a href="{{ route('admin.requirements') }}" class="block px-6 py-3 hover:bg-gray-800">
            Uploading of Requirement
        </a>
    </nav>
</aside>

<!-- Dark overlay for mobile -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-40"></div>
