<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex">

        <!-- SIDEBAR -->
        <x-admin-sidebar />

        <!-- MAIN CONTENT -->
        <div class="flex-1 p-6">

            <!-- CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-6 shadow rounded-xl">
                    <h2 class="text-gray-600">Total Users</h2>
                    <p class="text-3xl font-bold mt-2">1,240</p>
                </div>

                <div class="bg-white p-6 shadow rounded-xl">
                    <h2 class="text-gray-600">Active Orders</h2>
                    <p class="text-3xl font-bold mt-2">320</p>
                </div>

                <div class="bg-white p-6 shadow rounded-xl">
                    <h2 class="text-gray-600">Completed</h2>
                    <p class="text-3xl font-bold mt-2">980</p>
                </div>

                <div class="bg-white p-6 shadow rounded-xl">
                    <h2 class="text-gray-600">Revenue</h2>
                    <p class="text-3xl font-bold mt-2">₱82,450</p>
                </div>

            </div>

            <!-- TABLE -->
            <div class="mt-10 bg-white shadow rounded-xl p-6">
                <h2 class="text-xl font-semibold mb-4">Latest Users</h2>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
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
                                <button class="px-3 py-1 bg-blue-600 text-white rounded-lg">View</button>
                            </td>
                        </tr>

                        <tr class="border-t">
                            <td class="p-3">Jane Smith</td>
                            <td class="p-3">jane@example.com</td>
                            <td class="p-3">User</td>
                            <td class="p-3 text-yellow-600 font-semibold">Pending</td>
                            <td class="p-3 text-right">
                                <button class="px-3 py-1 bg-blue-600 text-white rounded-lg">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>
