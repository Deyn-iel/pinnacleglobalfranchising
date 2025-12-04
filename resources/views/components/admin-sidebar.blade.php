<aside class="w-64 bg-gray-900 text-white min-h-screen hidden md:block">
    <div class="p-6 text-2xl font-bold border-b border-gray-700">
        Admin Panel
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
