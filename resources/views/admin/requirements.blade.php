<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Admin Upload Requirements</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  @vite(['resources/css/admin/app.css'])

  <style>
    :root {
      --sidebar-w: 260px;

      --bg: #f6f8fb;
      --text: #0f172a;
      --muted: #64748b;
      --border: rgba(15, 23, 42, .08);
      --card: rgba(255, 255, 255, .96);

      --primary: #2563eb;
      --primary-dark: #1d4ed8;
      --primary-light: rgba(37, 99, 235, .08);

      --success-bg: #dcfce7;
      --success-text: #166534;
      --success-border: #22c55e;

      --danger: #ef4444;
      --danger-dark: #dc2626;

      --shadow: 0 10px 30px rgba(15, 23, 42, .06);
      --shadow-hover: 0 20px 50px rgba(15, 23, 42, .12);

      --radius: 16px;
      --radius-sm: 12px;
    }

    * {
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      min-height: 100vh;
      margin: 0;
      background: linear-gradient(135deg, #eef2ff, #f8fafc);
      color: var(--text);
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
    }


    main {
      margin-left: var(--sidebar-w);
      min-height: 100vh;
      padding: clamp(18px, 2vw, 34px);
      transition: margin-left .2s ease, padding .2s ease;
    }

    .admin-container {
      width: 100%;
      max-width: 1600px;
      margin: 0 auto;
    }

    /* Large desktop */
    @media (min-width: 1600px) {
      :root {
        --sidebar-w: 280px;
      }

      .admin-container {
        max-width: 1700px;
      }
    }

    /* Normal laptop / desktop */
    @media (max-width: 1366px) {
      :root {
        --sidebar-w: 240px;
      }

      main {
        padding: 22px;
      }
    }

    /* Smaller laptop */
    @media (max-width: 1199px) {
      :root {
        --sidebar-w: 220px;
      }

      main {
        padding: 20px;
      }
    }

    /* Tablet and mobile */
    @media (max-width: 991px) {
      main {
        margin-left: 0;
        padding: 16px;
      }
    }

    @media (max-width: 575px) {
      main {
        padding: 12px;
      }
    }

    .page-header {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: clamp(16px, 2vw, 24px);
      box-shadow: var(--shadow);
      margin-bottom: 20px;
      overflow: hidden;
    }

    .page-header h4 {
      font-size: clamp(18px, 1.6vw, 26px);
      font-weight: 900;
      line-height: 1.25;
      margin-bottom: 6px;
      word-break: break-word;
    }

    .page-header p {
      color: var(--muted);
      font-size: clamp(13px, .95vw, 15px);
      margin: 0;
    }

    .content-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: clamp(16px, 1.7vw, 24px);
      box-shadow: var(--shadow);
      margin-bottom: 20px;
      overflow: hidden;
    }

    .section-title {
      font-size: clamp(16px, 1.2vw, 20px);
      font-weight: 800;
      color: var(--text);
    }

    .section-subtitle {
      color: var(--muted);
      font-size: 13px;
    }

    .form-label {
      font-weight: 700;
      font-size: 14px;
      color: var(--text);
    }

    .form-control {
      min-height: 44px;
      border-radius: var(--radius-sm);
      border: 1px solid var(--border);
      padding: 10px 12px;
      color: var(--text);
      background: #fff;
      transition: border-color .2s ease, box-shadow .2s ease;
    }

    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 4px var(--primary-light);
    }

    .btn {
      border-radius: 999px;
      font-weight: 700;
      min-height: 42px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
    }

    .btn-primary {
      background: var(--primary);
      border: none;
      box-shadow: 0 8px 18px rgba(37, 99, 235, .18);
    }

    .btn-primary:hover,
    .btn-primary:focus {
      background: var(--primary-dark);
    }

    @media (max-width: 575px) {
      .btn {
        width: 100%;
      }
    }

    .success-msg {
      background: var(--success-bg);
      color: var(--success-text);
      border-left: 5px solid var(--success-border);
      padding: 13px 15px;
      border-radius: var(--radius-sm);
      margin-bottom: 15px;
      font-weight: 600;
      transition: opacity .35s ease, transform .35s ease;
    }

    .folder-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 16px;
      align-items: stretch;
    }

    @media (min-width: 1600px) {
      .folder-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 18px;
      }
    }

    @media (max-width: 1199px) {
      .folder-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      }
    }

    @media (max-width: 575px) {
      .folder-grid {
        grid-template-columns: 1fr;
      }
    }

    .folder-card-wrapper {
      position: relative;
      min-width: 0;
    }

    .folder-card {
      min-height: 86px;
      height: 100%;
      background: var(--card);
      border-radius: var(--radius);
      padding: 18px 46px 18px 18px;
      box-shadow: var(--shadow);
      display: flex;
      align-items: center;
      gap: 13px;
      color: var(--text);
      transition: transform .2s ease, box-shadow .2s ease, background .2s ease, border-color .2s ease;
      border: 1px solid var(--border);
      overflow: hidden;
    }

    .folder-card:hover,
    .folder-card:focus {
      transform: translateY(-2px);
      box-shadow: var(--shadow-hover);
      background: var(--primary-light);
      border-color: rgba(37, 99, 235, .18);
      color: var(--text);
    }

    .folder-icon {
      flex: 0 0 auto;
      font-size: clamp(25px, 2vw, 34px);
      color: #facc15;
      filter: drop-shadow(0 5px 8px rgba(250, 204, 21, .25));
    }

    .folder-name {
      min-width: 0;
      font-weight: 800;
      font-size: clamp(14px, .95vw, 16px);
      line-height: 1.3;
      word-break: break-word;
      overflow-wrap: anywhere;
    }

    .delete-folder-form {
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 2;
    }

    .delete-folder-btn {
      background: var(--danger);
      border: none;
      color: #fff;
      width: 34px;
      height: 34px;
      border-radius: 50%;
      font-size: 13px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      opacity: 0;
      transform: scale(.88);
      transition: opacity .2s ease, transform .2s ease, background .2s ease;
      box-shadow: 0 8px 18px rgba(239, 68, 68, .25);
    }

    .folder-card-wrapper:hover .delete-folder-btn,
    .folder-card-wrapper:focus-within .delete-folder-btn {
      opacity: 1;
      transform: scale(1);
    }

    .delete-folder-btn:hover,
    .delete-folder-btn:focus {
      background: var(--danger-dark);
      transform: scale(1.08);
    }

    @media (max-width: 991px) {
      .delete-folder-btn {
        opacity: 1;
        transform: scale(1);
      }
    }

    .empty-state {
      grid-column: 1 / -1;
      text-align: center;
      padding: clamp(34px, 4vw, 60px) 12px;
      color: var(--muted);
      font-size: 14px;
      border: 1px dashed rgba(100, 116, 139, .35);
      border-radius: var(--radius);
      background: rgba(255, 255, 255, .55);
    }

    .empty-state i {
      font-size: 34px;
      color: #94a3b8;
      margin-bottom: 8px;
    }

    .text-muted {
      color: var(--muted) !important;
    }

    .icon-circle {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: var(--primary-light);
      color: var(--primary);
      flex: 0 0 auto;
    }

    @media (max-width: 575px) {
      .page-header h4 {
        display: flex;
        align-items: flex-start;
        gap: 8px;
      }

      .page-header h4 i {
        margin-top: 3px;
      }

      .content-card-header {
        align-items: flex-start !important;
      }
    }
  </style>
</head>

<body>

  @include('admin-sidebar.navbar')
  @include('admin-sidebar.sidebar')

  <main>
    <div class="admin-container">

      <div class="page-header">
        <h4 class="fw-bold mb-1">
          <i class="fas fa-file-lines me-2"></i>
          UPLOADING DOCUMENTS FOR VIEWING OF DEPARTMENT EMPLOYEES
        </h4>

        <p>
          PINNACLE GLOBAL FRANCHISING GROUP INC.
        </p>
      </div>

      @if(session('success'))
        <div id="successMsg" class="success-msg">
          <i class="fa-solid fa-circle-check me-1"></i>
          {{ session('success') }}
        </div>
      @endif

      <div class="content-card">
        <div class="content-card-header d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
          <h5 class="section-title mb-0">
            <i class="fas fa-upload me-2"></i>
            Create Folder
          </h5>

          <div class="section-subtitle">
            Create a new folder for organizing documents.
          </div>
        </div>

        <form action="{{ route('admin.folder.create') }}" method="POST">
          @csrf

          <div class="row g-3 align-items-end">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <label class="form-label" for="folderName">Folder Name *</label>
              <input
                type="text"
                id="folderName"
                name="folder"
                class="form-control"
                placeholder="Enter folder name"
                required
              >
            </div>

            <div class="col-12 col-md-auto">
              <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-folder-plus"></i>
                Create Folder
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- FOLDERS -->
      <div class="content-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
          <h5 class="section-title mb-0">
            <i class="fas fa-folder me-2"></i>
            Folders
          </h5>

          <div class="section-subtitle">
            Total: {{ count($folders) }}
          </div>
        </div>

        <div class="folder-grid">
          @forelse($folders as $folder)
            <div class="folder-card-wrapper">

              <a href="{{ route('admin.folder.view', $folder) }}" class="folder-card">
                <i class="fas fa-folder folder-icon"></i>

                <div class="folder-name">
                  {{ $folder }}
                </div>
              </a>

              <form
                action="{{ route('admin.folder.delete', $folder) }}"
                method="POST"
                class="delete-folder-form"
              >
                @csrf
                @method('DELETE')

                <button
                  type="submit"
                  class="delete-folder-btn"
                  aria-label="Delete folder {{ $folder }}"
                  title="Delete folder"
                >
                  <i class="fas fa-trash"></i>
                </button>
              </form>

            </div>
          @empty
            <div class="empty-state">
              <i class="fas fa-folder-open d-block"></i>
              <strong>No folders yet</strong>
              <div class="mt-1">Create your first folder to start organizing documents.</div>
            </div>
          @endforelse
        </div>
      </div>

    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const deleteForms = document.querySelectorAll('.delete-folder-form');

      deleteForms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
          const confirmed = confirm('Delete this folder and all its files?');

          if (!confirmed) {
            e.preventDefault();
          }
        });
      });

      const successMsg = document.getElementById('successMsg');

      if (successMsg) {
        setTimeout(function () {
          successMsg.style.opacity = '0';
          successMsg.style.transform = 'translateY(-6px)';

          setTimeout(function () {
            successMsg.remove();
          }, 500);
        }, 3000);
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>