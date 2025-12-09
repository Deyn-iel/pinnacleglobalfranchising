<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div x-data="{ open: false }" class="flex">

        <!-- MOBILE MENU BUTTON -->
        <button 
            @click="open = !open" 
            class="md:hidden fixed top-4 left-4 z-50 bg-gray-900 text-white p-2 rounded-lg shadow-lg"
        >
            ☰
        </button>

        <!-- SIDEBAR -->
        <aside 
            :class="open ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 w-64 bg-gray-900 text-white transform md:translate-x-0 
                   transition-transform duration-300 z-40"
        >
            <div class="p-6 text-2xl font-bold border-b border-gray-700">
                Admin Panel
            </div>

            <nav class="mt-4">
                <a href="{{ route('admin.admin') }}" class="block px-6 py-3 hover:bg-gray-800">Dashboard</a>
                <a href="{{ route('admin.franchise') }}" class="block px-6 py-3 hover:bg-gray-800">Franchise Application</a>
                <a href="{{ route('admin.supplies') }}" class="block px-6 py-3 hover:bg-gray-800">Ordering of Supplies</a>
                <a href="{{ route('admin.requirements') }}" class="block px-6 py-3 hover:bg-gray-800">Requirements Upload</a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 md:ml-64 p-6 mt-10 md:mt-0">

            <!-- STAT CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-6 shadow rounded-xl">
                    <h2 class="text-gray-600 text-sm">Total Users</h2>
                    <p class="text-3xl font-bold mt-2">1,240</p>
                </div>

                <div class="bg-white p-6 shadow rounded-xl">
                    <h2 class="text-gray-600 text-sm">Active Orders</h2>
                    <p class="text-3xl font-bold mt-2">320</p>
                </div>

                <div class="bg-white p-6 shadow rounded-xl">
                    <h2 class="text-gray-600 text-sm">Completed</h2>
                    <p class="text-3xl font-bold mt-2">980</p>
                </div>

                <div class="bg-white p-6 shadow rounded-xl">
                    <h2 class="text-gray-600 text-sm">Revenue</h2>
                    <p class="text-3xl font-bold mt-2">₱82,450</p>
                </div>

            </div>

            <!-- TABLE CARD -->
            <div class="mt-10 bg-white shadow rounded-xl p-6">
                <h2 class="text-xl font-semibold mb-4">Latest Users</h2>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse min-w-[600px]">
                        <thead>
                            <tr class="bg-gray-100 text-left text-sm">
                                <th class="p-3">Name</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">Role</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="border-t">
                                <td class="p-3">John Doe</td>
                                <td class="p-3">john@example.com</td>
                                <td class="p-3">Admin</td>
                                <td class="p-3 text-green-600 font-semibold">Active</td>
                                <td class="p-3 text-right">
                                    <button class="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        View
                                    </button>
                                </td>
                            </tr>

                            <tr class="border-t">
                                <td class="p-3">Jane Smith</td>
                                <td class="p-3">jane@example.com</td>
                                <td class="p-3">User</td>
                                <td class="p-3 text-yellow-600 font-semibold">Pending</td>
                                <td class="p-3 text-right">
                                    <button class="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        View
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
