<aside 
        class="bg-dark text-white p-4 position-fixed top-0 start-0 h-100"
        :class="open ? 'translate-x-0' : '-translate-x-full d-md-block'"
        style="width:260px; transition:0.3s;"
    >
        <h4 class="mb-4">Admin Panel</h4>

        <a href="{{ route('admin.dashboard') }}" class="d-block py-2 px-2 text-white sidebar-link">🏠 Admin Dashboard</a>
        <a href="{{ route('admin.application') }}" class="d-block py-2 px-2 text-white sidebar-link">📁 Applications</a>
        <a href="{{ route('admin.supplies') }}" class="d-block py-2 px-2 text-white sidebar-link">📦 Supplies</a>
        <a href="{{ route('admin.requirements') }}" class="d-block py-2 px-2 text-white sidebar-link">📄 Requirements</a>
        <a href="{{ route('admin.users-account') }}" class="d-block py-2 px-2 text-white sidebar-link">👥 Users Account</a>
        <a href="{{ route('admin.uploading-exams') }}" class="d-block py-2 px-2 text-white sidebar-link">📝 Exams</a>
    </aside>